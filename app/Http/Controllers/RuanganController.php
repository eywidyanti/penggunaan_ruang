<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RuanganController extends Controller
{
    public function index()
    {

        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            return view('ruangan.index', ['ruangans' => Ruangan::all()]);
        } else {
            return view('ruangan1.index', ['ruangans' => Ruangan::all()]);
        }
    }

    public function create()
    {
        return view('ruangan.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_ruang' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
        ]);

        Ruangan::create($validateData);
        return redirect('/ruangans')->with('pesan', "Ruangan $request->nama_ruang berhasil ditambahkan");
    }

    public function show(Ruangan $ruangan)
    {
        return view('ruangan.show', compact('ruangan'));
    }

    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $validateData = $request->validate([
            'nama_ruang' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
        ]);

        $ruangan->update($validateData);

        return redirect('/ruangans')->with('pesan', "Ruangan $ruangan->nama_ruang berhasil diupdate");
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect('/ruangans')->with('pesan', "Ruangan $ruangan->nama_ruang berhasil dihapus");
    }

    public function search(Request $request)
    {

        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            $query = $request->input('search');

        $results = DB::table('ruangans')
            ->where('nama_ruang', 'like', '%' . $query . '%')
            ->orWhere('status', 'like', '%' . $query . '%')
            ->orWhere('keterangan', 'like', '%' . $query . '%')
            ->get();

        return view('ruangan.search', compact('results'));
        } else {
            $query = $request->input('search');

        $results = DB::table('ruangans')
            ->where('nama_ruang', 'like', '%' . $query . '%')
            ->orWhere('status', 'like', '%' . $query . '%')
            ->orWhere('keterangan', 'like', '%' . $query . '%')
            ->get();

        return view('ruangan1.search', compact('results'));
        }
        
    }
}
