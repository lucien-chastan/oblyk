<?php

namespace App\Console\Commands;

use App\Photo;
use Illuminate\Console\Command;
use DB;
use Log;

class FixAltPhoto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oblyk:fix_alt_photo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recreate the alt properties of photos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $photo = Photo::class;
        foreach ($photo::all() as $photo) {
            $photo->alt = $photo->getAlt();
            $photo->save();
        }
    }
}
