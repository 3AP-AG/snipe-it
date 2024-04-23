<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnPhysicalToAvoidErrorsWithPsql extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE assets alter COLUMN physical DROP DEFAULT;');
        DB::statement('ALTER TABLE assets alter COLUMN physical TYPE smallint USING case when physical=FALSE then 0 else 1 end;');
        DB::statement('ALTER TABLE assets alter COLUMN physical SET DEFAULT 0;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE assets alter COLUMN physical DROP DEFAULT');
        DB::statement('ALTER TABLE assets alter COLUMN physical TYPE boolean USING case when physical=0 then FALSE else TRUE end;');
        DB::statement('ALTER TABLE assets alter COLUMN physical SET DEFAULT FALSE;');
    }
}
