<?php

namespace App\Http\Controllers;

use App\Http\Requests\Presence\StorePresenceRequest;
use App\Models\Presence;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function createPresence(StorePresenceRequest $request): JsonResponse
    {
        $data = $request->validated();

        $presence = new Presence();
        $presence->id_users = Auth::user()->id;
        $presence->type = $data['type'];
        $presence->is_approve = null;
        $presence->waktu = $data['waktu'];
        $presence->save();

        return response()->json([
            'message' => 'Presence created successfully',
            'data' => $presence
        ], 201);
    }
}
