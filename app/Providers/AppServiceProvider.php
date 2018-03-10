<?php

namespace App\Providers;

use App\Comment;
use App\Conversation;
use App\Cross;
use App\Observers\CommentObserver;
use App\Observers\ConversationObserver;
use App\Observers\CrossObserver;
use App\Observers\PhotoObserver;
use App\Observers\PostObserver;
use App\Observers\SectorObserver;
use App\Observers\UserConversationObserver;
use App\Photo;
use App\Post;
use App\Sector;
use App\UserConversation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Sector::observe(SectorObserver::class);
        Photo::observe(PhotoObserver::class);
        Comment::observe(CommentObserver::class);
        Post::observe(PostObserver::class);
        Cross::observe(CrossObserver::class);
        Conversation::observe(ConversationObserver::class);
        UserConversation::observe(UserConversationObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
