<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Mail\NotifyAdmin;
use App\Models\Schedule;
use App\Traits\Responses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ScheduleController extends Controller
{

    use Responses;

    public function getAllSchedules()
    {
        $schedules = Schedule::all();

        return $this->sendSuccess('Schedules Fetched Successfully', $schedules);
    }

    public function getSingleSchedule(Schedule $schedule)
    {
        $schedule->zone = $schedule->zone;

        return $this->sendSuccess("Schedule \"{$schedule->name}\" Fetched Successfully", $schedule);
    }

    public function createSchedule(Request $request)
    {

        $scheduleDetails = $request->validate([
            'name' => "required|string|min:4|max:32",
            'zone_id' => "required|integer|exists:zones,id",
            'start_time' => "required|date_format:H:i:s",
            'duration' => "required|integer",
            'days' => "required|array",
        ]);

        $schedule = Schedule::create($scheduleDetails);

        $message = "A new schedule named {$schedule->name} has been created in {$schedule->zone->name}.";

        Mail::to('admin@cashcardng.com', 'CashCard Admin')->send(new NotifyAdmin('A New Schedule Has Been Created', $message));

        return $this->sendCreated("Schedule \"{$schedule->name}\" Created Successfully", $schedule);
    }

    public function updateSchedule(Request $request, Schedule $schedule)
    {
        $scheduleDetails = $request->validate([
            'name' => "sometimes|string|min:4|max:32",
            'zone_id' => "sometimes|integer|exists:zones,id",
            'start_time' => "sometimes|date_format:H:i:s",
            'duration' => "sometimes|integer",
            'days' => "sometimes|array",
        ]);

        $schedule->update($scheduleDetails);

        $message = "Schedule {$schedule->name} in {$schedule->zone->name} was updated.";

        Mail::to('admin@cashcardng.com', 'CashCard Admin')->send(new NotifyAdmin('A New Schedule Has Been Created', $message));

        return $this->sendSuccess("Schedule \"{$schedule->name}\" Updated Successfully", $schedule);
    }

    public function deleteSchedule(Schedule $schedule)
    {

        $schedule->delete();

        return $this->sendSuccess("Schedule \"{$schedule->name}\" Deleted Successfully");
    }
}
