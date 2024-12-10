<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LotCreateRequest;
use App\Http\Requests\User\LotUpdateRequest;
use App\Models\Lot;
use Illuminate\Support\Facades\Auth;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $lots = Lot::select('id', 'lot_number', 'created_at')->where('user_id', $userId)->get();
        return view('user.lot.index', compact('lots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.lot.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LotCreateRequest $request)
    {
        try {
            $userId = Auth::id();

            $lot = new Lot();
            $lot->lot_number = $request->lot_number;
            $lot->user_id = $userId;
            $lot->save();

            session()->flash('success', 'Berhasil menambahkan data lot');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return response()->json(['error' => true], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lot = Lot::findOrFail($id);

        $mergedData = $lot->getMergedData();
        $groupedData = $mergedData->chunk(500);

        // Gabungkan data per kelompok
        $displayData = [];
        foreach ($groupedData as $group) {
            $row = [
                'start_serial_number' => $group->first()->serial_number,
                'end_serial_number' => $group->last()->serial_number,
            ];
            $displayData[] = $row;
        }

        return view('user.lot.show', compact('lot', 'displayData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lot = Lot::findOrFail($id);
        return view('user.lot.edit', compact('lot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LotUpdateRequest $request, string $id)
    {
        try {
            $lot = Lot::findOrFail($id);

            $lots = $request->all();
            $lot->fill($lots);

            if ($lot->isDirty()) {
                $lot->save();
                session()->flash('success', 'Berhasil melakukan perubahan data lot');
                return response()->json(['success' => true], 200);
            } else {
                session()->flash('info', "Tidak melakukan perubahan pada data lot");
                return response()->json(['success' => true], 200);
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return response()->json(['error' => true], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lot = Lot::findOrFail($id);
            $lot->delete();

            return response(['status' => 'success', 'message' => 'Berhasil menghapus data lot']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
