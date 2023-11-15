<!-- Footer -->

<footer class="content-footer footer bg-footer-theme" style="background-color:#1A3826 !important">
    <div class="container-xxl">
        <div class="row text-white py-5">
            <div class="col-md-6 col-12 ps-5">
                <img src="{{ url('/app-assets/img/talentern_white.svg') }}">
                <p class="mt-4">Permata Kuningan Building 17th Floor, Kawasan <br> Epicentrum, HR Rasuna Said, Jl.
                    Kuningan Mulia, RT.6/RW.1, <br>Menteng Atas, Setiabudi, South Jakarta City, Jakarta 12920</p>
            </div>
            <div class="col-md-6 col-12">
                <div class="row text-white">
                    <div class="col-md-4 col-12">
                        <p>Proxsis & Co</p>
                        <p class="text-secondary">Tentang Kami</p>
                        <p class="text-secondary">Tentang Proxsis Group</p>
                        <p class="text-secondary">Techno Infinity</p>
                        <p class="text-secondary">PROXSIS HR</p>
                    </div>
                    <div class="col-md-4 col-12">
                        <p>Legal</p>
                        <p class="text-secondary"><i>Community Guidelines</i></p>
                        <p class="text-secondary"><i>Privacy & Terms</i></p>
                    </div>
                    <div class="col-md-4 col-12">
                        <p>Ikuti Kami</p>
                        <p class="text-secondary">Facebook</p>
                        <p class="text-secondary">Instagram</p>
                        <p class="text-secondary">LinkedIn</p>
                        <p class="text-secondary">Twitter</p>
                    </div>
                </div>
            </div>
            <div class="col-12 ps-5">
                <div class="copyright-text text-left" style="color: white">© {{ \Carbon\Carbon::today()->year }}
                    @lang('app.byFooter')
                    <div class="copyright-text text-left mt-2" style="color: white"><a>Crafted with PASSION by Proxsis Solusi Humaka & Techno Infinity</a>
                        <div class="social-links mt-2">
                            <a href="#" class="ml-0"><i class="fab fa-facebook-f"
                                    style="color: white; margin-right: 20px;"></i></a>
                            <a href="#"><i class="fab fa-instagram"
                                    style="color: white; margin-right: 20px;"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"
                                    style="color: white; margin-right: 20px;"></i></a>
                            <a href="#"><i class="fab fa-twitter"
                                    style="color: white; margin-right: 20px;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div> --}}
    </div>


</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!--/ Content wrapper -->
{{-- </div> --}}

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

<!-- Main JS -->
<script src="../../app-assets/js/main.js"></script>

<!-- Page JS -->
<script src="../../app-assets/js/dashboards-analytics.js"></script>

@yield('page_script')
</body>

</html>
