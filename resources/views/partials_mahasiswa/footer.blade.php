<!-- Footer -->

<style>
    /* Button used to open the chat form - fixed at the bottom of the page */
    .open-button {
        background-color: #FFFFFF;
        color: #418D5E;
        padding: 0px;
        border-radius: 20px;
        border: none;
        cursor: pointer;
        width: 160px;
        height: 40px;
    }

    /* The popup chat - hidden by default */
    .chat-popup {
        display: none;
        position: fixed;
        bottom: 0;
        right: 15px;
        border: 3px solid #f1f1f1;
        z-index: 9;
        overflow-y: auto;
        max-height: 500px;

    }

    /* Add styles to the form container */
    .form-container {
        max-width: 300px;
        padding: 10px;
        background-color: white;
    }
</style>

<footer class="content-footer footer bg-footer-theme" style="background-color:#1A3826 !important" id="footer">
    <div class="container-xxl">
        <div class="row text-white py-4">
            <div class="col-md-5 col-12 ps-5">
                <img src="{{ url('/app-assets/img/talentern_white.svg') }}">
                <p class="mt-4">Jl. Telekomunikasi No.1, Sukapura, Kec. Dayeuhkolot,<br> Kabupaten Bandung, Jawa Barat 40257</p>
            </div>
            <div class="col-md-7 col-12">
                <div class="row text-white">
                    <div class="col-md-3 col-12">
                        <p>Kontak Kami</p>
                        <p class="location text-secondary"><i class="ti ti-mail" style="margin-right: 10px; margin-bottom:5px;"></i>lkmfit@gmail.com</p>
                        <p class="location text-secondary"><i class="ti ti-brand-whatsapp" style="margin-right: 10px; margin-bottom:5px;"></i>+6281398857641</p>
                    </div>
                    <div class="col-md-3 col-12">
                        <p>Legal</p>
                        <p class="text-secondary"><i>Community Guidelines</i></p>
                        <p class="text-secondary"><i>Privacy & Terms</i></p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p>Tentang Kami</p>
                        <p class="text-secondary"><i>PT. Teknologi Nirmala Olah Daya Informasi</i></p>
                        <p class="text-secondary"><i>Layanan Kerjasama dan Magang FIT</i></p>
                        <p class="text-secondary"><i>Fakultas Ilmu Terapan</i></p>
                        <button class="open-button" onclick="openForm()">
                            <div class="tf-icons ti ti-help" style="font-size: medium;"> Butuh Bantuan ?
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12 ps-5">
                <div class="copyright-text text-left mt-2" style="color: white"><a>Social Media : </a>
                    <div class="social-links mt-2">
                        <a href="#" class="ml-0"><i class="fab fa-facebook-f" style="color: white; margin-right: 20px;"></i></a>
                        <a href="#"><i class="fab fa-instagram" style="color: white; margin-right: 20px;"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in" style="color: white; margin-right: 20px;"></i></a>
                        <a href="#"><i class="fab fa-twitter" style="color: white; margin-right: 20px;"></i></a>
                    </div>
                </div>
                <div class="border mt-2 mb-2" style="width: 1494px; margin-left: -89px; border-width: 3px;"></div>

                <div class="copyright-text text-left mt-3" style="color: white">© {{ \Carbon\Carbon::today()->year }}
                    @lang('app.byFooter') Crafted with PASSION by Proxsis Solusi Humaka & Techno Infinity
                </div>
            </div>
        </div>


        <div class="chat-popup" id="myForm" style=" border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <form action="#" class="form-container p-0">
                <div class="modal-header" style="background-color: #4EA971 !important;">
                    <i class="ti ti-x text-white mb-4 ms-2 mt-1" aria-label="Close" onclick="closeForm()"></i>
                    <h6 class="pt-3 text-white" style="padding-right: 40px !important;">Tinggalkan Pesan Untuk Kami</h6>
                </div>
                <div class="card-body p-4">
                    <label for="msg">Pusat bantuan bagi mahasiswa dan mitra perusahaan Talentern</label>
                    <div>
                        <label for="defaultFormControlInput" class="form-label mt-3">Nama Lengkap <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="John Doe" aria-describedby="defaultFormControlHelp">
                    </div>
                    <div>
                        <label for="exampleFormControlInput1" class="form-label mt-3">Email <span class="text-danger">*</span> </label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label mt-3">Asal Instansi/Perusahaan <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Telkom University" aria-describedby="defaultFormControlHelp">
                    </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label mt-3">Catatan <span class="text-danger">*</span> </label>
                        <textarea class="form-control" id="defaultFormControlInput" placeholder="Tulis Disini" aria-describedby="defaultFormControlHelp"></textarea>
                    </div>
                    <div>
                        <label for="formFile" class="form-label mt-3">Dokumen Pendukung</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <button type="submit" class="btn btn-success mt-3 w-100" >Kirim</button>
                </div>
            </form>
        </div>

        {{-- <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div> --}}
    </div>



</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!--/ Content wrapper -->
<!-- </div> -->

<!--/ Layout container -->
</div>
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>

<!--/ Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="../../app-assets/vendor/libs/jquery/jquery.js"></script>
<script src="../../app-assets/vendor/libs/popper/popper.js"></script>
<script src="../../app-assets/vendor/js/bootstrap.js"></script>
<script src="../../app-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../../app-assets/vendor/libs/node-waves/node-waves.js"></script>

<script src="../../app-assets/vendor/libs/hammer/hammer.js"></script>
<script src="../../app-assets/vendor/libs/i18n/i18n.js"></script>
<script src="../../app-assets/vendor/libs/typeahead-js/typeahead.js"></script>

<script src="../../app-assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="../../app-assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="../../app-assets/vendor/libs/swiper/swiper.js"></script>
<script src="../../app-assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="../../app-assets/vendor/libs/select2/select2.js"></script>
<script src="../../app-assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
<script src="../../app-assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="../../app-assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
<script src="../../app-assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
<script src="../../app-assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
<script src="../../app-assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
<script src="../../app-assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
<script src="../../app-assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="../../app-assets/vendor/libs/dropzone/dropzone.js"></script>

<!-- Main JS -->
<script src="../../app-assets/js/main.js"></script>

<!-- Page JS -->
<script src="../../app-assets/js/dashboards-analytics.js"></script>
<script src="../../app-assets/js/forms-selects.js"></script>
<script src="../../app-assets/js/form-wizard-numbered.js"></script>
<script src="../../app-assets/js/form-wizard-validation.js"></script>
<script src="../../app-assets/js/form-wizard-icons.js"></script>
<script src="../../app-assets/js/ui-carousel.js"></script>
<script src="../../app-assets/js/forms-file-upload.js"></script>

<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>

@yield('page_script')
</body>

</html>