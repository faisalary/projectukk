@extends('partials_auth.register')

@section('conten')

<form method="POST" action="{{ url('/mahasiswa/register') }}">
    @csrf
    <div class="row">
        <div class="col mb-2 form-input">
            <label for="roleregister" class="form-label">Role Registrasi</label>
            <select class="form-select select2" id="roleregister" name="roleregister"
                    data-placeholder="Pilih Role Anda Terlebih Dahulu" onchange="redirectToPage()">
                <option disabled selected>Pilih Role Anda Terlebih Dahulu</option>
                <option value="user">Mahasiswa</option>
                <option value="mitra">Mitra</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col">
            <label for="nim" class="col-form-label text-md-end">{{ __('NIM') }}</label>
            <div class="md-6">
                <input id="nim" type="nim" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" required autocomplete="nim" placeholder="Masukkan NIM" autofocus>
                @error('nim')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>    
    <div class="form-group mt-3">
        <div class="col-sm-12 mt-4">
            <button type="submit" class="btn btn-primary d-grid w-100" style="background: var(--primary-500-base, #4EA971);" name="register">Buat Akun</button>
        </div>
    </div>
</form>
<script>
    function handleFormSubmit(event) {
        
        event.preventDefault();
        fetch(event.target.action, {
            method: event.target.method,
            body: new FormData(event.target),
            headers: {
                'X-CSRF-TOKEN': event.target.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error === false) {
                alert(data.message);
                if (data.script) {
                    const script = JSON.parse('"' + data.script + '"');
                    const scriptElement = document.createElement('script');
                    scriptElement.text = script;
                    document.body.appendChild(scriptElement);
                }
            } else {
                // Tangani error jika diperlukan
                console.error(data.message);
            }
        })
        .catch(error => {
            // Tangani error fetch jika diperlukan
            console.error('Error Fetch:', error);
        });
    }
    
</script>


@if (Session::has('message'))
<script>
    swall("Message", "{{Session::get('message') }}", 'succes',{
        button:true,
        button: 'Daftar',
        timer: 3000,

    })
</script>
@endif
@endsection

