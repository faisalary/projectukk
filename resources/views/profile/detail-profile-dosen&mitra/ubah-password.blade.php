<div class="m-auto tab-pane fade" style="width: 100%;" id="v-pills-ubah-password" role="tabpanel" aria-labelledby="v-pills-ubah-password-tab">
    @if (auth()->user()->hasRole('Dosen'))
    <h2 class="mx-3 mt-4 mb-3">Profile Dosen</h2>
    @elseif(auth()->user()->hasRole('Mitra'))
    <h2 class="mx-3 mt-4 mb-3">Profile Mitra</h2>
    @elseif(auth()->user()->hasRole('LKM'))
    <h2 class="mx-3 mt-4 mb-3">Profile LKM</h2>
    @endif
    <div class="border px-3 py-2 mx-3  rounded" style="width: 65rem;">
        <h4 class="border-bottom font-light text-secondary py-3">Ubah Password</h4>
        <form action="" id="field-change-password">
            <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap:1rem;">
                <div class="d-flex flex-column">
                    <label for="currentPassword">
                        Password Saat Ini
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="currentPassword" id="currentPassword" placeholder=" Password Saat Ini" style="padding-right: 2px; padding-left: 0.5rem; border: 1px rgba(0, 0, 0, 0.187) solid;" required>
                </div>
                <div class="d-flex flex-column">
                    <label for="confirmPassword">
                        Konfirmasi Password Baru
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="confirmPassword" id="confirmPassword" placeholder="Konfirmasi Password Baru" style="padding-right: 2px; padding-left: 0.5rem; border: 1px rgba(0, 0, 0, 0.187) solid;" required>
                </div>
                <div class="d-flex flex-column">
                    <label for="newPassword">
                        Password Baru
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="newPassword" id="newPassword" placeholder="Password Baru" style="padding-right: 2px; padding-left: 0.5rem; border: 1px rgba(0, 0, 0, 0.187) solid;" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-4">
                Simpan
            </button>
        </form>
    </div>
</div>