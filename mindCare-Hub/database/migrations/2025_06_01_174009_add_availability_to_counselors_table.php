<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('counselors', function ($table) {
            $table->json('availability')->nullable()->after('languages');
        });
    }

    public function down()
    {
        Schema::table('counselors', function ($table) {
            $table->dropColumn('availability');
        });
    }
};
