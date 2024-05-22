<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZoneRequest;
use App\Http\Requests\UpdateZoneRequest;
use App\Models\Zone;
use App\Traits\Responses;
use Illuminate\Http\Request;

class ZoneController extends Controller
{

    use Responses;

    public function getAllZones()
    {
        $zones = Zone::all();

        return $this->sendSuccess("Zones Fetched Successfully", $zones);
    }

    public function getSingleZone(Zone $zone)
    {
        $zone->schedules = $zone->schedules;

        return $this->sendSuccess("Zone \"{$zone->name}\" Fetched Successfully", $zone);
    }

    public function createZone(Request $request)
    {

        $zoneDetails = $request->validate([
            'name' => "required|string|min:4|max:32",
            'area' => "required|string"
        ]);

        $zone = Zone::create($zoneDetails);

        return $this->sendCreated("Zone \"{$zone->name}\" Created Successfully", $zone);
    }

    public function updateZone(Request $request, Zone $zone)
    {

        $zoneDetails = $request->validate([
            'name' => "sometimes|string|min:4|max:32",
            'area' => "sometimes|string"
        ]);

        $zone->update($zoneDetails);

        return $this->sendCreated("Zone \"{$zone->name}\" Updated Successfully", $zone);
    }

    public function deleteZone(Zone $zone)
    {

        $zone->schedules()->delete();
        $zone->delete();

        return $this->sendSuccess("Zone \"{$zone->name}\" Deleted Successfully");
    }

}
