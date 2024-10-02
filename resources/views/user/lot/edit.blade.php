@extends('user.layouts.master')

@section('title-page')
    Edit Lot
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Lot</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Lot</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Edit Lot</h4>
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
        $(document).ready(function() {
            $('#my-form').on('submit', function(event) {
                event.preventDefault();

                $('#btnSubmit').prop('disabled', true).text('Loading...');

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            // sessionStorage.setItem('success', 'Berhasil menambahkan nomor lot');
                            window.location.href = "{{ route('lot.index') }}";
                        }
                    },
                    error: function(response) {
                        if (response.responseJSON.error) {
                            sessionStorage.setItem('error',
                                'Terjadi kesalahan saat menambahkan nomor lot');
                            window.location.href = "{{ route('lot.index') }}";
                        }
                    }
                });
            });
        });
    </script>
@endpush
