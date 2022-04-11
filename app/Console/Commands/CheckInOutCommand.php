<?php

namespace App\Console\Commands;

use App\CheckIn;
use Illuminate\Console\Command;

class CheckInOutCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-in-out:checker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'If employee not checked out , when work time more by 15 min , auto check out';

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
     *
     * @return int
     */
    public function handle()
    {
        $data = CheckIn::doesntHave('checkOut')->latest()->get()->unique('name');
        foreach ($data as $item){
            if(now()->diffInMinutes($item->created_at) > ($item->work_time * 60) +14){
                \App\CheckOut::create([
                    'check_in_id' => $item->id,
                    'finish_time' => now()
                ]);
            }
        }
    }
}
