<?php

namespace App\Providers;

use App\Comment;
use App\Conversation;
use App\Crag;
use App\Cross;
use App\Gym;
use App\Massive;
use App\Observers\CommentObserver;
use App\Observers\ConversationObserver;
use App\Observers\CragObserver;
use App\Observers\CrossObserver;
use App\Observers\GymObserver;
use App\Observers\MassiveObserver;
use App\Observers\PhotoObserver;
use App\Observers\PostObserver;
use App\Observers\RouteObserver;
use App\Observers\RouteSectionObserver;
use App\Observers\SectorObserver;
use App\Observers\TopoObserver;
use App\Observers\UserConversationObserver;
use App\Observers\WordObserver;
use App\Photo;
use App\Post;
use App\Route;
use App\RouteSection;
use App\Sector;
use App\Topo;
use App\UserConversation;
use App\Word;
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
        Word::observe(WordObserver::class);
        Crag::observe(CragObserver::class);
        Gym::observe(GymObserver::class);
        Massive::observe(MassiveObserver::class);
        Route::observe(RouteObserver::class);
        RouteSection::observe(RouteSectionObserver::class);
        Topo::observe(TopoObserver::class);
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
