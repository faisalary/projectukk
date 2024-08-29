<div class="m-auto tab-pane fade" style="width: 100%;" id="v-pills-ubah-password" role="tabpanel" aria-labelledby="v-pills-ubah-password-tab">
    @if (auth()->user()->hasRole('Dosen'))
    <h2 class="mx-3 mt-3 mb-3">Profile Dosen</h2>
    @elseif(auth()->user()->hasRole('Mitra'))
    <h2 class="mx-3 mt-3 mb-3">Profile Mitra</h2>
    @elseif(auth()->user()->hasRole('LKM'))
    <h2 class="mx-3 mt-3 mb-3">Profile LKM</h2>
    @endif
    <div style="display: flex; flex-direction: column; gap:1.5rem;">
        <div class="d-flex flex-column">
            <label for="currentPassword">
                Password Saat Ini
                <span class="text-danger">*</span>
            </label>
            <div style="position: relative;">
                <input type="password" name="currentPassword" id="currentPassword" placeholder="Password Saat Ini" style="border: 1px rgba(0, 0, 0, 0.187) solid; width: 100%; height: 3rem; padding-right: 35px; padding-left: 10px; border-radius: 10px; padding-top: 10px; padding-bottom: 10px;" required>
                <button type="button" class="toggle-password" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">
                    <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.83 6L14 9.16V9C14 8.20435 13.6839 7.44129 13.1213 6.87868C12.5587 6.31607 11.7956 6 11 6H10.83ZM6.53 6.8L8.08 8.35C8.03 8.56 8 8.77 8 9C8 9.79565 8.31607 10.5587 8.87868 11.1213C9.44129 11.6839 10.2044 12 11 12C11.22 12 11.44 11.97 11.65 11.92L13.2 13.47C12.53 13.8 11.79 14 11 14C9.67392 14 8.40215 13.4732 7.46447 12.5355C6.52678 11.5979 6 10.3261 6 9C6 8.21 6.2 7.47 6.53 6.8ZM1 1.27L3.28 3.55L3.73 4C2.08 5.3 0.78 7 0 9C1.73 13.39 6 16.5 11 16.5C12.55 16.5 14.03 16.2 15.38 15.66L15.81 16.08L18.73 19L20 17.73L2.27 0M11 4C12.3261 4 13.5979 4.52678 14.5355 5.46447C15.4732 6.40215 16 7.67392 16 9C16 9.64 15.87 10.26 15.64 10.82L18.57 13.75C20.07 12.5 21.27 10.86 22 9C20.27 4.61 16 1.5 11 1.5C9.6 1.5 8.26 1.75 7 2.2L9.17 4.35C9.74 4.13 10.35 4 11 4Z" fill="#535353"/></svg>
                </button>
            </div>
        </div>
        <div class="d-flex flex-column">
            <label for="newPassword">
                Password Baru
                <span class="text-danger">*</span>
            </label>
            <div style="position: relative;">
                <input type="password" name="newPassword" id="newPassword" placeholder="Password Baru" style="border: 1px rgba(0, 0, 0, 0.187) solid; width: 100%; height: 3rem; padding-right: 35px; padding-left: 10px; border-radius: 10px; padding-top: 10px; padding-bottom: 10px;" required>
                <button type="button" class="toggle-password" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">
                    <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.83 6L14 9.16V9C14 8.20435 13.6839 7.44129 13.1213 6.87868C12.5587 6.31607 11.7956 6 11 6H10.83ZM6.53 6.8L8.08 8.35C8.03 8.56 8 8.77 8 9C8 9.79565 8.31607 10.5587 8.87868 11.1213C9.44129 11.6839 10.2044 12 11 12C11.22 12 11.44 11.97 11.65 11.92L13.2 13.47C12.53 13.8 11.79 14 11 14C9.67392 14 8.40215 13.4732 7.46447 12.5355C6.52678 11.5979 6 10.3261 6 9C6 8.21 6.2 7.47 6.53 6.8ZM1 1.27L3.28 3.55L3.73 4C2.08 5.3 0.78 7 0 9C1.73 13.39 6 16.5 11 16.5C12.55 16.5 14.03 16.2 15.38 15.66L15.81 16.08L18.73 19L20 17.73L2.27 0M11 4C12.3261 4 13.5979 4.52678 14.5355 5.46447C15.4732 6.40215 16 7.67392 16 9C16 9.64 15.87 10.26 15.64 10.82L18.57 13.75C20.07 12.5 21.27 10.86 22 9C20.27 4.61 16 1.5 11 1.5C9.6 1.5 8.26 1.75 7 2.2L9.17 4.35C9.74 4.13 10.35 4 11 4Z" fill="#535353"/></svg>
                </button>
            </div>
        </div>
        <div class="d-flex flex-column">
            <label for="confirmPassword">
                Konfirmasi Password Baru
                <span class="text-danger">*</span>
            </label>
            <div style="position: relative;">
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Konfirmasi Password Baru" style="border: 1px rgba(0, 0, 0, 0.187) solid; width: 100%; height: 3rem; padding-right: 35px; padding-left: 10px; border-radius: 10px; padding-top: 10px; padding-bottom: 10px;" required>
                <button type="button" class="toggle-password" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">
                    <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.83 6L14 9.16V9C14 8.20435 13.6839 7.44129 13.1213 6.87868C12.5587 6.31607 11.7956 6 11 6H10.83ZM6.53 6.8L8.08 8.35C8.03 8.56 8 8.77 8 9C8 9.79565 8.31607 10.5587 8.87868 11.1213C9.44129 11.6839 10.2044 12 11 12C11.22 12 11.44 11.97 11.65 11.92L13.2 13.47C12.53 13.8 11.79 14 11 14C9.67392 14 8.40215 13.4732 7.46447 12.5355C6.52678 11.5979 6 10.3261 6 9C6 8.21 6.2 7.47 6.53 6.8ZM1 1.27L3.28 3.55L3.73 4C2.08 5.3 0.78 7 0 9C1.73 13.39 6 16.5 11 16.5C12.55 16.5 14.03 16.2 15.38 15.66L15.81 16.08L18.73 19L20 17.73L2.27 0M11 4C12.3261 4 13.5979 4.52678 14.5355 5.46447C15.4732 6.40215 16 7.67392 16 9C16 9.64 15.87 10.26 15.64 10.82L18.57 13.75C20.07 12.5 21.27 10.86 22 9C20.27 4.61 16 1.5 11 1.5C9.6 1.5 8.26 1.75 7 2.2L9.17 4.35C9.74 4.13 10.35 4 11 4Z" fill="#535353"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>