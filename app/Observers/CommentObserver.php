<?php

namespace App\Observers;


use App\Comment;
use App\Like;

class CommentObserver
{

    /**
     * Listen to the Comment deleting event.
     *
     * @param  Comment  $comment
     * @return void
     */
    public function deleting(Comment $comment)
    {
        Like::where(
            [
                ['likable_id','=',$comment->id],
                ['likable_type','=','App\Comment']
            ]
        )->delete();

        Comment::where(
            [
                ['commentable_id','=',$comment->id],
                ['commentable_type','=','App\Comment']
            ]
        )->delete();
    }
}