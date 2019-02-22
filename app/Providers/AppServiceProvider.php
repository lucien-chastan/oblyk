<?php

namespace App\Providers;

use App\Album;
use App\Approach;
use App\Comment;
use App\Conversation;
use App\Crag;
use App\Cross;
use App\Description;
use App\Exception;
use App\ForumTopic;
use App\Gym;
use App\GymGrade;
use App\GymGradeLine;
use App\GymRoom;
use App\GymRoute;
use App\GymSector;
use App\Help;
use App\IndoorCross;
use App\Link;
use App\Massive;
use App\Message;
use App\Observers\AlbumObserver;
use App\Observers\ApproachObserver;
use App\Observers\CommentObserver;
use App\Observers\ConversationObserver;
use App\Observers\CragObserver;
use App\Observers\CrossObserver;
use App\Observers\DescriptionObserver;
use App\Observers\ExceptionObserver;
use App\Observers\ForumTopicObserver;
use App\Observers\GymGradeLineObserver;
use App\Observers\GymGradeObserver;
use App\Observers\GymObserver;
use App\Observers\GymRoomObserver;
use App\Observers\GymRouteObserver;
use App\Observers\GymSectorObserver;
use App\Observers\HelpObserver;
use App\Observers\IndoorCrossObserver;
use App\Observers\LinkObserver;
use App\Observers\MassiveObserver;
use App\Observers\MessageObserver;
use App\Observers\ParkingObserver;
use App\Observers\PhotoObserver;
use App\Observers\PostObserver;
use App\Observers\PostPhotoObserver;
use App\Observers\RoomObserver;
use App\Observers\RouteObserver;
use App\Observers\RouteSectionObserver;
use App\Observers\SectorObserver;
use App\Observers\SocialNetworkObserver;
use App\Observers\SubscriberObserver;
use App\Observers\TopoObserver;
use App\Observers\TopoPdfObserver;
use App\Observers\TopoWebObserver;
use App\Observers\UserConversationObserver;
use App\Observers\UserObserver;
use App\Observers\UserPlaceObserver;
use App\Observers\UserSocialNetworkObserver;
use App\Observers\VideoObserver;
use App\Observers\WordObserver;
use App\Parking;
use App\Photo;
use App\Post;
use App\PostPhoto;
use App\Route;
use App\RouteSection;
use App\Sector;
use App\SocialNetwork;
use App\Subscriber;
use App\Topo;
use App\TopoPdf;
use App\TopoWeb;
use App\User;
use App\UserConversation;
use App\UserPlace;
use App\UserSocialNetwork;
use App\Video;
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
        GymRoom::observe(RoomObserver::class);
	    Message::observe(MessageObserver::class);
        Album::observe(AlbumObserver::class);
        Approach::observe(ApproachObserver::class);
        Description::observe(DescriptionObserver::class);
        Exception::observe(ExceptionObserver::class);
        ForumTopic::observe(ForumTopicObserver::class);
        Help::observe(HelpObserver::class);
        Link::observe(LinkObserver::class);
        Parking::observe(ParkingObserver::class);
        PostPhoto::observe(PostPhotoObserver::class);
        SocialNetwork::observe(SocialNetworkObserver::class);
        Subscriber::observe(SubscriberObserver::class);
        TopoPdf::observe(TopoPdfObserver::class);
        TopoWeb::observe(TopoWebObserver::class);
        UserPlace::observe(UserPlaceObserver::class);
        UserSocialNetwork::observe(UserSocialNetworkObserver::class);
        User::observe(UserObserver::class);
        Video::observe(VideoObserver::class);
        GymGrade::observe(GymGradeObserver::class);
        GymGradeLine::observe(GymGradeLineObserver::class);
        GymRoom::observe(GymRoomObserver::class);
        GymRoute::observe(GymRouteObserver::class);
        GymSector::observe(GymSectorObserver::class);
        IndoorCross::observe(IndoorCrossObserver::class);
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
