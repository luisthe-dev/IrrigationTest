<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class StartWatering extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start-watering';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Watering Schedules';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();

        $schedules = Schedule::where([['days', 'LIKE', "%{$today->format("l")}%"], 'start_time' => $today->format('H:i:s'), 'event_status' => 'idle'])->get();

        if (!$schedules) return;

        foreach ($schedules as $schedule) {
            $this->handleSingleSchedule($schedule);
        }
    }

    public function handleSingleSchedule(Schedule $schedule)
    {
        $schedule->event_status = 'watering';
        $schedule->save();
    }
}
