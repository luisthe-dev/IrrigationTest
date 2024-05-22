<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Traits\Responses;
use Illuminate\Http\Request;

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

        return $this->sendSuccess("Schedule \"{$schedule->name}\" Updated Successfully", $schedule);
    }

    public function deleteSchedule(Schedule $schedule)
    {

        $schedule->delete();

        return $this->sendSuccess("Schedule \"{$schedule->name}\" Deleted Successfully");
    }
}
