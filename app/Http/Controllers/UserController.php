<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'name', 'email', 'role' ]);

            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                return '
                <a href="'.route('admin.users.edit', $user->id).'" style="background-color: #3490dc; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none; margin-right: 5px;">
                    Edit
                </a>
                <a href="javascript:void(0)" class="delete" data-id="'.$user->id.'" style="background-color: #e3342f; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none;">
                    Hapus
                </a>';

            })
            ->rawColumns(['action'])
            ->make(true);
        }
    
        return view('admin.users.index');
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,user',
        ]);
        
        try {
            User::create($validated);
            return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Gagal menambah pengguna! ' . $e->getMessage());
        }
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
        return view('admin.users.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string|in:admin,user',
        ]);
        
        try {
            $user->update($validated);
            return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diubah!');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Gagal mengubah data pengguna! ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
{
    $user->delete();
    return response()->json(['success' => 'User berhasil dihapus.']);
}

}
