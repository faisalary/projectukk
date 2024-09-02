<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\LowonganMagang;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Enums\PendaftaranMagangStatusEnum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RejectionPenawaranLowongan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $valid_step;
    /**
     * Create a new job instance.
     */
    public function __construct(public mixed $lowongan = null)
    {
        $this->valid_step = [
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_1 => 1,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_2 => 2,
            PendaftaranMagangStatusEnum::APPROVED_SELEKSI_TAHAP_3 => 3,
        ];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pendaftarMagang = PendaftaranMagang::query();
        $lowongan = LowonganMagang::where('date_confirm_closing', '<', now()->format('Y-m-d'));
        if ($this->lowongan != null) {
            if (is_string($this->lowongan)) {
                $lowongan = $lowongan->whereIn('id_lowongan', [$this->lowongan])->get();
            } elseif (is_array($this->lowongan)) {
                $lowongan = $lowongan->whereIn('id_lowongan', $this->lowongan)->get();
            } elseif ($this->lowongan instanceof LowonganMagang) {
                $lowongan = $this->lowongan->where('date_confirm_closing', '<', now()->format('Y-m-d'))->get();
            }
        } else {
            $lowongan = $lowongan->get();
        }

        $id_lowongans = $lowongan->pluck('id_lowongan')->toArray();
        $pendaftarMagang = $pendaftarMagang->whereIn('id_lowongan', $id_lowongans);

        foreach ($pendaftarMagang->get() as $key => $value) {
            if (isset($this->valid_step[$value->current_step]) && $this->valid_step[$value->current_step] == ($lowongan->where('id_lowongan', $value->id_lowongan)->first()->tahapan_seleksi + 1)) {
                $value->current_step = PendaftaranMagangStatusEnum::REJECTED_PENAWARAN;
                $value->save();
            }
        }
    }
}
