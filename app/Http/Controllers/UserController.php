<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Support\LogHelper;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('userDetails')
            ->where('role', '!=', 'super admin')
            ->take(100)
            ->select(['id', 'name', 'username', 'role', 'user_detail_id' ]);

            return DataTables::of($users)
            ->addColumn('hospital', function ($user) {
                return $user->userDetails ? $user->userDetails->hospital : '-';
            })
            ->addColumn('venti', function ($user) {
                return $user->userDetails ? $user->userDetails->venti : '-';
            })
            ->addColumn('bed', function ($user) {
                return $user->userDetails ? $user->userDetails->bed : '-';
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

    public function store(StoreUserRequest $request)
    {    
        $userId = Auth::id();

        $request->validated();
        try {
            DB::transaction(function () use ($request, &$user) {
                $userDetail = UserDetail::create([
                    'hospital' => $request->hospital,
                    'venti' => $request->venti,
                    'bed' => $request->bed
                ]);

                
                $user = User::create([
                    'name' => $request->name,
                    'user_detail_id' => $userDetail->id,
                    'username' => $request->username,
                    'password' => $request->password,
                    'role' => $request->role,
                ]);
            });

            LogHelper::log('Tambah User', "User {$userId} Menambahkan User bernama {$request->name} dengan id {$user->id}");
            return redirect()->route('admin.users.index')
                ->with('success', 'Data Pengguna berhasil disimpan.');
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
        $user = User::with('userDetails')->findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $request->validated();
        
        try {
            DB::transaction(function () use ($request, $id) {
                $userId = User::findOrFail($id);
                $user = User::where('id', $userId)->first();

                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role,
                ]);

                if ($request->password) {
                    $user->update([
                        'password' => bcrypt($request->password),
                    ]);
                }

                $userDetail = $user->userDetails;
                if (!$userDetail) {
                    $userDetail = new UserDetail();
                }

                $userDetail->update([
                    'hospital' => $request->hospital,
                    'venti' => $request->venti,
                    'bed' => $request->bed,
                ]);

                if (!$userDetail->exists) {
                    $userDetail->user_id = $user->id;
                    $userDetail->save();
                }
            });

            LogHelper::log('Edit User', "Mengubah User bernama {$request->name} dengan id {$id}");
            return redirect()->route('admin.users.index')
                ->with('success', 'Data Pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Gagal memperbarui pengguna! ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id, &$user) {
                $user = User::findOrFail($id);
                
                if ($user->userDetails) {
                    $user->userDetails->delete();
                }
                $user->delete();
            });

            LogHelper::log('Hapus User', "Menghapus User bernama {$user->name} dengan id {$id}");
            return response()->json(['success' => 'Data Pengguna berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal Menghapus Pengguna!.'], 500);
        }
    }

}
