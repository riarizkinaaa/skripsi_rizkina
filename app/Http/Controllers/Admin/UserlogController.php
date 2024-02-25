<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userlog as Model;
use App\Models\Role;

use Illuminate\Support\Facades\Hash;

class UserlogController extends Controller
{
    private $routePrefix = 'userlog';
    //fungsi Untuk menampilkan data Userlog
    public function index(Request $request)
    {
        $data = [
            'title'         => 'Data Userlog',
            'q'             => $request->query('q'),
            'id_role'       => $request->query('id_role'),
            'routePrefix'   => $this->routePrefix,
            'method'        => 'POST',
            'model'         => new Model(),
            'role'          => Role::pluck('role', 'id_role'),
        ];

        // dd($data['role']);
        $query = Model::join('role', 'role.id_role', '=', 'users.id_role')
            ->where(function ($query) use ($data) {
                $query->where('username', 'like', '%' . $data['q'] . '%');
            });
        // $userlogs = Userlog::join('role', 'role.id_role', '=', 'users.id_role')->get();
        if ($data['id_role'])
            $query->where('users.id_role', $data['id_role']);
        $data['models'] = $query->paginate(10)->appends($_GET);
        return view('superadmin.userlog.index', $data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:100',
            'password' => 'required|string|max:100',
            'role' => 'required',
        ]);

        $cek_username = Model::where('username', '=', $request->username)->get()->first();
        if (!$cek_username) {
            if ($request->role == 3 || $request->role == 4 || $request->role == 5) {
                $userlog = Model::create([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'id_role' => $request->role,
                    'aktif' => 0,
                ]);
            } else {
                $userlog = Model::create([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'id_role' => $request->role,
                    'aktif' => 1,
                ]);
            }

            if ($userlog) {
                return redirect()
                    ->route('userlog.index')
                    ->with([
                        'success' => 'New userlog has been created successfully'
                    ]);
            } else {
                return redirect()
                    ->route('userlog.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('userlog.index')
                ->withInput()
                ->with([
                    'error' => 'Username already in use, please try again'
                ]);
        }
    }
    public function edit($id)
    {
        // $userlog = userlog::where('id_userlog', '=', $id)->get()->first();
        $userlog = Model::findOrFail($id);
        // var_dump($userlog);
        echo json_encode($userlog);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username_ubah' => 'required|string|max:100',
            'role_ubah' => 'required',
        ]);
        $userlog = Model::findOrFail($id);
        $cek_username = Model::where('username', '=', $request->username_ubah)->where('id', '!=', $id)->get()->first();
        // var_dump($cek_username);
        // die;
        if (!$cek_username) {
            if (!empty($request->password_ubah)) {
                $userlog->update([
                    'username' => $request->username_ubah,
                    'password' => Hash::make($request->password_ubah),
                    'id_role' => $request->role_ubah,
                    'aktif' => $request->aktif,
                ]);
            } else {
                $userlog->update([
                    'username' => $request->username_ubah,
                    'id_role' => $request->role_ubah,
                    'aktif' => $request->aktif,
                ]);
            }

            if ($userlog) {
                return redirect()
                    ->route('userlog.index')
                    ->with([
                        'success' => 'Userlog has been update successfully'
                    ]);
            } else {
                return redirect()
                    ->route('userlog.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('userlog.index')
                ->withInput()
                ->with([
                    'error' => 'Username already in use, please try again'
                ]);
        }
    }
    public function destroy($id)
    {
        $userlog = Model::findOrFail($id);
        $userlog->delete();

        if ($userlog) {
            return redirect()
                ->route('userlog.index')
                ->with([
                    'success' => 'Userlog has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('userlog.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
