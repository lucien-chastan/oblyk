<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Route;
use Log;

class UpdateMinAndMaxGradeRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oblyk:update_min_and_max_grade_route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves route sections grades and records them at route level';

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
        $Route = Route::class;
        $routes = $Route::all();

        foreach($routes as $route) {
            $route->min_grade_val = $route->minGrade();
            $route->max_grade_val = $route->maxGrade();
            $route->save();

            $this->info($route->id . ' : ' . $route->label);
        }
    }
}
