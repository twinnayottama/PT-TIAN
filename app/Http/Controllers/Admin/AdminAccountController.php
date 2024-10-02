<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.account.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountCreateRequest $request)
    {
        try {
            // Simpan data ke database
            User::create($request->all());

            session()->flash('success', 'Berhasil menambahkan data penguna');
        } catch (\Exception $e) {
            session()->flash('error', "Terdapat kesalahan" . $e->getMessage());
        }

        // Redirect ke halaman index
        return redirect()->route('admin.account.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.account.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);

            // Update hanya password
            $user->update([
                'password' => bcrypt($request->input('password'))
            ]);

            session()->flash('success', 'Berhasil memperbarui kata sandi pengguna');
        } catch (\Exception $e) {
            session()->flash('error', "Terdapat kesalahan" . $e->getMessage());
        }

        // Redirect ke halaman index
        return redirect()->route('admin.account.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response(['status' => 'success', 'message' => 'Anda berhasil menghapus data']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
