<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak as Model;
use App\Models\Anak;
use App\Models\Survior;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Dusun;
use App\Models\KelasPendidikan;
use  Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PimpinanController extends Controller
{
    //
    public function index()
    {
        return view('pimpinan.dashboard');
    }
     

    public function show($id)
{
    // Logic untuk menampilkan data dengan ID tertentu
}
}
