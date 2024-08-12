<?php

namespace App\Http\Controllers\Logbook;

use App\Enums\PendaftaranMagangStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\PendaftaranMagang;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function __construct()
    {
        //
    }

    protected function getPendaftaranMagang($additional = null)
    {
        $this->pendaftaran = PendaftaranMagang::join('mahasiswa', 'mahasiswa.nim', '=', 'pendaftaran_magang.nim')
        ->where('current_step', PendaftaranMagangStatusEnum::APPROVED_PENAWARAN);

        if ($additional != null) $this->pendaftaran = $additional($this->pendaftaran);

        $this->pendaftaran = $this->pendaftaran->get();
        return $this;
    }


}
