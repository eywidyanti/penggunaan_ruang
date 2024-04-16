<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            return view('user.index', ['users' => User::all()]);
        } else {
            return view('user1.index', ['users' => User::all()]);
        }
    }

    public function tampil()
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            return view('user.profil', ['users' => User::all()]);
        } else {
            return view('user1.profil', ['users' => User::all()]);
        }
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'foto' => 'required|mimes:jpeg,png,jpg',
            'telp' => 'required',
        ]);

        $file           = $request->file('foto');
        $nama_file      = $file->getClientOriginalName();
        $file->move('img', $file->getClientOriginalName());
        $upload = new User;
        $upload->name = $request->input('name');
        $upload->email = $request->input('email');
        $upload->password = Hash::make($request['password']);
        $upload->role = $request->input('role');
        $upload->foto       = $nama_file;
        $upload->telp = $request->input('telp');


        $upload->save();
        return redirect('/users')->with('pesan', "user $request->name berhasil ditambahkan");
    }


    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'foto' => 'required|mimes:jpeg,png,jpg',
            'telp' => 'required',
        ]);

        $user = User::findOrFail($user->id);

        if ($request->file('foto') == "") {

            $user->update([
                'name'     => $request->name,
                'email'   => $request->email,
                'password'     => Hash::make($request['password']),
                'role'   => $request->role,
                'telp'     => $request->telp
            ]);
        } else {

            //hapus old image
            Storage::disk('local')->delete('public/assets/img' . $user->foto);

            //upload new image
            $file = $request->file('foto');
            $nama_file      = $file->getClientOriginalName();
            $file->move('img', $file->getClientOriginalName());

            $user->update([
                'name'     => $request->name,
                'email'   => $request->email,
                'password'     => Hash::make($request['password']),
                'role'   => $request->role,
                'foto'     => $nama_file,
                'telp'     => $request->telp
            ]);
        }

        return redirect('/users')->with('pesan', "user $user->nama_ruang berhasil diupdate");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('pesan', "user $user->nama_ruang berhasil dihapus");
    }
    public function search(Request $request)
    {

        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            $query = $request->input('search');

            $results = DB::table('users')
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('role', 'like', '%' . $query . '%')
                ->orWhere('foto', 'like', '%' . $query . '%')
                ->orWhere('telp', 'like', '%' . $query . '%')
                ->get();

            return view('user.search', compact('results'));
        } else {
            $query = $request->input('search');

            $results = DB::table('users')
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('role', 'like', '%' . $query . '%')
                ->orWhere('foto', 'like', '%' . $query . '%')
                ->orWhere('telp', 'like', '%' . $query . '%')
                ->get();

            return view('user1.search', compact('results'));
        }
    }
}
