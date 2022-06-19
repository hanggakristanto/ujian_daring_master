<?php

namespace App\Http\Controllers\Admin\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.siswa.index');
    }

    public function dataTable()
    {
        return DataTables::of(Siswa::with('rombel.kelas'))
            ->addIndexColumn()
            ->addColumn('cvs', function ($data) {
                if ($data->cv != null) {
                    return '<a href="' . url('storage/daftar/') . '/' . $data->cv . '" target="_blank">Lihat CV</a>';
                } else {
                    return 'Data Kosong cv!';
                }
            })
            ->escapeColumns('cvs')
            ->addColumn('ijazahs', function ($data) {
                if ($data->ijazah != null) {
                    return '<a href="' . url('storage/daftar/') . '/' . $data->ijazah . '" target="_blank">Lihat Ijazah</a>';
                } else {
                    return 'Data Kosong! ijazah';
                }
            })
            ->escapeColumns('ijazahs')
            ->addColumn('ktps', function ($data) {
                if ($data->ktp != null) {
                    return '<a href="' . url('storage/daftar/') . '/' . $data->ktp . '" target="_blank">Lihat Ktp</a>';
                } else {
                    return 'Data Kosong! ktp';
                }
            })
            ->escapeColumns('ktps')
            ->addColumn('opsi', function ($data) {
                return '<button class="btn btn-xs btn-outline-warning btn-edit" data-id="' . $data->id . '" data-rombel-id="' . $data->rombel->id . '" data-rombel-nama="' . $data->rombel->nama . '" data-nama="' . $data->nama . '" data-nis="' . $data->nis . '" data-jenis-kelamin="' . $data->jenis_kelamin . '"><i class="fas fa-edit"></i> Edit</button>
                <button class="btn btn-xs btn-outline-danger btn-hapus" data-id="' . $data->id . '"><i class="fas fa-trash"></i> Hapus</button>';
            })
            // ->escapeColumns('opsi')
            ->rawColumns(['cvs,ktps,ijazahs,opsi'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        $siswa->load('rombel');

        return response()->json([
            'status' => TRUE,
            'data' => $siswa
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['nis']);
        $siswa = Siswa::create($data);

        return response()->json([
            'status' => TRUE,
            'data' => $siswa
        ], 200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_method');

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa = Siswa::where('id', $id)->update($data);

        return response()->json([
            'status' => TRUE,
            'data' => $siswa
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return response()->json([
            'status' => TRUE
        ], 200);
    }
}
