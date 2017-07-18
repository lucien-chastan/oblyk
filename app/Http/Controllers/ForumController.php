<?php

namespace App\Http\Controllers;

use App\Follow;
use App\ForumCategory;
use App\ForumGeneralCategory;
use App\ForumTopic;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function topicsPage(){

        $topics = ForumTopic::where('nb_post','>=',0)->orderBy('last_post', 'desc')->paginate(2);

        $data = [
            'meta_title' => 'Forum - Les sujets',
            'topics' => $topics
        ];

        return view('pages.forum.topics', $data);
    }

    public function createdPage(){
        $data = ['meta_title' => 'Forum - Créer un sujet',];
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
            'user_follow' => $userFollow,
        ];

        return view('pages.forum.topic', $data);
    }
}
