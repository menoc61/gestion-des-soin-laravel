<?php

namespace App\Http\Controllers\Api;

use App\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function all($userId)
    {
        try {
            $appointments = Appointment::where('user_id', $userId)->get();

            return response()->json([
                'data' => $appointments,
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function create($user_id, Request $req)
    {
        try {
            $appointment = new Appointment();
            $appointment->user_id = $user_id;
            $appointment->date = $req->date;
            $appointment->time_start = $req->time_start;
            $appointment->time_end = $req->time_end;
            $appointment->visited = 0;
            $appointment->reason = $req->reason;
            $appointment->save();

            return response()->json([
                'data' => $appointment,
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function update($id, Request $req)
    {
        try {
            $appointment = Appointment::find($id);

            if (!$appointment) {
                return response()->json(['error' => 'Rendez-vous non trouvé .'], 404);
            }
            $appointment->date = $req->date;
            $appointment->time_start = $req->time_start;
            $appointment->time_end = $req->time_end;
            $appointment->reason = $req->reason;
            $appointment->save();

            return response()->json([
                'data' => $appointment,
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
}
