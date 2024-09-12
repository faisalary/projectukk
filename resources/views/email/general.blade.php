<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <link rel="stylesheet" href="{{ url('app-assets/vendor/css/rtl/core.css') }}"class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('app-assets/vendor/css/rtl/theme-default.css') }}"class="template-customizer-theme-css" />
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $subject }}</h1>
        </div>
        <div class="card">
            <div class="card-body">
                {!! $content !!}
            </div>
        </div>
        <div class="footer">
            <p>© PT Teknologi Nirmala Olah Daya Informasi (Techno Infinity).</p>
        </div>
    </div>
    <script src="{{ url('app-assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('app-assets/vendor/js/bootstrap.js') }}"></script>
</body>
</html>
