<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Topo extends Model
{
    public $fillable = ['label', 'author', 'editor'];

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function descriptions(){
        return $this->morphMany('App\Description', 'descriptive');
    }

    public function links(){
        return $this->morphMany('App\Link', 'linkable');
    }

    public function follows(){
        return $this->morphMany('App\Follow', 'followed');
    }

    public function posts(){
        return $this->morphMany('App\Post', 'postable');
    }

    public function crags(){
        return $this->hasMany('App\TopoCrag','topo_id', 'id');
    }

    public function sales(){
        return $this->hasMany('App\TopoSale','topo_id', 'id');
    }

    public function versions() {
        return $this->morphMany('App\Version', 'versionnable');
    }

    public function articleTopos(){
        return $this->hasMany('App\ArticleTopo','topo_id','id');
    }

    public function cover($size = 700) {
        $cover = file_exists(storage_path('app/public/topos/' . $size . '/topo-' . $this->id . '.jpg')) ?
            '/storage/topos/' . $size . '/topo-' . $this->id . '.jpg' :
            '/img/default-topo-couverture.svg';
        return $cover;
    }

    /**
     * @param bool $absolute
     * @return string
     */
    public function url($absolute = true) {
        return $this->webUrl($this->id, $this->label, $absolute);
    }

    /**
     * @param $id
     * @param $label
     * @param bool $absolute
     * @return string
     */
    static function webUrl($id, $label, $absolute = true) {
        return route(
            'topoPage',
            [
                'topo_id' => $id,
                'topo_label' => (str_slug($label) != '') ? str_slug($label) : 'topo'
            ],
            $absolute
        );
    }

    /**
     * Récupère les informations du topos aux vieux campeur
     *
     * @return array|null
     */
    public function getVieuxCampeurInformation() {
        $data_vc = null;
        $vc_base_url = env('VIEUX_CAMPEUR_BASE_URL');

        if ($this->ean != null && $vc_base_url != null) {
            try {
                $client = new Client();
                $reponse = $client->request('GET', $vc_base_url . $this->ean);
                if($reponse->getStatusCode() == 200) {
                    $response_data = json_decode($reponse->getBody()->getContents());
                    $data_vc = [
                        'title' => $response_data->nom,
                        'url' => $response_data->url,
                        'price' => $response_data->prix
                    ];
                    $this->price = round((int)$data_vc['price'], 2) ?? 'NA';
                }
            } catch (\Exception $e) {
                Log::error('Exception : ' . $e->getMessage());
            } catch (GuzzleException $e) {
                Log::error('GuzzleException : ' . $e->getMessage());
            }
        }

        return $data_vc;
    }
}
