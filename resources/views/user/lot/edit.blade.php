@extends('user.layouts.master')

@section('title-page')
    Edit
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Lot</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('lot.index') }}">Lot</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Edit Data Lot</h4>
                </div>

                <div class="card-body">
                    <form id="my-form" action="{{ route('lot.update', $lot->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="lot_number">Nomor Lot</label>
                            <input type="text" class="form-control @error('lot_number') is-invalid @enderror"
                                name="lot_number" id="lot_number" value="{{ old('lot_number', $lot->lot_number) }}">
                            @error('lot_number')
                                <div class="text-danger">*{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2" id="btnSubmit">Edit</button>
                        <a href="{{ route('lot.index') }}" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Handle form submission using AJAX
        $('#my-form').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const form = $(this);
            const formData = new FormData(form[0]); // Use FormData to handle file uploads
            const submitButton = $('#btnSubmit');
            submitButton.prop('disabled', true).text('Loading...');

            $.ajax({
                url: form.attr('action'),
                method: 'POST', // Use POST for form submission
                data: formData,
                contentType: false, // Prevent jQuery from setting content type
                processData: false, // Prevent jQuery from processing data
                success: function(response) {
                    if (response.success) {
                        // Flash message sukses
                        sessionStorage.setItem('success',
                            'Data Lot berhasil disubmit.');
                        window.location.href =
                            "{{ route('lot.index') }}"; // Redirect to index page
                    } else if (response.info) {
                        // Flash message info
                        sessionStorage.setItem('info',
                            'Tidak melakukan perubahan data pada Data Lot.');
                        window.location.href =
                            "{{ route('lot.index') }}"; // Redirect to index page
                    } else {
                        // Flash message error
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
                        // Remove existing invalid feedback to avoid duplicates
                        input.next('.invalid-feedback').remove();
                        input.after('<div class="invalid-feedback">' + error + '</div>');
                    }

                    const message = response.responseJSON.message ||
                        'Terdapat kesalahan pada Data Lot.';
                    $('#flash-messages').html('<div class="alert alert-danger">' + message +
                        '</div>');
                },
                complete: function() {
                    submitButton.prop('disabled', false).text('Edit');
                }
            });
        });

        // Remove validation error on input change
        $('input, select, textarea').on('input change', function() {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').remove();
        });
    </script>
@endpush
