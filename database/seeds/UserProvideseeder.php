<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserProvideseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<10 ; $i++) { 

          	DB::table('users')->insert(['name'=>str::random(10),'email'=>str::random(20),'password'=> bcrypt(str::random(20))]);
          	
          }
    }
}
