<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetRangeStoredProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE FUNCTION getRange(lat1 DOUBLE, lng1 DOUBLE, lat2 DOUBLE, lng2 DOUBLE) RETURNS double 
            BEGIN 
                DECLARE rlo1 DOUBLE;
                DECLARE rla1 DOUBLE;
                DECLARE rlo2 DOUBLE;
                DECLARE rla2 DOUBLE;
                DECLARE dlo DOUBLE;
                DECLARE dla DOUBLE;
                DECLARE a DOUBLE;
                
                SET rlo1 = RADIANS(lng1);
                SET rla1 = RADIANS(lat1);
                SET rlo2 = RADIANS(lng2);
                SET rla2 = RADIANS(lat2);
                SET dlo = (rlo2 - rlo1) / 2;
                SET dla = (rla2 - rla1) / 2;
                SET a = SIN(dla) * SIN(dla) + COS(rla1) * COS(rla2) * SIN(dlo) * SIN(dlo);

                RETURN (6378137 * 2 * ATAN2(SQRT(a), SQRT(1 - a)));
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::unprepared('DROP FUNCTION IF EXISTS getRange');
    }
}