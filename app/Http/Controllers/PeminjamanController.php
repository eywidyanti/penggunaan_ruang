<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    public function index()
    {

        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            $Peminjaman = DB::table('peminjamen')
                ->select('peminjamen.*', 'name', 'nama_ruang')
                ->join('users', 'users.id', '=', 'Peminjamen.user')
                ->join('ruangans', 'ruangans.id', '=', 'Peminjamen.ruang')
                ->get();
            return view('peminjaman.index', ['peminjamans' => $Peminjaman]);
        } else {
            $Peminjaman = DB::table('peminjamen')
                ->select('peminjamen.*', 'name', 'nama_ruang')
                ->join('users', 'users.id', '=', 'Peminjamen.user')
                ->join('ruangans', 'ruangans.id', '=', 'Peminjamen.ruang')
                ->get();
            return view('peminjaman1.index', ['peminjamans' =>  $Peminjaman]);
        }
    }
    public function report()
    {
            return view('laporan.lappeminjaman.search', ['peminjamans' => Peminjaman::all()]);
    }

    public function tampil(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $results = DB::table('peminjamen')
        ->whereBetween('tanggal', [$start_date, $end_date])
            ->get();

            return view('laporan.lappeminjaman.tampil', compact('results'));
    }

    public function create($ruangan)
    {

        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            $id = Auth::user()->id;
            return view('peminjaman.create', ['id' =>  $id, 'ruangan' =>  $ruangan]);
        } else {
            $id = Auth::user()->id;
            return view('peminjaman1.create', ['id' =>  $id, 'ruangan' =>  $ruangan]);
        }
    }

    public function store(Request $request)
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {

            $validateData = [
                'nim' => 'required',
                'nama' => 'required',
                'kelas' => 'required',
                'telp' => 'required',
                'tanggal' => 'required',
                'keperluan' => 'required',
                'jam_masuk' => 'required',
                'jam_keluar' => 'required',
                'jam_kembali' => '',
                'user' => 'required',
                'ruang' => 'required',
            ];

            DB::table('peminjamen')->insert([
                [
                    'nim' => $request->nim,
                    'nama' => $request->nama,
                    'kelas' => $request->kelas,
                    'telp' => $request->telp,
                    'tanggal' => $request->tanggal,
                    'keperluan' => $request->keperluan,
                    'jam_masuk' => $request->jam_masuk,
                    'jam_keluar' => $request->jam_keluar,
                    'jam_kembali' => $request->jam_kembali,
                    'denda' => 'None',
                    'status' => 'Kembalikan',
                    'user' => $request->user,
                    'ruang' => $request->ruang
                ],
            ]);


            DB::table('ruangans')
                ->where('id', $request->ruang)
                ->update(['status' => 'Terpakai']);
            return redirect('/peminjamans')->with('pesan', "Peminjaman $request->nama berhasil meminjam");
        } else {

            $validateData = [
                'nim' => 'required',
                'nama' => 'required',
                'kelas' => 'required',
                'telp' => 'required',
                'tanggal' => 'required',
                'keperluan' => 'required',
                'jam_masuk' => 'required',
                'jam_keluar' => 'required',
                'jam_kembali' => '',
                'user' => 'required',
                'ruang' => 'required',
            ];

            DB::table('peminjamen')->insert([
                [
                    'nim' => $request->nim,
                    'nama' => $request->nama,
                    'kelas' => $request->kelas,
                    'telp' => $request->telp,
                    'tanggal' => $request->tanggal,
                    'keperluan' => $request->keperluan,
                    'jam_masuk' => $request->jam_masuk,
                    'jam_keluar' => $request->jam_keluar,
                    'jam_kembali' => $request->jam_kembali,
                    'denda' => 'None',
                    'status' => 'Kembalikan',
                    'user' => $request->user,
                    'ruang' => $request->ruang
                ],
            ]);

            DB::table('ruangans')
                ->where('id', $request->ruang)
                ->update(['status' => 'Terpakai']);
            return redirect('/peminjamans')->with('pesan', "Peminjaman $request->nama berhasil meminjam");
        }
    }

    public function show(Peminjaman $peminjaman)
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            return view('peminjaman.show', compact('peminjaman'));
        } else {
            return view('peminjaman1.show', compact('peminjaman'));
        }
    }

    public function edit(Peminjaman $peminjaman)
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            return view('peminjaman.edit', compact('peminjaman'));
        } else {
            return view('peminjaman1.edit', compact('peminjaman'));
        }
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            $validateData = $request->validate([
                'jam_kembali' => 'required',
            ]);

            $denda = 'None';

            if ($peminjaman->jam_keluar < $request->jam_kembali) {

                $awal  = date_create($peminjaman->jam_keluar);
                $akhir = date_create($request->jam_kembali); // waktu sekarang
                $diff  = date_diff($awal, $akhir);

                $denda = $diff->h . ' jam, ' . $diff->i . ' menit ';
            }

            DB::table('peminjamen')
                ->where('id', $peminjaman->id)
                ->update(
                    [
                        'jam_kembali' => $request->jam_kembali,
                        'denda' => $denda,
                        'status' => 'Selesai',
                    ]
                );

            DB::table('ruangans')
                ->where('id', $peminjaman->ruang)
                ->update(['status' => 'Kosong']);

            return redirect('/peminjamans')->with('pesan', "Peminjaman $peminjaman->ruang berhasil dikembalikan");
        } else {
            $validateData = $request->validate([
                'jam_kembali' => 'required',
            ]);

            $denda = 'None';

            if ($peminjaman->jam_keluar < $request->jam_kembali) {

                $awal  = date_create($peminjaman->jam_keluar);
                $akhir = date_create($request->jam_kembali); // waktu sekarang
                $diff  = date_diff($awal, $akhir);

                $denda = $diff->h . ' jam, ' . $diff->i . ' menit ';
            }

            DB::table('peminjamen')
                ->where('id', $peminjaman->id)
                ->update(
                    [
                        'jam_kembali' => $request->jam_kembali,
                        'denda' => $denda,
                        'status' => 'Selesai',
                    ]
                );

            DB::table('ruangans')
                ->where('id', $peminjaman->ruang)
                ->update(['status' => 'Kosong']);

            return redirect('/peminjamans')->with('pesan', "Peminjaman $peminjaman->ruang berhasil dikembalikan");
        }
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect('/peminjamans')->with('pesan', "Peminjaman ruang berhasil dihapus");
    }

    public function search(Request $request)
    {
        $role = Auth::user()->role;

        if ($role == 'Akademik') {
            $query = $request->input('search');

            $results = DB::table('peminjamen')
                ->where('nim', 'like', '%' . $query . '%')
                ->orWhere('nama', 'like', '%' . $query . '%')
                ->orWhere('telp', 'like', '%' . $query . '%')
                ->orWhere('kelas', 'like', '%' . $query . '%')
                ->orWhere('keperluan', 'like', '%' . $query . '%')
                ->orWhere('tanggal', 'like', '%' . $query . '%')
                ->orWhere('jam_masuk', 'like', '%' . $query . '%')
                ->orWhere('jam_keluar', 'like', '%' . $query . '%')
                ->orWhere('jam_kembali', 'like', '%' . $query . '%')
                ->orWhere('denda', 'like', '%' . $query . '%')
                ->orWhere('status', 'like', '%' . $query . '%')
                ->get();

            return view('peminjaman.search', compact('results'));
        } else {
            $query = $request->input('search');

            $results = DB::table('peminjamen')
                ->where('nim', 'like', '%' . $query . '%')
                ->orWhere('nama', 'like', '%' . $query . '%')
                ->orWhere('telp', 'like', '%' . $query . '%')
                ->orWhere('kelas', 'like', '%' . $query . '%')
                ->orWhere('keperluan', 'like', '%' . $query . '%')
                ->orWhere('tanggal', 'like', '%' . $query . '%')
                ->orWhere('jam_masuk', 'like', '%' . $query . '%')
                ->orWhere('jam_keluar', 'like', '%' . $query . '%')
                ->orWhere('jam_kembali', 'like', '%' . $query . '%')
                ->orWhere('denda', 'like', '%' . $query . '%')
                ->orWhere('status', 'like', '%' . $query . '%')
                ->get();

            return view('peminjaman1.search', compact('results'));
        }
    }
    public function PeminjamanReport(Request $request){
        $peminjaman = Peminjaman::all();

        $pdf = PDF::loadView('laporan.lappeminjaman.report',['peminjamans'=>$peminjaman]);

        return $pdf->stream('peminjaman_report.pdf');
    }
}
