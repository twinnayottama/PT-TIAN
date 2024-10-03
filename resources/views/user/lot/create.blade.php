@extends('user.layouts.master')

@section('title-page')
    Create
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Lot</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('lot.index') }}">Lot</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Tambah Data Lot</h4>
                </div>

                <div class="card-body">
                    <form id="main-form" action="{{ route('lot.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="lot_number">Nomor Lot</label>
                            <input type="text" class="form-control @error('lot_number') is-invalid @enderror"
                                name="lot_number" id="lot_number" value="{{ old('lot_number') }}"
                                placeholder="Masukkan Nomor Lot">
                        </div>

                        <button type="submit" id="submit-btn" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('lot.index') }}" class="btn btn-warning ml-2">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const $submitBtn = $('#submit-btn');
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const form = $(this)[0];
                const formData = new FormData(form); // Create FormData object with form data

                $submitBtn.prop('disabled', true).text('Loading...');

                $.ajax({
                    url: form.action,
                    method: 'POST',
                    data: formData,
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from setting the content type
                    success: function(response) {
                        if (response.success) {
                            sessionStorage.setItem('success',
                                'Data Lot berhasil disubmit.');
                            window.location.href =
                                "{{ route('lot.index') }}"; // Redirect to index page
                        } else {
                            $('#flash-messages').html('<div class="alert alert-danger">' +
                                response.error + '</div>');
                        }
                    },
                    error: function(response) {
                        const errors = response.responseJSON.errors;
                        for (let field in errors) {
                            let input = $('[name=' + field + ']');
                            let error = errors[field][0];
                            input.addClass('is-invalid');
                            input.next('.invalid-feedback').remove();
                            input.after('<div class="invalid-feedback">' + error + '</div>');
                        }

                        const message = response.responseJSON.message ||
                            'Terdapat kesalahan pada proses tambah data lot';
                        $('#flash-messages').html('<div class="alert alert-danger">' + message +
                            '</div>');
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false).text('Tambah');
                    }
                });
            });

            $('input, select, textarea').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
