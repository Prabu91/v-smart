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

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('userDetails')
            ->where('role', '!=', 'admin')
            ->take(100)
            ->select(['id', 'name', 'email', 'role', 'user_detail_id' ]);

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

    public function store(StoreUserRequest $request)
    {    
        $request->validated();

        try {
            DB::transaction(function () use ($request) {
                $userDetail = UserDetail::create([
                    'hospital' => $request->hospital,
                    'venti' => $request->venti,
                    'bed' => $request->bed
                ]);

                
                User::create([
                    'name' => $request->name,
                    'user_detail_id' => $userDetail->id,
                    'email' => $request->email,
                    'password' => $request->password,
                    'role' => $request->role,
                ]);
            });

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
                $user = User::findOrFail($id);

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

                $userDetail = $user->userDetails; // Mengambil relasi userDetails jika sudah ada
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
            DB::transaction(function () use ($id) {
                $user = User::findOrFail($id);
                
                if ($user->userDetails) {
                    $user->userDetails->delete();
                }
                $user->delete();
            });

            return response()->json(['success' => 'Data Pengguna berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal Menghapus Pengguna!.'], 500);
        }
    }

}
