<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATS CV</title>
    <link rel="stylesheet" href="<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@100;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
    <style>
        p {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 38.75em;
            padding: 1.75em 3.125em;
            margin: auto;
            border: 1px solid #D3D6DB;
        }

        .section {
            font-family: 'Public Sans'
        }

        .section img {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            margin-right: 1.938em;
        }

        .section .name {
            font-size: 24px;
            font-weight: 700;
            line-height: 28px;
            color: #101214;
        }

        .section .role {
            font-size: 16px;
            line-height: 28px;
            font-weight: 400;
            margin-top: -15px;
        }

        .header {
            display: flex;
            align-items: center;
        }

        .info {
            display: flex;
            margin-top: 0.9em;
        }

        .info .item {
            margin-right: 3.125em;
            color: #000000;
        }

        .info .item p {
            color: #000000;
            margin-bottom: 0.625em;

        }

        .info .item i {
            color: #4B465C;
            margin-right: 0.5em;
        }

        .body-section {
            display: flex;
            flex-direction: row;
            margin-top: 0.563em;
        }

        .body-section .row-1 .experience ul,
        .body-section .row-1 .experience ul li {
            margin: 0;
            padding: 0;
        }

        .body-section .row-1 .experience ul li {
            margin-left: 1em;
            margin-top: 0.2em;
        }

        .body-section .title {
            color: #73808D;
            font-weight: 400;
            border-bottom: 1px solid #73808D;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.313em;
            margin-top: 1.5em;

        }

        .body-section .row-1 .experience .title-experience {
            color: #101214;
            font-weight: 700;
            font-size: 21px;
            margin-top: 0.5em;
        }

        .body-section .row-1 .experience .title-company {
            font-weight: 400;
            margin-top: 0.4em;
        }

        .body-section .row-1 .experience .time {
            color: #73808D;
            font-size: 12px;
            margin-top: 0.4em;
            margin-bottom: 0.5em;
            font-weight: 400;
        }

        .body-section .row-1 .experience .file-highlight {
            color: #101214;
            margin-top: 0.7em;
            font-weight: 500;
            text-decoration: underline;
        }

        .body-section .row-2 .colage .title-colage {
            color: #101214;
            font-weight: 700;
            font-size: 21px;
            margin-top: 0.5em;
        }

        .body-section .row-2 .colage .title-major {
            font-weight: 400;
            margin-top: 0.8em;
        }

        .body-section .row-2 .colage .ipk {
            color: #73808D;
            font-size: 15px;
            margin-top: 0.8em;
            margin-bottom: 0.5em;
            font-weight: 400;
        }

        .body-section .row-2 .colage .time {
            color: #73808D;
            font-size: 12px;
            margin-top: 0.8em;
            font-weight: 400;
        }

        .body-section .row-2 .information {
            margin-top: 1.5em;
        }

        .body-section .row-2 .information .title-info {
            color: #101214;
            font-weight: 700;
        }


        .row-1 {
            flex: 0 60%;
            margin-right: 2.5em;
        }

        .row-2 {
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="section">
            <div class="header">
                <img src="assets/14.png" alt="Profile Picture">
                <div>
                    <h2 class="name">John Doe</h2>
                    <p class="role">Frontend Developer</p>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="info">
                <div class="item">
                    <p><i class="ti ti-mail"></i>Mark.lee@gmail.com</p>
                    <p><i class="ti ti-phone"></i>098765432110</p>
                </div>
                <div class="item">
                    <p><i class="ti ti-calendar"></i>01 Januari 2000</p>
                    <p><i class="ti ti-map-pin"></i>Bandung, Jawa Barat</p>
                </div>
                <div class="item">
                    <p><i class="ti ti-user"></i>Laki - laki</p>
                </div>
            </div>
        </div>

        <div class="section body-section">
            <div class="row-1">
                <div>
                    <p class="title">Deskripsi Diri</p>
                    <p>Pengembang perangkat lunak berpengalaman selama 7 tahun dengan keahlian dalam pengembangan
                        aplikasi
                        web, manajemen proyek, dan kerja tim lintas disiplin. </p>
                </div>
                <p class="title">Pengalaman</p>
                <div class="experience">
                    <p class="title-experience">Frontend Developer</p>
                    <p class="title-company">Techno Infinity - Internship</p>
                    <p class="time">Juli 2023 - Juni 2024</p>
                    <ul>
                        <li>Merancang dan mengimplementasikan fitur-fitur baru dengan menggunakan HTML, CSS, dan
                            JavaScript untuk meningkatkan pengalaman pengguna.</li>
                        <li>Bertanggung jawab atas penyesuaian dan perbaikan desain antarmuka berdasarkan umpan balik
                            pengguna dan kebutuhan bisnis.</li>
                    </ul>
                </div>
                <div class="experience">
                    <p class="title-experience">Frontend Developer</p>
                    <p class="title-company">Techno Infinity - Internship</p>
                    <p class="time">Juli 2023 - Juni 2024</p>
                    <ul>
                        <li>Merancang dan mengimplementasikan fitur-fitur baru dengan menggunakan HTML, CSS, dan
                            JavaScript untuk meningkatkan pengalaman pengguna.</li>
                        <li>Bertanggung jawab atas penyesuaian dan perbaikan desain antarmuka berdasarkan umpan balik
                            pengguna dan kebutuhan bisnis.</li>
                    </ul>
                </div>
                <div class="experience">
                    <p class="title">Dokumen pendukung</p>
                    <p class="title-experience">Desain UI/UX </p>
                    <p class="title-company">Coursera</p>
                    <p class="time">Juli 2023 - Juli 2025</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididuntut
                        labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                    <p class="file-highlight">sertifikat_mark_lee.pdf</p>
                </div>
            </div>
            <div class="row-2">
                <p class="title">Keahlian</p>
                <p>HTML CSS Visual Studio Figma User Interface
                    User Experience</p>
                <p class="title">Pendidikan</p>
                <div class="colage">
                    <p class="title-colage">University Of Melbourne</p>
                    <p class="title-major">Magister Management</p>
                    <p class="ipk">IPK 3.89/4.00 </p>
                    <p class="time">Juli 2023 - Juli 2025</p>
                </div>
                <div class="colage">
                    <p class="title-colage">University Of Melbourne</p>
                    <p class="title-major">Magister Management</p>
                    <p class="ipk">IPK 3.89/4.00 </p>
                    <p class="time">Juli 2023 - Juli 2025</p>
                </div>
                <p class="title">Informasi Tambahan</p>
                <div class="information">
                    <p class="title-info">Media Sosial</p>
                    <p style="margin-top: 10px;">Instagram: mark_lee </p>
                    <p style="margin-top: 10px;">Linkedin: mark_lee </p>
                </div>
                <div class="information">
                    <p class="title-info">Bahasa</p>
                    <p style="margin-top: 10px;">Bahasa Indonesia</p>
                    <p style="margin-top: 10px;">Bahasa Inggris</p>

                </div>
                <div class="information">
                    <p class="title-info">Ekspektasi Gaji</p>
                    <p style="margin-top: 10px;">2.000.000</p>

                </div>
                <div class="information">
                    <p class="title-info">Lokasi kerja yang diharapkan :</p>
                    <p style="margin-top: 10px;">Bandung</p>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
