<?php

namespace App\Http\Controllers;

use App\Models\Penggunaan;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenggunaanController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            $penggunaan = DB::table('penggunaans')
                ->select('penggunaans.*', 'name', 'nama_ruang')
                ->join('users', 'users.id', '=', 'penggunaans.user')
                ->join('ruangans', 'ruangans.id', '=', 'penggunaans.ruang')
                ->get();
            return view('penggunaan.index', ['penggunaans' => $penggunaan]);
        } else {
            $penggunaan = DB::table('penggunaans')
                ->select('penggunaans.*', 'name', 'nama_ruang')
                ->join('users', 'users.id', '=', 'penggunaans.user')
                ->join('ruangans', 'ruangans.id', '=', 'penggunaans.ruang')
                ->get();
            return view('penggunaan1.index', ['penggunaans' =>  $penggunaan]);
        }
    }

    public function report()
    {
            return view('laporan.lappenggunaan.search', ['penggunaans' => Penggunaan::all()]);
    }

    public function tampil(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $results = DB::table('penggunaans')
        ->whereBetween('tanggal', [$start_date, $end_date])
            ->get();

            return view('laporan.lappenggunaan.tampil', compact('results'));
    }

    

    public function create($ruangan)
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            $id = Auth::user()->id;
            return view('penggunaan.create', ['id' =>  $id, 'ruangan' =>  $ruangan]);
        
        } else {
            $id = Auth::user()->id;
        return view('penggunaan1.create', ['id' =>  $id, 'ruangan' =>  $ruangan]);
    }
        }
        

    public function store(Request $request)
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            $validateData = $request->validate([
                'nim' => 'required',
                'nama' => 'required',
                'kelas' => 'required',
                'telp' => 'required',
                'tanggal' => 'required',
                'jam_masuk' => 'required',
                'jam_keluar' => 'required',
                'user' => 'required',
                'ruang' => 'required',
            ]);
    
            DB::table('penggunaans')->insert([
                [
                    'nim' => $request->nim,
                    'nama' => $request->nama,
                    'kelas' => $request->kelas,
                    'telp' => $request->telp,
                    'tanggal' => $request->tanggal,
                    'jam_masuk' => $request->jam_masuk,
                    'jam_keluar' => $request->jam_keluar,
                    'status' => 'Kembalikan',
                    'user' => $request->user,
                    'ruang' => $request->ruang
                ],
            ]);
    
    
    
            //penggunaan::create($data);
            DB::table('ruangans')
                ->where('id', $request->ruang)
                ->update(['status' => 'Terpakai']);
            return redirect('/penggunaans')->with('pesan', "Penggunaan $request->nama berhasil meminjam");
        
        } else {
            $validateData = $request->validate([
                'nim' => 'required',
                'nama' => 'required',
                'kelas' => 'required',
                'telp' => 'required',
                'tanggal' => 'required',
                'jam_masuk' => 'required',
                'jam_keluar' => 'required',
                'user' => 'required',
                'ruang' => 'required',
            ]);
    
            DB::table('penggunaans')->insert([
                [
                    'nim' => $request->nim,
                    'nama' => $request->nama,
                    'kelas' => $request->kelas,
                    'telp' => $request->telp,
                    'tanggal' => $request->tanggal,
                    'jam_masuk' => $request->jam_masuk,
                    'jam_keluar' => $request->jam_keluar,
                    'status' => 'Kembalikan',
                    'user' => $request->user,
                    'ruang' => $request->ruang
                ],
            ]);
    
    
    
            //penggunaan::create($data);
            DB::table('ruangans')
                ->where('id', $request->ruang)
                ->update(['status' => 'Terpakai']);
            return redirect('/penggunaans')->with('pesan', "Penggunaan $request->nama berhasil meminjam");
    }
    }

    public function show(Penggunaan $penggunaan)
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            return view('penggunaan.show', compact('penggunaan'));
        
        } else {
            return view('penggunaan1.show', compact('penggunaan'));
    }
       
    }

    public function edit(Penggunaan $penggunaan)
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            return view('penggunaan.edit', compact('penggunaan'));
        
        } else {
            return view('penggunaan1.edit', compact('penggunaan'));
    }
    }

    public function update(Request $request, Penggunaan $penggunaan)
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            $validateData = $request->validate([
                'nim' => 'required',
                'nama' => 'required',
                'kelas' => 'required',
                'telp' => 'required',
                'tanggal' => 'required',
                'jam_masuk' => 'required',
                'jam_keluar' => 'required',
                'user' => 'required',
                'ruang' => 'required',
            ]);
    
            DB::table('penggunaans')
                ->where('id', $penggunaan->id)
                ->update(
                    [
                        'status' => 'Selesai',
                    ]
                );
    
            DB::table('ruangans')
                ->where('id', $penggunaan->ruang)
                ->update(['status' => 'Kosong']);
    
            return redirect('/penggunaans')->with('pesan', "Penggunaan Ruang berhasil dikembalikan");
        
        } else {
            $validateData = $request->validate([
                'nim' => 'required',
                'nama' => 'required',
                'kelas' => 'required',
                'telp' => 'required',
                'tanggal' => 'required',
                'jam_masuk' => 'required',
                'jam_keluar' => 'required',
                'user' => 'required',
                'ruang' => 'required',
            ]);
    
            DB::table('penggunaans')
                ->where('id', $penggunaan->id)
                ->update(
                    [
                        'status' => 'Selesai',
                    ]
                );
    
            DB::table('ruangans')
                ->where('id', $penggunaan->ruang)
                ->update(['status' => 'Kosong']);
    
            return redirect('/penggunaans')->with('pesan', "Penggunaan Ruang berhasil dikembalikan");
    }
      
    }

    public function destroy(Penggunaan $penggunaan)
    {
        $penggunaan->delete();
        return redirect('/penggunaans')->with('pesan', "Penggunaan  berhasil dihapus");
    }

    public function search(Request $request)
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            $query = $request->input('search');

            $results = DB::table('penggunaans')
                ->where('nim', 'like', '%' . $query . '%')
                ->orWhere('nama', 'like', '%' . $query . '%')
                ->orWhere('telp', 'like', '%' . $query . '%')
                ->orWhere('kelas', 'like', '%' . $query . '%')
                ->orWhere('tanggal', 'like', '%' . $query . '%')
                ->orWhere('jam_masuk', 'like', '%' . $query . '%')
                ->orWhere('jam_keluar', 'like', '%' . $query . '%')
                ->orWhere('status', 'like', '%' . $query . '%')
                ->get();

            return view('penggunaan.search', compact('results'));
        } else {
            $query = $request->input('search');

            $results = DB::table('penggunaans')
                ->where('nim', 'like', '%' . $query . '%')
                ->orWhere('nama', 'like', '%' . $query . '%')
                ->orWhere('telp', 'like', '%' . $query . '%')
                ->orWhere('kelas', 'like', '%' . $query . '%')
                ->orWhere('tanggal', 'like', '%' . $query . '%')
                ->orWhere('jam_masuk', 'like', '%' . $query . '%')
                ->orWhere('jam_keluar', 'like', '%' . $query . '%')
                ->orWhere('status', 'like', '%' . $query . '%')
                ->get();

            return view('penggunaan1.search', compact('results'));
        }
    }

    public function PenggunaanReport(Request $request){
        $penggunaan = Penggunaan::all();

        $pdf = \PDF::loadView('laporan.lappenggunaan.report',['penggunaans'=>$penggunaan]);

        // return $pdf->download('penggunaan_report.pdf');
        return $pdf->stream('penggunaan_report.pdf');
    }
}
