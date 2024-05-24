<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class StopWatering extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:stop-watering';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stop Watering Schedules';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $schedules = Schedule::where(['event_status' => 'watering'])->get();

        if (!$schedules) return;

        foreach ($schedules as $schedule) {
            $this->handleSingleSchedule($schedule);
        }
    }

    public function handleSingleSchedule(Schedule $schedule)
    {
        $endTime = Carbon::parse($schedule->start_time);
        $startTime = Carbon::parse($schedule->updated_at);

        if ($endTime->addMinutes($schedule->duration) <= $startTime->addMinutes($schedule->duration)) {
            $schedule->event_status = 'idle';
            $schedule->save();
        }
    }
}
