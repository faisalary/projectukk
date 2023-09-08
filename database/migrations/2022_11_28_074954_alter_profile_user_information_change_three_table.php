<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProfileUserInformationChangeThreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE profile_user_informations MODIFY COLUMN expected_salary_type varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL');
        DB::statement('ALTER TABLE profile_user_informations MODIFY COLUMN expected_salary_value double(15,2) NULL');
        DB::statement('ALTER TABLE profile_user_informations MODIFY COLUMN preferred_city varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE profile_user_informations MODIFY COLUMN expected_salary_type varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL');
        DB::statement('ALTER TABLE profile_user_informations MODIFY COLUMN expected_salary_value double(15,2) NOT NULL');
        DB::statement('ALTER TABLE profile_user_informations MODIFY COLUMN preferred_city varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL');

    }
}
