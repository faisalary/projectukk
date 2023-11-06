@extends('layouts.front_layout')

@section('content-main')
<section class="top-companies" style="background: #E5E5E5; margin-top: 80px;">
  <div class="auto-container">
    <div class="sec-title mt-4 mb-4">
      <h4>Informasi Magang</h4>
    </div>

    <div class="card" style="min-width:1280px; height:auto; border-radius: 8px;">
      <div class="card-header" role="tab" id="accordionHeadingOne" style="border-radius: 8px; background-color: white;">
        <div class="mb-0 row">
          <div class="col-12 no-padding accordion-head">
            <a data-toggle="collapse" data-parent="#accordion" href="#accordionBodyOne" aria-expanded="false" aria-controls="accordionBodyOne" class="collapsed " style="color:#4B465C; text-decoration: none;">
              <i class="fa fa-angle-down" aria-hidden="true"></i>
              <h6>Magang Fakultas (1 & 2 Semester)</h6>
            </a>
          </div>
        </div>
      </div>

      <div id="accordionBodyOne" class="collapse" role="tabpanel" aria-labelledby="accordionHeadingOne" aria-expanded="false" data-parent="accordion">
        <div class="card-block col-12">
          
        <p>Magang Fakultas adalah magang pada perusahaan yang disediakan oleh LKM FIT (lihat daftar perusahaan di <a href="https://bit.ly/LowonganKPMagangFIT">https://bit.ly/LowonganKPMagangFIT</a>)
            Proses pendaftaran magang fakultas ini dibantu oleh LKM FIT, sehingga mahasiswa hanya daftar magang <u> di form pendaftaran magang online,</u> proses seleksi dan penerimaan selanjutnya dibantu oleh LKM. </p>
          <p>
            Catatan :
          <ul>
            <li> 1. lowongan magang fakultas terbuka untuk seluruh mahasiswa.</li>
            <li>2. Prodi mungkin akan merekomendasikan mahasiswa tertentu untuk melaksanakan magang fakultas, mahasiswa tersebut wajib mengikuti rekomendasi prodi.</li>
            <li>3. [Magang 6 bulan] Bila magang dilaksanakan kurang dari 6 bulan akibat dari aturan perusahaan, maka mahasiswa direkomendasikan melanjutkan magang di FIT untuk menggenapkan magang menjadi 6 bulan.</li>
            <li>4. [Magang 12 bulan] Bila magang dilaksanakan 12 bulan di perusahaan, maka :
              <ul>
                <li style="margin-left: 20px;"> . Prodi akan melakukan ekivalensi semua nilai mata kuliah sama dengan nilai magang pada 2 semester, yakni semester 5 dan 6 (untuk D3), atau semester 7 dan 8 (untuk Sarjana Terapan);</li>
                <li style="margin-left: 20px;">. Perusahaan harus mengeluarkan 2 kali nilai yakni nilai_1 (untuk 6 bulan pertama) dan nilai_2 (untuk 6 bulan terakhir).</li>
                <li style="margin-left: 20px;"> . Apabila mahasiswa sudah lulus kuliah namun masih magang, maka :
                <li>
                  <ul>
                    <li style="margin-left: 40px;"> i. Nilai yang dimasukkan ke igracias diambil dari Nilai Pembimbing Lapangan saja;</li>
                    <li style="margin-left: 40px;"> ii. Mahasiswa harus melanjutkan magang walau sudah lulus kuliah dengan catatan : ijazah dan berkas kelulusan lainnya diberikan setelah selesai magang 12 bulan. Selesai magang ditandai dengan adanya Sertifikat / Surat Selesai magang dari perusahaan.</li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
          </p>
          <p>
            Informasi selanjutnya mengenai program magang MBKM dan lowongan Magang MBKM dapat klik tombol dibawah ini.
          </p>
          <div class="text-center mb-4">
          <a href="#">
          <button class="btn btn-success">Cari magang </button>
          </a>
          </div>
        </div>
      </div>
    </div>

    <div class="card" style="min-width:1280px; height:auto;border-radius: 8px;">
      <div class="card-header" role="tab" id="accordionHeadingTwo" style="border-radius: 8px;  background-color: white;">
        <div class="mb-0 row">
          <div class="col-12 no-padding accordion-head">
            <a data-toggle="collapse" data-parent="#accordion" href="#accordionBodyTwo" aria-expanded="false" aria-controls="accordionBodyTwo" class="collapsed " style="color:#4B465C; text-decoration: none;">
              <i class="fa fa-angle-down" aria-hidden="true"></i>
              <h6>Magang MBKM - Kampus Merdeka</h6>
            </a>
          </div>
        </div>
      </div>

      <div id="accordionBodyTwo" class="collapse" role="tabpanel" aria-labelledby="accordionHeadingTwo" aria-expanded="false" data-parent="accordion">
        <div class="card-block col-12">
          
        <p>Magang MBKM adalah magang yang dilaksanakan oleh Kemendikbud dan Bagian Perkuliahan Universitas dan Luar Prodi Studi (BPUPLS dahulu PPDU) Universitas Telkom guna mendukung program Merdeka Belajar Kampus Merdeka (MBKM). </p>
          <p>
            Catatan :
          <ul>
            <li>1. Magang MBKM ini biasa di laksanakan pada semester Ganjil (5/7) selama 4 s.d 6 bulan dan bisa di ekuivalensi menjadi 20 SKS mata kuliah non-magang pada semester (5/7), sehingga mahasiswa masih mengambil magang kembali pada semester genap (6/8). Apabila ada lowongan magang MBKM dari pemerintah pada semester genap (6/8), mahasiswa diperkenankan mengikuti magang MBKM kembali untuk memenuhi MK Magang.</li>
            <li>2. [Magang 6 bulan] Bila magang dilaksanakan kurang dari 6 bulan akibat dari aturan perusahaan, maka mahasiswa direkomendasikan melanjutkan magang di FIT untuk menggenapkan magang menjadi 6 bulan.</li>
            <li>3. [Magang 12 bulan] Bila magang dilaksanakan 12 bulan di perusahaan, maka :
              <ul>
                <li style="margin-left: 20px;">. Prodi akan melakukan ekivalensi semua nilai mata kuliah sama dengan nilai magang pada 2 semester, yakni semester 5 dan 6 (untuk D3), atau semester 7 dan 8 (untuk Sarjana Terapan);</li>
                <li style="margin-left: 20px;">. Perusahaan harus mengeluarkan 2 kali nilai yakni nilai_1 (untuk 6 bulan pertama) dan nilai_2 (untuk 6 bulan terakhir).</li>
                <li style="margin-left: 20px;">. Apabila mahasiswa sudah lulus kuliah namun masih magang, maka : </li>
                <li>
                  <ul>
                    <li>a. Nilai yang dimasukkan ke igracias diambil dari Nilai Pembimbing Lapangan saja;</li>
                    <li>b. Mahasiswa harus melanjutkan magang walau sudah lulus kuliah dengan catatan : ijazah dan berkas kelulusan lainnya diberikan setelah selesai magang 12 bulan. Selesai magang ditandai dengan adanya Sertifikat / Surat Selesai magang dari perusahaan atau Kemendikbud.</li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
          </p>
          <p>
            Informasi selanjutnya mengenai program magang MBKM dan lowongan Magang MBKM dapat klik tombol dibawah ini.
          </p>
          <div class="text-center mb-4">
          <a href="#">
          <button class="btn btn-success">Cari magang </button>
          </a>
          </div>
        </div>
      </div>
    </div>

    <div class="card" style="min-width:1280px; height:auto;border-radius: 8px;">
      <div class="card-header" role="tab" id="accordionHeadingThree" style="border-radius: 8px;  background-color: white;">
        <div class="mb-0 row">
          <div class="col-12 no-padding accordion-head">
            <a data-toggle="collapse" data-parent="#accordion" href="#accordionBodyThree" aria-expanded="false" aria-controls="accordionBodyThree" class="collapsed " style="color:#4B465C; text-decoration: none;">
              <i class="fa fa-angle-down" aria-hidden="true"></i>
              <h6>Magang Mandiri</h6>
            </a>
          </div>
        </div>
      </div>

      <div id="accordionBodyThree" class="collapse" role="tabpanel" aria-labelledby="accordionHeadingThree" aria-expanded="false" data-parent="accordion">
        <div class="card-block col-12">
          
        <p>Magang Mandiri adalah magang pada perusahaan di luar yang disediakan oleh LKM FIT. proses administrasi dari magang ini bersifat mandiri sejak pendaftaran hingga pengumpulan berkas.
          </p>

        </div>
      </div>
    </div>

    <div class="card" style="min-width:1280px; height:auto; border-radius:8px;">
      <div class="card-header" role="tab" id="accordionHeadingFour" style="border-radius: 8px;  background-color: white;">
        <div class="mb-0 row">
          <div class="col-12 no-padding accordion-head">
          <a data-toggle="collapse" data-parent="#accordion" href="#accordionBodyFour" aria-expanded="false" aria-controls="accordionBodyFour" class="collapsed " style="color:#4B465C; text-decoration: none; ">
              <i class="fa fa-angle-down" aria-hidden="true"></i>
              <h6>Magang Kerja</h6>
            </a>
          </div>
        </div>
      </div>

      <div id="accordionBodyFour" class="collapse" role="tabpanel" aria-labelledby="accordionHeadingFour" aria-expanded="false" data-parent="accordion">
        <div class="card-block col-12">
          
        <p>
          Magang Kerja adalah kegiatan magang bagi mahasiswa yang telah bekerja dapat diakui pengalaman kerjanya sebagai kegiatan Magang dan Proyek Akhir. Hal tersebut untuk efisiensi waktu kuliah mahasiswa.
          </p>
          <p>
          Catatan : Perusahaan tempat kerja harus berfirma (CV atau PT) dan sudah berjalan selama minimal 3 tahun (dilihat dari Surat Ijin Usaha atau sejenisnya yang dilaporkan kepada LKM FIT).
          </p>
          
        </div>
      </div>
    </div>

    <div class="card mb-4" style="min-width:1280px; height:auto; border-radius:8px;">
      <div class="card-header" role="tab" id="accordionHeadingFive" style="border-radius: 8px;  background-color: white;">
        <div class="mb-0 row">
          <div class="col-12 no-padding accordion-head">
          <a data-toggle="collapse" data-parent="#accordion" href="#accordionBodyFive" aria-expanded="false" aria-controls="accordionBodyFive" class="collapsed " style="color:#4B465C; text-decoration: none;">
              <i class="fa fa-angle-down" aria-hidden="true"></i>
              <h6>Magang StartUp</h6>
            </a>
          </div>
        </div>
      </div>

      <div id="accordionBodyFive" class="collapse" role="tabpanel" aria-labelledby="accordionHeadingFive" aria-expanded="false" data-parent="accordion">
        <div class="card-block col-12">
          
        <p>
          Magang Kerja adalah kegiatan magang bagi mahasiswa yang telah bekerja dapat diakui pengalaman kerjanya sebagai kegiatan Magang dan Proyek Akhir. Hal tersebut untuk efisiensi waktu kuliah mahasiswa.
          </p>
          <p>
          Catatan : Perusahaan tempat kerja harus berfirma (CV atau PT) dan sudah berjalan selama minimal 3 tahun (dilihat dari Surat Ijin Usaha atau sejenisnya yang dilaporkan kepada LKM FIT).
          </p>
          
        </div>
      </div>
    </div>
  </div>
</section>
@endsection