<script src="{{ asset('app-assets/js/pdfviewer.jquery.js') }}"></script>
<script>
    const options = {
        width: 800,
        height: 600,
    };

    $('#pdfviewer').pdfViewer(`{{ $data }}`, options);
</script>