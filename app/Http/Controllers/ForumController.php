<?php

namespace App\Http\Controllers;

use App\Follow;
use App\ForumCategory;
use App\ForumGeneralCategory;
use App\ForumTopic;
use App\Post;
use App\User;
use App\ViewCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class ForumController extends Controller
{

    public function forumPage(){
        $data = ['meta_title' => 'Oblyk, le Forum',];
        return view('pages.forum.forum', $data);
    }

    public function categoryPage(){

        $generalCategories = ForumGeneralCategory::with('categories')->with('categories.topics')->get();

        $data = [
            'meta_title' => 'Forum - Les catégories',
            'generalCategories' => $generalCategories
        ];

        return view('pages.forum.category', $data);
    }

    public function topicsPage(Request $request){

        $filter = $request->input('categorie');

        if(isset($filter)){
            $topics = ForumTopic::where([['nb_post','>',0],['category_id',$filter]])->orWhere([['user_id',Auth::id()],['category_id',$filter]])->with('category')->with('user')->orderBy('last_post', 'desc')->paginate(2);
            $filter_categorie = ForumCategory::where('id',$filter)->first();
        }else{
            $topics = ForumTopic::where('nb_post','>',0)->orWhere('user_id',Auth::id())->with('category')->with('user')->orderBy('last_post', 'desc')->paginate(20);
            $filter = 'no-filtre';
            $filter_categorie = '';
        }

        $data = [
            'meta_title' => 'Forum - Les sujets',
            'topics' => $topics,
            'filter' => $filter,
            'filter_categorie' => $filter_categorie
        ];

        return view('pages.forum.topics', $data);
    }

    public function createdPage($category_id){

        $data = [
            'meta_title' => 'Forum - Créer un sujet',
            'category_id' => $category_id
        ];

        return view('pages.forum.create', $data);
    }

    public function rulesPage(){
        $data = ['meta_title' => 'Forum - Les régles',];
        return view('pages.forum.rules', $data);
    }

    public function topicPage($topic_id, $topic_label){

        $topic = ForumTopic::where('id',$topic_id)
            ->with('user')
            ->first();

        //Increment de nombre de vue
        $topic = ViewCounter::IncrementViews($topic,'Topic');

        $userFollow = Follow::where(
            [
                ['user_id', '=', Auth::id()],
                ['followed_type', '=', 'App\ForumTopic'],
                ['followed_id', '=', $topic->id]
            ]
        )->first();
        $userFollow = (isset($userFollow)) ? 'true' : 'false';

        $posts = Post::where([['postable_id', $topic->id], ['postable_type','App\ForumTopic']])
            ->with('user')
            ->with('postable')
            ->with('comments.user')
            ->with('comments.likes')
            ->with('comments.comments.user')
            ->with('comments.comments.likes')
            ->orderBy('created_at')
            ->paginate(10);

        $data = [
            'meta_title' => $topic->label,
            'topic'=>$topic,
            'posts'=>$posts,
            'postable_type' => 'ForumTopic',
            'postable_id' => $topic->id,
            'last_read' => date('Y-m-d H:m:s'),
            'user_follow' => $userFollow
        ];

        return view('pages.forum.topic', $data);
    }
}
