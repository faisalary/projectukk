<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATS CV</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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
            font-family: 'Public Sans';
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

        .experience {
            margin-bottom: 25px;
        }

        @media print {
            @page {
                margin: 0;
                width: auto;
                height: auto;
            }

            body {
                margin: 0;
                padding: 0;
                outline: none;
            }

            .container {
                width: auto;
                height: auto;
                box-sizing: border-box;
            }

            #print-button {
                display: none;
            }
        }

        /* Button Styling */
        #print-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        #print-button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="section">
            <div class="header">
                <img src="{{$dataInfoTambahan->profile_picture}}" alt="Profile Picture">
                <div>
                    <h2 class="name">{{$dataInfoTambahan->namamhs}}</h2>
                    <p class="role">Frontend Developer</p>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="info">
                <div style="margin-left: 0;">
                    <p style="font-size: 11.5pt"><i class="ti ti-mail"></i>{{$dataInfoTambahan->emailmhs}}</p>
                    <p style="margin-top: 1rem; font-size: 11.5pt"><i class="ti ti-phone"></i>{{$dataInfoTambahan->nohpmhs}}</p>
                </div>
                <div style="margin: auto;">
                    <p style="font-size: 11.5pt"><i class="ti ti-calendar"></i>{{$dataInfoTambahan->tgl_lahir}}</p>
                    <p style="margin-top: 1rem; font-size: 11.5pt"><i class="ti ti-map-pin"></i>{{$dataInfoTambahan->alamatmhs}}</p>
                </div>
                <div style="margin-rught: 0;">
                    <p style="margin-right: 1rem; font-size: 11.5pt"><i class="ti ti-user"></i>{{$dataInfoTambahan->gender}}</p>
                </div>
            </div>
        </div>

        <div class="section body-section">
            <div class="row-1">
                <div>
                    <p class="title">Deskripsi Diri</p>
                    <p style="font-size: 11.5pt">{{$dataInfoTambahan->deskripsi_diri}} </p>
                </div>
                <p class="title">Pengalaman</p>
                @foreach($experience as $exp)
                <div class="experience">
                    <p style="font-size: 13.5pt" class="title-experience">{{$exp->posisi}}</p>
                    <p class="title-company">{{$exp->name_intitutions}}</p>
                    <p class="time">{{\Carbon\Carbon::parse($exp->startdate)->format('F Y')}} - {{\Carbon\Carbon::parse($exp->enddate)->format('F Y')}}</p>
                    <ul>
                        <p style="font-size: 11.5pt">{{$exp->deskripsi}}</p>
                    </ul>
                </div>
                @endforeach
                <p class="title">Dokumen Pendukung</p>
                @foreach($dokumenPendukung as $doc)
                <div class="experience">
                    <p style="font-size: 13.5pt" class="title-experience">{{ $doc->nama_dokumen }}</p>
                    <p class="title-company">{{ $doc->penerbit }}</p>
                    <p class="time">{{\Carbon\Carbon::parse($doc->startdate)->format('F Y')}} - {{\Carbon\Carbon::parse($doc->enddate)->format('F Y')}}</p>
                    <p style="font-size: 11.5pt">{{ $doc->deskripsi }}</p>
                    <p class="file-highlight" style="font-size: 11pt">
                        <a href="{{ $doc->link_sertif }}" target="_blank" rel="noopener noreferrer">
                            {{ Illuminate\Support\Str::limit($doc->link_sertif, 30, '...') }}
                        </a>
                    </p>
                </div>
                @endforeach
            </div>
            <div class="row-2">
                <p class="title">Keahlian</p>
                <ul>
                    @foreach(json_decode($dataInfoTambahan->skills) as $skill)
                    <li style="font-size: 11.5pt">{{ $skill }}</li>
                    @endforeach
                </ul>
                <p class="title">Pendidikan</p>
                @foreach($pendidikan as $pen)
                <div class="colage">
                    <p style="font-size: 13.5pt" class="title-colage">{{$pen->name_intitutions ?? '-'}}</p>
                    <p style="font-size: 11.5pt" class="title-major">{{$pen->tingkat ?? '-'}}</p>
                    <p style="font-size: 11.5pt" class="ipk">{{$pen->nilai ?? '-'}} </p>
                    <p class="time">{{\Carbon\Carbon::parse($pen->startdate)->format('F Y')}} - {{\Carbon\Carbon::parse($pen->enddate)->format('F Y')}}</p>
                </div>
                @endforeach
                <p class="title">Informasi Tambahan</p>
                <div class="information">
                    <p class="title-info">Media Sosial</p>
                    <ul>
                        @foreach(json_decode($dataInfoTambahan->sosmedmhs) as $sosmed)
                        <li style="margin-top: 10px; font-size: 10.5pt">{{ $sosmed->namaSosmed }}: {{ $sosmed->urlSosmed }}</li>
                        @endforeach
                    </ul>
                    <div class="information">
                        <p class="title-info">Bahasa</p>
                        <ul>
                            @foreach(json_decode($dataInfoTambahan->bahasa) as $bahasa)
                            <li style="margin-top: 10px; font-size: 10.5pt">Bahasa {{ $bahasa }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="information">
                        <p class="title-info">Lokasi kerja yang diharapkan :</p>
                        <p style="margin-top: 10px; font-size: 10.5pt">{{$dataInfoTambahan->lokasi_yg_diharapkan}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Print button -->
    <button id="print-button" onclick="printCV()">Unduh CV</button>

    <script>
        function printCV() {
            const printButton = document.getElementById('print-button');
            printButton.style.display = 'none';
            window.print();
            printButton.style.display = 'block';
        }
    </script>
</body>

</html>
