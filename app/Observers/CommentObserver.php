<?php

namespace App\Observers;


use App\Comment;
use App\Like;

class CommentObserver
{

    /**
     * @param Comment $comment
     */
    public function creating(Comment $comment) {
        $comment->comment = clean($comment->comment);
    }

    /**
     * @param Comment $comment
     */
    public function updating(Comment $comment) {
        $comment->comment = clean($comment->comment);
    }

    /**
     * Listen to the Comment deleting event.
     *
     * @param  Comment $comment
     * @return void
     * @throws \Exception
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