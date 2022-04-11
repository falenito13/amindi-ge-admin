<?php

use App\CheckIn;
use App\CheckOut;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CheckInOutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1,3) as $index){
            $checkIn = CheckIn::create([
                'name' => Str::random(8),
                'work_time' => random_int(9,11)
            ]);
            CheckOut::create([
                'check_in_id' => $checkIn->id,
                'finish_time' => now()
            ]);
        }
    }
}
