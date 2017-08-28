<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Search extends Model
{

    public function searchable(){
        return $this->morphTo();
    }

    public static function find($label, $limit, $offset){

        //transform la recherche en regexp
        $litleWords = '/^(de|des|du|le|la|et|les|l|a|au|aux|the)$/';
        $splitSearches = explode('-', str_slug($label));
        $goodWords = [];
        foreach ($splitSearches as $word){
            if(!preg_match($litleWords, $word)) $goodWords[] = $word;
        }

        $regSearches = implode('|', $goodWords);

        //va chercher les entrées qui correspondent à la recherche
        $finds = DB::select('
            SELECT DISTINCT id, label 
            FROM searches
            WHERE label REGEXP :regSearches
            ORDER BY levenshtein_ratio(label, :labelSearch) DESC
            LIMIT ' . $limit . '
            OFFSET ' . $offset,
            [
                'labelSearch' => $label,
                'regSearches' => $regSearches
            ]
        );


        $data = [];
        foreach ($finds as $find){
            $data[] = $find->id;
        }

        return $data;
    }


    /**
     * CRÉER OU MET À JOUR L'INDEX DE RECHERCHE
     * @param $model - Modéle à indexer
     * @param $id - id du modéle
     * @param $label - nom du modéle
     */
    public static function index ($model, $id, $label){

        $searchIndex = Search::where(['searchable_id' => $id, 'searchable_type'=>$model])->first();
        if(count($searchIndex) == 0){
            $searchIndex = new Search();
            $searchIndex->searchable_id = $id;
            $searchIndex->searchable_type = $model;
        }
        $searchIndex->label = str_slug($label);
        $searchIndex->save();

    }

}