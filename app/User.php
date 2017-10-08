<?php

namespace App;

use App\Notifications\MailResetPasswordToken;
use Elasticquent\ElasticquentTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'localisation', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'last_fil_read'
    ];

    use ElasticquentTrait;

    protected $mappingProperties = array(
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'localisation' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'description' => [
            'type' => 'string',
            "analyzer" => "standard",
        ]
    );

    //Customisation du mail de reset de password
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    public function albums() { return $this->hasMany('App\Album','user_id', 'id'); }
    public function approaches() { return $this->hasMany('App\Approach','user_id', 'id'); }
    public function crags(){ return $this->hasMany('App\Crag','user_id', 'id'); }
    public function crosses(){ return $this->hasMany('App\Cross','user_id', 'id'); }
    public function descriptions() { return $this->hasMany('App\Description','user_id', 'id'); }
    public function exceptions() { return $this->hasMany('App\Exception','user_id', 'id'); }
    public function follows() { return $this->hasMany('App\Follow','user_id', 'id'); }
    public function gyms() { return $this->hasMany('App\Gym','user_id', 'id'); }
    public function lexiques() { return $this->hasMany('App\Word','user_id', 'id'); }
    public function messages(){ return $this->hasMany('App\Message','user_id', 'id'); }
    public function notifications(){ return $this->hasMany('App\Notification','user_id', 'id'); }
    public function parkings() { return $this->hasMany('App\Parking','user_id', 'id'); }
    public function partnerSettings(){ return $this->hasOne('App\UserPartnerSettings','user_id', 'id'); }
    public function places() { return $this->hasMany('App\UserPlace','user_id', 'id'); }
    public function posts() { return $this->hasMany('App\Post','user_id', 'id'); }
    public function photos() { return $this->hasMany('App\Photo','user_id', 'id'); }
    public function routes(){ return $this->hasMany('App\Route','user_id', 'id'); }
    public function sales() { return $this->hasMany('App\Sale','user_id', 'id'); }
    public function sectors() { return $this->hasMany('App\Sector','user_id', 'id'); }
    public function settings(){ return $this->hasOne('App\UserSettings','user_id', 'id'); }
    public function socialNetworks(){ return $this->hasMany('App\UserSocialNetwork','user_id', 'id'); }
    public function tags() { return $this->hasMany('App\Tag','user_id', 'id'); }
    public function topos() { return $this->hasMany('App\Topo','user_id', 'id'); }
    public function topoWebs() { return $this->hasMany('App\TopoWeb','user_id', 'id'); }
    public function topoPdfs() { return $this->hasMany('App\TopoPdf','user_id', 'id'); }
    public function tickLists() { return $this->hasMany('App\TickList','user_id', 'id'); }
    public function userConversations(){ return $this->hasMany('App\UserConversation','user_id', 'id'); }
    public function videos() { return $this->hasMany('App\Video','user_id', 'id'); }
}
