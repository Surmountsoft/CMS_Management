<?php
/**
 * CreateUploadsTable Migration
 *
 * @class CreateUploadsTable
 *
 * @author Rahul Sharma <rahul.sharma@surmountsoft.in>
 *
 * @copyright 2021 SurmountSoft Pvt. Ltd. All rights reserved.
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('display_name')->nullable();
            $table->tinyInteger('file_type')->nullable();
            $table->integer('uploadable_id')->nullable();
            $table->string('uploadable_type', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}
