<?php

namespace App;

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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function albums() { return $this->hasMany('App\Album','user_id', 'id'); }
    public function crags(){ return $this->hasMany('App\Crag','user_id', 'id'); }
    public function descriptions() { return $this->hasMany('App\Description','user_id', 'id'); }
    public function follows() { return $this->hasMany('App\Follow','user_id', 'id'); }
    public function lexiques() { return $this->hasMany('App\Word','user_id', 'id'); }
    public function messages(){ return $this->hasMany('App\Message','user_id', 'id'); }
    public function notifications(){ return $this->hasMany('App\Notification','user_id', 'id'); }
    public function parkings() { return $this->hasMany('App\Parking','user_id', 'id'); }
    public function posts() { return $this->hasMany('App\Post','user_id', 'id'); }
    public function photos() { return $this->hasMany('App\Photo','user_id', 'id'); }
    public function routes(){ return $this->hasMany('App\Route','user_id', 'id'); }
    public function sales() { return $this->hasMany('App\Sale','user_id', 'id'); }
    public function sectors() { return $this->hasMany('App\Sector','user_id', 'id'); }
    public function settings(){ return $this->hasOne('App\UserSettings','user_id', 'id'); }
    public function socialNetworks(){ return $this->hasMany('App\UserSocialNetwork','user_id', 'id'); }
    public function topos() { return $this->hasMany('App\Topo','user_id', 'id'); }
    public function topoWebs() { return $this->hasMany('App\TopoWeb','user_id', 'id'); }
    public function topoPdfs() { return $this->hasMany('App\TopoPdf','user_id', 'id'); }
    public function tickLists() { return $this->hasMany('App\TickList','user_id', 'id'); }
    public function userConversations(){ return $this->hasMany('App\UserConversation','user_id', 'id'); }
    public function videos() { return $this->hasMany('App\Video','user_id', 'id'); }
}
