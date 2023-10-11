@extends('layouts.front_layout')
@section('content-main')
<section>
    <div class="container" style="max-width: 1600px;">
        <div style="margin-top: 100px; margin-bottom: 25px; ">
            <h1>Anda akan melamar di PT ABCD</h1>
        </div>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                </svg></strong>&ensp; Silahkan lakukan pengisian data dengan minimal kelengkapan 70% untuk melanjutkan
            proses melamar pekerjaan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</section>
<section>
    <div class="container" style="max-width: 1600px;">
        <div class="card col-12 mb-5" style="height:auto;">
            <div style="margin-top: 15px; margin-left: 20px; ">
                <h4>Informasi Data Diri</h4>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-2 ">
                        <img src="{{ asset('front/assets/img/profile.png') }}" class="img-fluid" alt="" style="height:150px; widht:150px;">
                    </div>
                    <div class="form-group col-md-7">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Alamat Email</th>
                                    <th scope="col">Pendidikan</th>
                                    <th scope="col">Negara</th>
                                    <th scope="col">Marital Status</th>
                                </tr>
                                <tr>
                                    <td>Jhon Doe</td>
                                    <td>jhondoe123@gmail.com</td>
                                    <td>Sarjana Ilmu Komputer</td>
                                    <td>Indonesia</td>
                                    <td>Belum Menikah</td>
                                </tr>
                                <tr>
                                    <th scope="col">Headline</th>
                                    <th scope="col">Nomor Telepon</th>
                                    <th scope="col">Tanggal lahir</th>
                                    <th scope="col">Kota</th>
                                    <th scope="col">Jenis Kelamin</th>
                                </tr>
                                <tr>
                                    <td>UI/UX Designer</td>
                                    <td>+62 8799767868</td>
                                    <td>23 Agustus 2009</td>
                                    <td>Bekasi</td>
                                    <td>Laki-Laki</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="row mb-2">
                            <div class="col-6">Kelengkapan Profile</div>
                            <div class="col-6 text-right">60%</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 75%; background-color:#4EA971" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="ml-0 mt-4">
                            <button type="button" class="btn btn-outline-success">Lengkapi Profile</button>
                        </div>
                    </div>
                    <div style="margin-left:265px; margin-top:-20px;">
                        <button class="btn btn-outline-dark"><i class="fa fa-eye"></i>&ensp;Pratinjau</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container" style="max-width: 1600px;">
        <div class="card col-12 mb-5" style="height:auto">
            <div class="card-header" style="background-color:white;">
                <h1>Silahkan Jawab Pertanyaan Di Bawah Ini</h1>
            </div>
            <div class="card-body">
                <form>
                    <p style="font-size: 20px;"> 1. Tools apa saja yang anda kuasai untuk department desain grafis?</p>
                    <input style="margin-left:20px;" type="checkbox" id="jawaban1a" name="jawaban1" value="" disabled>
                    <label for="jawaban1a">Canva</label><br>
                    <input style="margin-left:20px;" type="checkbox" id="jawaban1b" name="jawaban1" value="" disabled>
                    <label for="jawaban1b">Figma</label><br>
                    <input style="margin-left:20px;" type="checkbox" id="jawaban1c" name="jawaban1" value="" disabled>
                    <label for="jawaban1a">Adobe Suite</label><br>
                    <p style="font-size: 20px;"> 2. Apakah anda memiliki pengalaman yang relevan dengan posisi ini?</p>
                    <input style="margin-left:20px;" type="radio" id="memiliki" name="jawaban2" value="" disabled>
                    <label for="memiliki">Memiliki</label><br>
                    <input style="margin-left:20px;" type="radio" id="tidakmemiliki" name="jawaban2" value="" disabled>
                    <label for="tidakmemiliki">Tidak Memiliki</label><br>
                    <p style="font-size: 20px;"> 3. Apa yang akan anda lakukan jika suatu hari dipindahkan ke department
                        tertentu?</p>
                    <textarea style="margin-left:20px; height :40px; width: 800px;" class="form-control" name="jawaban4" placeholder="Tulis disini." disabled></textarea><br>
                    <p style="font-size: 20px;"> 4. Dimanakah Perusahaan abcdgdh?</p>
                    <textarea style="margin-left:20px; width: 800px;" class="form-control" name="jawaban4" placeholder="Tulis disini" disabled></textarea>
                </form>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container" style="max-width: 1600px;">
        <div class="card col-12 mb-5" style="height:auto">
            <div class="card-body">
                <form>
                    <h4> Mengapa Kami Harus Menerima Anda?</h4>
                    <textarea class="form-control" name="jawaban4" placeholder="Tulis disini" disabled></textarea><br>
                    <input type="checkbox" id="jawaban1a" name="jawaban1" value="" disabled>
                    <label for="jawaban1a">Saya tidak memiliki surat lamaran kerja</label>
                    <p style="margin-bottom: 1px;">Unggah surat lamaran kerja</p>
                    <div class="input-group mb-3 mt-0">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button">Choose File</button>
                        </div>
                        <input type="text" class="form-control" placeholder="No choose file" disabled>
                    </div>
                    <div class="button-kirim">
                        <button type="button" class="btn btn-secondary" disabled>Kirim Lamaran Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-6 mb-5">
                <div class="card">
                    <div class="card-body">
                        <h4>Ringkasan Pekerjaan</h4><br>
                        <h5>Lowongan di unggah:</h5><br>
                        <tr>
                            <h6>
                                <td>Batas melamar :</td>
                                <td>23 Agustus 2023</td>
                            </h6><br>
                        </tr>
                        <tr>
                            <h6>
                                <td>Lokasi lowongan :</td>
                                <td>Jl. Gatot Soebroto, Jakarta Pusat</td>
                            </h6><br>
                        </tr>
                        <tr>
                            <h6>
                                <td>Tipe pekerjaan :</td>
                                <td>Full Time</td>
                            </h6><br>
                        </tr>
                        <tr>
                            <h6>
                                <td>Tingkat pengalaman :</td>
                                <td></td>
                            </h6>
                        </tr>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-5">
                <div class="card">
                    <div class="card-body">
                        <h4>Tentang Perusahaan</h4><br>
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ asset('front/assets/img/logo_wings.png') }}" class="img-fluid" alt="" style="height:100px; widht:100px;">
                            </div>
                            <div class="col-6">
                                <h2>PT Wings Surya</h2>
                                <p>Fast Moving Consumer Goods</p>
                            </div>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <div class="row">
                            <div class="col-6">
                                <tr>
                                    <h5>
                                        <td>Phone :</td>
                                        <td>+629123456789</td>
                                    </h5>
                                </tr>
                                <tr>
                                    <h5>
                                        <td>E-mail :</td>
                                        <td>recruiter@wings.id</td>
                                    </h5>
                                </tr>
                            </div>
                            <div class="col-6">
                                <tr>
                                    <h5>
                                        <td>Website :</td>
                                        <td>www.wingsfood.com</td>
                                    </h5>
                                </tr>
                                <tr>
                                    <h5>
                                        <td>Social Media :</td>
                                        <td class="social-link">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-youtube"></i></a>
                                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        </td>
                                    </h5>
                                </tr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection