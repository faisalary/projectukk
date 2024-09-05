<div class="m-auto tab-pane fade show active" style="width: 100%;" id="v-pills-informasi-pribadi" role="tabpanel" aria-labelledby="v-pills-informasi-pribadi-tab">
    @if (auth()->user()->hasRole('Dosen'))
        <h2 class="mx-3 mt-3 mb-3">Profile Dosen</h2>
    @elseif(auth()->user()->hasRole('Mitra'))
        <h2 class="mx-3 mt-3 mb-3">Profile Mitra</h2>
    @elseif(auth()->user()->hasRole('LKM'))
        <h2 class="mx-3 mt-3 mb-3">Profile LKM</h2>
    @endif
    <div id="profile" class="border rounded mx-3 mb-4">
        <div>
            <h4 class="border-bottom mx-3 font-light text-secondary py-3">Foto Profile</h4>
        </div>
        <div class="d-flex align-items-center mx-4 my-5">
            {{-- <img src="{{ url('storage/foto/'.$user->foto) ? isset($user->foto) : asset('app-assets/img/avatars/user.png') }}" alt="Profile Image" class="profile-pic rounded-circle" id="foto"> --}}
            <img src="{{ isset($user->foto) ?  url('storage/foto/'.$user->foto) : asset('app-assets/img/avatars/user.png') }}" width="15%" alt="Profile Image" class="profile-pic rounded-circle" id="foto" style= "width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
            <input type="file" id="foto" accept="image/*" style="display: none;">
            <button id="uploadButton" class="mx-4 btn btn-success" data-bs-toggle="modal" data-bs-target="#ganti">Ganti</button>
            @include('profile.detail-profile-dosen&mitra.ganti')
            <form action="{{route ('hapus')}}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                @csrf
            <button type="submit" id="deleteButton"  class="btn btn-danger">Hapus</button>
        </form>
        </div>
    </div>
    <div id="about" class="border rounded mx-3 mb-5">
        <div id="header_about" class="d-flex flex-row align-items-center justify-content-between border-bottom mx-3">
            <h4 class="my-2 font-light text-secondary py-3">Informasi Pribadi</h4>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#largeModal">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 7H6C4.89543 7 4 7.89543 4 9V18C4 19.1046 4.89543 20 6 20H15C16.1046 20 17 19.1046 17 18V15" stroke="#FF9F43" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 15.0002H12L20.5 6.50023C21.3284 5.6718 21.3284 4.32865 20.5 3.50023C19.6716 2.6718 18.3284 2.6718 17.5 3.50023L9 12.0002V15.0002" stroke="#FF9F43" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 5L19 8" stroke="#FF9F43" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            @include('profile.detail-profile-dosen&mitra.ubah-profile')
        </div>
        @if (auth()->user()->hasRole('Dosen'))
            <div id="content_about" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));	place-content: start; place-items: center;" class="p-3">
                <section id="about_col_1" style="gap: 1rem; display: flex; flex-direction: column;">
                    <div>
                        <h5>Universitas</h5>
                        <h6>{{$dosen->namauniv}}</h6>
                    </div>
                    <div>
                        <h5>Program Studi</h5>
                        <h6>{{$dosen->namaprodi}}</h6>
                    </div>
                    <div>
                        <h5>Kode Dosen</h5>
                        <h6>{{$dosen->kode_dosen}}</h6>
                    </div>
                </section>
                <section id="about_col_2" style="gap: 1rem; display: flex; flex-direction: column;">
                    <div>
                        <h5>Fakultas</h5>
                        <h6>{{$dosen->namafakultas}}</h6>
                    </div>
                    <div>
                        <h5>NIP</h5>
                        <h6>{{$dosen->nip}}</h6>
                    </div>
                    <div>
                        <h5>Nama Dosen</h5>
                        <h6>{{$dosen->namadosen}}</h6>
                    </div>
                </section>
                <section id="about_col_3" style="place-self: start; gap: 1rem; display: flex; flex-direction: column;">
                    <h4>Kontak</h4>
                    <div class="d-flex" style="gap: 3rem;">
                        <div>
                            <h5>No Telp</h5>
                            <h6>{{$dosen->nohpdosen}}</h6>
                        </div>
                        <div>
                            <h5>Email</h5>
                            <h6>{{$dosen->emaildosen}}</h6>
                        </div>
                    </div>
                </section>
            </div>   
        @elseif(auth()->user()->hasRole('Mitra'))
            <div id="content_about" style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));	place-content: start; place-items: start;" class="p-3">
                <section id="about_col_1" style="gap: 1rem; display: flex; flex-direction: column;">
                    <div>
                        <h5>Nama Pegawai</h5>
                        <h6>{{$pegawai->namapeg}}</h6>
                    </div>
                    <div>
                        <h5>Jabatan</h5>
                        <h6>{{$pegawai->jabatan}}</h6>
                    </div>
                </section>
                <section id="about_col_2" style="gap: 1rem; display: flex; flex-direction: column;">
                    <div>
                        <h5>No Telepon</h5>
                        <h6>{{$pegawai->nohppeg}}</h6>
                    </div>
                    <div>
                        <h5>Email</h5>
                        <h6>{{$pegawai->emailpeg}}</h6>
                    </div>
                </section>
            </div>
        @elseif(auth()->user()->hasRole('LKM'))
            <div id="content_about" style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));	place-content: start; place-items: start;" class="p-3">
                <section id="about_col_1" style="gap: 1rem; display: flex; flex-direction: column;">
                    <div>
                        <h5>Email</h5>
                        <h6>{{$user->email}}</h6>
                    </div>
                    <div>
                        <h5>Username</h5>
                        <h6>{{$user->username}}</h6>
                    </div>
                </section>
            </div>
        @endif
    </div>
</div>