<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\MailContainer;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use App\Models\PegawaiIndustri;
use App\Models\PendaftaranMagang;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Enums\PendaftaranMagangStatusEnum;
use App\Enums\TemplateEmailListProsesEnum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMailIndustri implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public User $from,
        public $to, 
        public $proses, 
        public $id_pendaftaran
    ){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pegawaiIndustri = PegawaiIndustri::where('id_user', $this->from->id)->first();

        $templateEmail = new TemplateEmailListProsesEnum($this->proses);
        $templateEmail->getEmailTemplate($pegawaiIndustri->id_industri);
        $listTag = $templateEmail->getListTag($this->proses);
        $templateEmail = collect($templateEmail->data)->first();

        $result = self::mappingData($this->id_pendaftaran, $listTag, $templateEmail['template']['content']);

        dispatch(new SendMailJob($this->to, new MailContainer($templateEmail['template']['subject'], $result)));
    }

    private function mappingData($id_pendaftaran, $listTag, $dataTemplate)
    {
        $pendaftaranMagang = PendaftaranMagang::select(
            'mahasiswa.namamhs', 'mahasiswa.nim', 'pendaftaran_magang.current_step', 'lowongan_magang.intern_position', 
            'lowongan_magang.durasimagang', 'industri.namaindustri', 'industri.notelpon as notelponindustri', 'industri.alamatindustri',
            'industri.email as emailindustri', 'pegawai_industri.namapeg', 'pegawai_industri.jabatan as jabatanpeg', 'pegawai_industri.emailpeg',
            'pegawai_industri.nohppeg'
        )
        ->join('mahasiswa', 'mahasiswa.nim', 'pendaftaran_magang.nim')
        ->join('lowongan_magang', 'lowongan_magang.id_lowongan', 'pendaftaran_magang.id_lowongan')
        ->join('industri', 'industri.id_industri', 'lowongan_magang.id_industri')
        ->join('pegawai_industri', 'pegawai_industri.id_peg_industri', 'industri.penanggung_jawab')
        ->where('id_pendaftaran', $id_pendaftaran)->first();

        $arraySearch = [];
        $arrayReplace = [];
        foreach ($listTag as $key => $value) {
            $arraySearch[] = $value['shortCode'];
            if ($value['columnName'] == 'current_step') {
                $status = PendaftaranMagangStatusEnum::getWithLabel($pendaftaranMagang->{$value['columnName']})['title'];
                $arrayReplace[] = $status;
            } else {
                $arrayReplace[] = $pendaftaranMagang->{$value['columnName']};
            }
        }

        $result = str_replace($arraySearch, $arrayReplace, $dataTemplate);
        return $result;
    }
}
