<?php

namespace App\Observers;

use App\Version;
use App\Word;

class WordObserver
{

    /**
     * @param Word $word
     */
    public function creating(Word $word) {
        $word->label = strip_tags($word->label);
        $word->definition = strip_tags($word->definition);
    }

    /**
     * Listen to the Word updating event.
     *
     * @param Word $word
     * @return void
     */
    public function updating(Word $word)
    {
        $word->label = strip_tags($word->label);
        $word->definition = strip_tags($word->definition);

        $version = new Version();
        $version->saveVersion(Word::find($word->id), $word, 'App\Word');
    }

    /**
     * Listen to the Word deleting event.
     *
     * @param Word $word
     * @return void
     */
    public function deleting(Word $word) {
        try {
            Version::where([
                ['versionnable_id', '=', $word->id],
                ['versionnable_type', '=', 'App\Word']
            ])->delete();
        } catch (\Exception $e) {}
    }
}