<?php

namespace App\Console\Commands;

use App\Cross;
use Illuminate\Console\Command;
use DB;
use Log;

class UpdateMinAndMaxGradeCross extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oblyk:update_min_and_max_grade_cross';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves route sections grades and records them at cross level';

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
        $Cross = Cross::class;
        $crosses = $Cross::all();

        foreach($crosses as $cross) {
            $cross->min_grade_val = $cross->minGrade();
            $cross->max_grade_val = $cross->maxGrade();
            $cross->save();

            $this->info($cross->id);
        }
    }
}
