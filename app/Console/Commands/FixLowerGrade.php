<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Route;
use App\Crag;
use App\Sector;
use App\GapGrade;
use Log;

class FixLowerGrade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oblyk:fix_lower_grade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Just to rewrite lower boundary of route ranges in the DB';

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
        foreach(DB::table("gap_grades")->where('min_grade_val',0)->get() as $gg) {
            $min_grade_val = 0;
            $max_grade_val = 0;
            switch($gg->spreadable_type) {
                case "App\Sector": 
                    $routes = Sector::find($gg->spreadable_id)->routeSections->where('grade_val', '>', 0);
                    break;
                case "App\Crag": 
                    $routes = Crag::find($gg->spreadable_id)->routeSections->where('grade_val', '>', 0);
                    break;
            }
            if ($routes->count() > 0) {
                $min_grade_val = $routes->min('grade_val');
                $max_grade_val = $routes->max('grade_val');
            }
            $min_grade_text = Route::valToGrad($min_grade_val);
            $max_grade_text = Route::valToGrad($max_grade_val);

            GapGrade::where('id', '=', $gg->id)->update([
                'min_grade_val' => $min_grade_val,
                'min_grade_text' => $min_grade_text,
                'max_grade_val' => $max_grade_val,
                'max_grade_text' => $max_grade_text,
            ]);

            $this->info($gg->spreadable_type . ' ' . $gg->spreadable_id);
        }
    }
}
