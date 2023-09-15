<?php

namespace App\Http\Controllers;

use App\Http\Requests\Presence\IsApproveRequest;
use App\Http\Requests\Presence\StorePresenceRequest;
use App\Models\Presence;
use App\Models\User;
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

    public function isApprove(IsApproveRequest $request): JsonResponse
    {
        $data = $request->validated();

        $presence = Presence::find($data['id_presences']);

        if (!$presence) {
            return response()->json([
                'message' => 'Presence not found',
            ], 404);
        }

        $curr_user = Auth::user();

        if ($curr_user->id === $presence->user->id || $presence->user->npp_supervisor !== $curr_user->npp) {
            return response()->json([
                'message' => 'You cannot perform this action'
            ], 401);
        }

        $presence->is_approve = $data['is_approve'];
        $presence->save();

        return response()->json([
            'message' => 'Presence successfully updated',
            'data' => $presence
        ], 200);
    }
}
