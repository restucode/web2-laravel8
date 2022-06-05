<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GuruModel;

class GuruController extends Controller
{

	public function __construct() {
		$this->GuruModel = new GuruModel();
        $this->middleware('auth');
  	}
    public function index()
    {

    	$data = [
    		'guru' => $this->GuruModel->allData(),
    	];
    	return view('v_guru', $data);
    }

    public function detail($id_guru)
    {
        if(!$this->GuruModel->detailData($id_guru)) {
            abort(404);
        }

        $data = [
            'guru' => $this->GuruModel->detailData($id_guru),
        ];

        return view('v_detailguru', $data);
    }

    public function add()
    {
        return view('v_addguru');
    }

    public function insert() {
        request()->validate([
            'nip' => 'required|unique:tbl_guru,nip|min:4|max:5',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'required|mimes:png,jpg,jpeg,bmp|max:1024',
        ], [
            'nip.required' => 'NIP WAJIB DIISI!!!',
            'nip.unique' => 'NIP INI SUDAH ADA!!!',
            'nip.min' => 'NIP MIN. 4 KARAKTER (ANGKA)!!!',
            'nip.max' => 'NIP MAX. 5 KARAKTER (ANGKA)!!!',
            'nama_guru.required' => 'NAMA GURU WAJIB DIISI!!!',
            'mapel.required' => 'MATA PELAJARAN WAJIB DIISI!!!',
            'foto_guru.required' => 'FOTO GURU WAJIB DIISI!!!',
        ]);

        $file = Request()->foto_guru;
        $fileName = Request()->nip.'.'.$file->extension();
        $file->move(public_path('img'), $fileName);

        $data = [
            'nip' => Request()->nip,
            'nama_guru' => Request()->nama_guru,
            'mapel' => Request()->mapel,
            'foto_guru' => $fileName,
        ];

        $this->GuruModel->addData($data);

        return redirect()->route('guru')->with('pesan', 'Data Berhasil Ditambahkan!!!');
    }

    public function edit($id_guru)
    {
        if(!$this->GuruModel->detailData($id_guru)) {
            abort(404);
        }

        $data = [
            'guru' => $this->GuruModel->detailData($id_guru),
        ];
        return view('v_editguru', $data);
    }

    public function update($id_guru) {
        request()->validate([
            'nip' => 'required|min:4|max:5',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'mimes:png,jpg,jpeg,bmp|max:1024',
        ], [
            'nip.required' => 'NIP WAJIB DIISI!!!',
            'nip.unique' => 'NIP INI SUDAH ADA!!!',
            'nip.min' => 'NIP MIN. 4 KARAKTER (ANGKA)!!!',
            'nip.max' => 'NIP MAX. 5 KARAKTER (ANGKA)!!!',
            'nama_guru.required' => 'NAMA GURU WAJIB DIISI!!!',
            'mapel.required' => 'MATA PELAJARAN WAJIB DIISI!!!',
            'foto_guru.required' => 'FOTO GURU WAJIB DIISI!!!',
        ]);

        if(Request()->foto_guru <> "") {
            //jika ingin mengganti foto
            //upload gambar atau foto

            $file = Request()->foto_guru;
            $fileName = Request()->nip.'.'.$file->extension();
            $file->move(public_path('img'), $fileName);

            $data = [
                'nip' => Request()->nip,
                'nama_guru' => Request()->nama_guru,
                'mapel' => Request()->mapel,
                'foto_guru' => $fileName,
            ];

            $this->GuruModel->editData($id_guru, $data);
        } else {
            $data = [
                'nip' => Request()->nip,
                'nama_guru' => Request()->nama_guru,
                'mapel' => Request()->mapel,
            ];

            $this->GuruModel->editData($id_guru, $data);
        }

        return redirect()->route('guru')->with('pesan', 'Data Berhasil di Update!!!!');

    }

    public function delete($id_guru) {
        // Hapus Image
        $guru = $this->GuruModel->detailData($id_guru);
        if($guru->foto_guru <> "") {
            unlink(public_path('img/').$guru->foto_guru);
        }
        $this->GuruModel->deleteData($id_guru);
        return redirect()->route('guru')->with('pesan', 'Data Berhasil Di Hapus !!!');
    }
}
