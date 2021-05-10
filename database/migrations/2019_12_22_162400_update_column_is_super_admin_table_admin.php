<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateColumnIsSuperAdminTableAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update records is_super_admin from admins.
        DB::table('admins')->where('email', 'admin@gmail.com')
            ->update([
                'is_super_admin' => true
            ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Update records is_super_admin from admins.
        DB::table('admins')->where('email', 'admin@gmail.com')
            ->update([
                'is_super_admin' => false
            ]);
    }
}
