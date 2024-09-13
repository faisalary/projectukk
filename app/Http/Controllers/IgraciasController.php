<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\Universitas;
use Illuminate\Http\Request;

class IgraciasController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:igracias.view');
    }

     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $view = $this->getViewDesign();        

        if ($request->type) {
            switch ($request->type) {
                case 'id_fakultas':
                    $data = Fakultas::select('namafakultas as text', 'id_fakultas as id')->where('id_univ', $request->selected)->get();
                    break;
                case 'id_prodi':
                    $data = ProgramStudi::select('namaprodi as text', 'id_prodi as id')->where('id_fakultas', $request->selected)->get();
                    break;
                case 'kode_dosen':
                    $data = Dosen::where('id_prodi', $request->selected)->get()->transform(function ($item) {
                        $result = new \stdClass();
                        $result->text = $item->kode_dosen . ' | ' . $item->namadosen;
                        $result->id = $item->kode_dosen;
                        return $result;
                    });
                    break;
                default:
                    # code...
                    break;
            }
            return Response::success($data, 'Success');
        }

        $universitas = Universitas::all();                
        return view('masters.igracias.index', compact('universitas', 'view'));
    }

    private function getViewDesign() {       

        $dosen = [
            '
            <th>No</th>
            <th>Universitas</th>
            <th>NIP</th>
            <th style="text-align: center;">KODE DOSEN</th>
            <th>NAMA DOSEN</th>
            <th>NOMOR TELEPON</th>
            <th>EMAIL</th>
            <th class="text-center">STATUS</th>
            <th style="text-align: center;">AKSI</th>                                
            '               
        ];

        $mata_kuliah = [
            '
            <th>No</th>
            <th>KODE MATA KULIAH</th>
            <th>NAMA MATA KULIAH</th>
            <th>UNIVERSITAS & FAKULTAS</th>
            <th style="text-align: center;">SKS</th>
            <th class="text-center">STATUS</th>
            <th style="text-align: center;">AKSI</th>                                    
            '               
        ];

        $mahasiswa = [
           '
            <th>NO</th>
            <th>NAMA/NIM</th>
            <th>UNIVERSITAS & FAKULTAS</th>
            <th class="text-center">TUNGGAKAN BPP</th>
            <th class="text-center">IPK</th>
            <th class="text-center">EPRT</th>
            <th class="text-center">TAK</th>
            <th class="text-center">ANGKATAN</th>
            <th>KONTAK</th>
            <th>ALAMAT</th>
            <th class="text-center">STATUS</th>
            <th style="text-center;">AKSI</th>                           
            '
        ];       
       
        $columnsDosen = "[
            { data: 'DT_RowIndex' },
            { data: 'id_univ', name: 'id_univ' },
            { data: 'nip', name: 'nip' },
            { data: 'kode_dosen', name: 'kode_dosen' },
            { data: 'namadosen', name: 'namadosen' },
            { data: 'nohpdosen', name: 'nohpdosen' },
            { data: 'emaildosen', name: 'emaildosen' },
            { data: 'status', name: 'status' },               
            { data: 'action', name: 'action' }
        ]";      
        
        $columnsMataKuliah = "[
            { data: 'DT_RowIndex' },
            { data: 'kode_mk', name: 'kode_mk' },
            { data: 'namamk', name: 'namamk' },
            { data: 'id_univ', name: 'id_univ' },
            { data: 'sks', name: 'sks' },           
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' }
        ]";
        
        $columnsMahasiswa = "[
            { data: 'DT_RowIndex' },
            { data: 'name', name: 'name' },
            { data: 'univ_fakultas', name: 'univ_fakultas' },
            { data: 'tunggakan_bpp', name: 'tunggakan_bpp' },
            { data: 'ipk', name: 'ipk' },
            { data: 'eprt', name: 'eprt' },
            { data: 'tak', name: 'tak' },
            { data: 'angkatan', name: 'angkatan' },
            { data: 'contact', name: 'contact' },
            { data: 'alamatmhs', name: 'alamatmhs' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' },
        ]";

        $getRoute = function($resource, $action) {
            if($action == 'update' || $action == 'edit') return route("igracias.{$resource}.{$action}", ['id' => ':id']);            
            return route("igracias.{$resource}.{$action}");
        };

        return compact(
            'dosen',
            'mahasiswa',
            'mata_kuliah',
            'columnsDosen',
            'columnsMataKuliah',
            'columnsMahasiswa',
            'getRoute'
        );    
}


}
