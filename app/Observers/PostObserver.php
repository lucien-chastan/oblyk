<?php

namespace App\Observers;


use App\Comment;
use App\ForumTopic;
use App\Like;
use App\Post;
use App\PostPhoto;

class PostObserver
{

    /**
     * @param Post $post
     */
    public function creating(Post $post) {
        $post->content = clean($post->content);
    }

    /**
     * @param Post $post
     */
    public function updating(Post $post) {
        $post->content = clean($post->content);
    }

    /**
     * Listen to the Comment deleting event.
     *
     * @param  Post $post
     * @return void
     * @throws \Exception
     */
    public function deleting(Post $post)
    {
        Like::where(
            [
                ['likable_id','=',$post->id],
                ['likable_type','=','App\Post']
            ]
        )->delete();

        Comment::where(
            [
                ['commentable_id','=',$post->id],
                ['commentable_type','=','App\Post']
            ]
        )->delete();

        PostPhoto::where('post_id',$post->id)->delete();

        //Si nous somme sur un Post de type forum
        if($post->postable_type == 'App\ForumTopic'){
            $topic = ForumTopic::where('id',$post->postable_id)->first();
            $topic->nb_post = $topic->nb_post - 1;
            $topic->save();
        }
    }
}