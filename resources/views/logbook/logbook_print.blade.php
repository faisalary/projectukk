<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <title>Print Logbook</title>
    <style>
        @page { 
            size: A5 
        }
        @media print {

            /* tfoot { 
                counter-increment: page;
            } */
            /* @page {
                counter-increment: page;
                content: counter(page);
            } */

            tfoot::after {
                /* Increment "my-sec-counter" by 1 */

                /* content: counter(page); */
            }

            div {
                break-inside: avoid;
            }
            .sheet {
                overflow: visible;
                width: none !important;
                height: none !important;
            }
            body {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 10pt;
                color: #1D345D;
                line-height: 5mm;
                -webkit-print-color-adjust: exact !important;
                /* counter-reset: my-sec-counter; */
            }

            #print_button{
                display: none;
            }

        }
        body.A5 .sheet{
            height: auto !important;
        }
    </style>
</head>
<body class="A5" style="display: flex; flex-direction: column; align-items: center;">
    <section id="logbook_print" class="sheet padding-10mm" onload="printLogbook()">
        <article>
            <table>
                <thead>
                    <tr>
                        <th>Emoticon</th>
                        <th style="text-align: left;">Activity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($print_logbook as $data)
                        <tr>
                            <td><img src="{{App\Enums\LogbookDailyEmot::getWithEmot($data->emoticon)['image']}}" alt=""></td>
                            <td>{{ $data->activity }}</td>
                            <td>{{ $data->date }}</td>
                        </tr>
                    @endforeach
                    @foreach($print_logbook as $data)
                        <tr>
                            <td><img src="{{App\Enums\LogbookDailyEmot::getWithEmot($data->emoticon)['image']}}" alt=""></td>
                            <td>{{ $data->activity }}</td>
                            <td>{{ $data->date }}</td>
                        </tr>
                    @endforeach
                    @foreach($print_logbook as $data)
                        <tr>
                            <td><img src="{{App\Enums\LogbookDailyEmot::getWithEmot($data->emoticon)['image']}}" alt=""></td>
                            <td>{{ $data->activity }}</td>
                            <td>{{ $data->date }}</td>
                        </tr>
                    @endforeach
                    @foreach($print_logbook as $data)
                        <tr>
                            <td><img src="{{App\Enums\LogbookDailyEmot::getWithEmot($data->emoticon)['image']}}" alt=""></td>
                            <td>{{ $data->activity }}</td>
                            <td>{{ $data->date }}</td>
                        </tr>
                    @endforeach
                    @foreach($print_logbook as $data)
                        <tr>
                            <td><img src="{{App\Enums\LogbookDailyEmot::getWithEmot($data->emoticon)['image']}}" alt=""></td>
                            <td>{{ $data->activity }}</td>
                            <td>{{ $data->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
        </article>
    </section>
    <button onclick="printLogbook()" id="print_button">Export PDF</button>
    <script>
        function printLogbook() {
            var print = document.getElementById('logbook_print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = print;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>