<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Version extends Model
{
    private $unwelcomeKey = [
        'updated_at',
        'created_at',
        'deleted_at',
        'views',
        'user_id',
        'id',
        'photos',
        'topos',
        'massives',
        'topo_webs',
        'topo_pdfs',
        'gap_grade',
        'descriptions',
        'exceptions',
        'routes_count',
        'links_count',
        'topo_webs_count',
        'topo_pdfs_count',
        'posts_count',
        'versions_count',
        'orientable_id',
        'orientable_type',
        'photos_count',
        'videos_count',
        'topos_count',
        'seasontable_id',
        'seasontable_type',
        'tags',
        'route_sections',
        'article_topos',
        'article_crags',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function version(){
        return $this->morphTo();
    }

    /**
     * @param Model $oldModel
     * @param Model $newModel
     * @param $appType
     */
    public function saveVersion(Model $oldModel, Model $newModel, $appType)
    {

        // compare old and new model for save only the changes
        $diff = $this->modelDiffToArray($oldModel, $newModel);

        // if we have differences
        if (count($diff) > 0) {
            $this->versionnable_id = $oldModel->id;
            $this->versionnable_type = $appType;
            $this->user_id = Auth::id();
            $this->changes = json_encode($diff);
            $this->save();
        }
    }

    /**
     * @param Model $old
     * @param Model $new
     * @return array
     */
    public function modelDiffToArray(Model $old, Model $new)
    {
        // purge model updated_at, not to match the difference
        $old = $this->purgeModel($old);
        $new = $this->purgeModel($new);

        return array_diff($old, $new);
    }

    /**
     * @param Model $model
     * @return array
     */
    private function purgeModel(Model $model) {
        $arrayModel = $model->toArray();
        $arrayModel = $this->flatArray($arrayModel);
        foreach ($arrayModel as $key => $value) {
            if (in_array($key, $this->unwelcomeKey)) {
                unset($arrayModel[$key]);
            }
        }
        return $arrayModel;
    }

    /**
     * @param $array
     * @return array
     */
    private function flatArray($array) {
        $flatArray = [];
        foreach ($array as $key => $value) {
            if (is_array($value) && count($value) > 0 && !in_array($key, $this->unwelcomeKey)) {
                foreach ($value as $subKey => $subValue) {
                    if(!in_array($subKey, $this->unwelcomeKey)) {
                        if(array_key_exists($subKey, $flatArray)) $subKey .= '_' . $key;
                        $flatArray[$subKey] = $subValue;
                    }
                }
            } elseif (!in_array($key, $this->unwelcomeKey)) {
                $flatArray[$key] = $value;
            }
        }
        return $flatArray;
    }
}