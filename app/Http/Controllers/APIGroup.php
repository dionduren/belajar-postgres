<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\ActionTime;

use App\Models\GrupMember;
use Illuminate\Http\Request;
use App\Models\GrupTechnical;
use Illuminate\Support\Carbon;
use App\Models\KnowledgeManagement;

class APIGroup extends Controller
{
    function technical_group_list()
    {
        $list_group = GrupTechnical::all();
        return response()->json($list_group);
    }

    function technical_list($id)
    {
        $id_group = Tiket::where('id', $id)->first()->id_group;
        $list_technical = GrupMember::where('id_group', $id_group)->get();
        return response()->json($list_technical);
    }

    function tiket_assign_group(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $id_group = $request->input('id_group');
        $nama_group = $request->input('nama_group');

        Tiket::where('id', $id_tiket)->update([
            'id_group' => $id_group,
            'assigned_group' => $nama_group,
            'status_tiket' => 'Assigned',
            'updated_by' => 'Helpdesk',        //Todo: Ganti jadi user Helpdesk
        ]);

        $info_tiket = Tiket::where('id', $id_tiket)->first();
        $start_time = $info_tiket->created_at;
        $end_time   = now();
        $durasi_float = $this->hitungDurasiAction($start_time, $end_time);
        $durasi = floor($durasi_float);

        ActionTime::create([
            'id_tiket' => $id_tiket,
            'action' => 'ASSIGNED',
            'start_time' => $start_time,
            'end_time' => $end_time,
            // 'durasi_total' => $durasi_float,
            'durasi_total' => sprintf("%.3f", $durasi_float),
            'durasi' => $durasi,
            'created_by' => 'HELPDESK',
        ]);

        return response()->json([
            'success' => true,
        ], 201);
    }


    function tiket_assign_technical(Request $request)
    {
        $id_tiket = $request->input('id_tiket');
        $id_technical = $request->input('id_technical');
        $nama_technical = $request->input('nama_technical');

        Tiket::where('id', $id_tiket)->update([
            'id_technical' => $id_technical,
            'assigned_technical' => $nama_technical,
            'updated_by' => 'Team Lead',        //Todo: Ganti jadi user Teamlead
        ]);

        return response()->json([
            'success' => true,
        ], 201);
    }

    private function hitungDurasiAction(Carbon $start, Carbon $end)
    {
        // Set Jam kerja Mulai
        $workStartHour = 7;

        // Set Jam kerja Akhir
        $workEndHour = 19;

        $totalHours = 0;

        // Clone to avoid modifying original
        $current = $start->copy();

        while ($current->lessThan($end)) {
            // If the day is a weekend, skip the entire day
            if (in_array($current->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                $current->addDay()->startOfDay();
                continue;
            }

            // Set the start time of the working day
            $workStart = $current->copy()->hour($workStartHour)->minute(0)->second(0);

            // If current time is before work hours, move it to the start of work hours
            if ($current->lessThan($workStart)) {
                $current = $workStart;
            }

            // Set the end time of the working day
            $workEnd = $current->copy()->hour($workEndHour)->minute(0)->second(0);

            // If the end time is after work hours and on the same day, set to work end time
            if ($end->greaterThan($workEnd) && $end->isSameDay($current)) {
                $end = $workEnd;
            }

            // If current time is after work hours, move to the next working day
            if ($current->greaterThanOrEqualTo($workEnd)) {
                $current->addDay()->startOfDay();
                continue;
            }

            // If the end time is on the same day, add the difference in hours to the total
            if ($end->isSameDay($current)) {
                $totalHours += $current->floatDiffInHours($end);
            } else {
                // If the end time is on a different day, add the remaining hours of the current day
                $totalHours += $current->floatDiffInHours($workEnd);
            }

            // Move to the next day
            $current->addDay()->startOfDay();
        }

        return $totalHours;
    }
}
