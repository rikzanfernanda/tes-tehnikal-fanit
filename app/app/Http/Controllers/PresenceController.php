<?php

namespace App\Http\Controllers;

use App\Http\Requests\Presence\IsApproveRequest;
use App\Http\Requests\Presence\StorePresenceRequest;
use App\Models\Presence;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function index()
    {
        $presences = Presence::all();
        $data = [];

        $data = collect($presences)
            ->groupBy(function ($item) {
                return substr($item['waktu'], 0, 10);
            })
            ->filter(function ($groups) {
                return $groups->count() !== 1;
            })
            ->map(function ($group) {
                $firstItem = $group->first();
                return [
                    'id_user' => $firstItem['id_users'],
                    'nama_user' => $firstItem->user->nama,
                    'tanggal' => substr($firstItem['waktu'], 0, 10),
                    'waktu_masuk' => substr($group->where('type', 'IN ')->first()['waktu'], 11),
                    'waktu_pulang' => substr($group->where('type', 'OUT')->first()['waktu'], 11),
                    'status_masuk' => $group->where('type', 'IN ')
                        ->where('is_approve', true)
                        ->count() > 0 ? 'APPROVE' : 'REJECT',
                    'status_pulang' => $group->where('type', 'OUT')
                        ->where('is_approve', true)
                        ->count() > 0 ? 'APPROVE' : 'REJECT'
                ];
            })->values()->toArray();

        return response()->json([
            'message' => 'Success get data',
            'data' => $data
        ], 200);
    }

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
