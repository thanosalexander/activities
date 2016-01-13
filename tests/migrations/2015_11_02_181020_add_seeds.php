<?php

use Illuminate\Database\Migrations\Migration;
use Thanosalexander\Activity\Activity\Types\Type;

class AddSeeds extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        $login_type = (new Type())->create([
            'name'=>'login',
            'description'=>'login action',
            'label'=>'Login'
        ]);

        $logout_type = (new Type())->create([
            'name'=>'logout',
            'description'=>'logout action',
            'label'=>'Logout'
        ]);

        $login_activity = (new Thanosalexander\Activity\Activity\Activity())->create([
            'type_id'=>$login_type->id,
            'user_id'=>1,
            'content'=>'login activity',
            'ip'=>'127.0.0.1'
        ]);

        $login_activity = (new Thanosalexander\Activity\Activity\Activity())->create([
            'type_id'=>$logout_type->id,
            'user_id'=>1,
            'content'=>'logout activity',
            'ip'=>'127.0.0.1'
        ]);
    }



    /**
     * Reverse the migrations.
     */
    public function down()
    {
    }
}
