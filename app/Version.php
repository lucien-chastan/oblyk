<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Version extends Model
{
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
    public function modelDiffToArray(Model $old, Model $new) : array
    {
        // purge model updated_at, not to match the difference
        $old = $old->toArray();
        $new = $new->toArray();
        unset($old['updated_at']);
        unset($new['updated_at']);

        return array_diff($old, $new);
    }
}