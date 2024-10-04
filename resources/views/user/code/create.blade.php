@extends('user.layouts.master')

@section('title-page')
    Create
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data QRCode</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('code.index') }}">QRCode</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Tambah Data Qrcode</h4>
                </div>

                <div class="card-body">
                    <form id="my-form" action="{{ route('code.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="lot_id">Nomor Lot <span class="text-danger">(Seperti yang anda masukkan di
                                    lot)</span></label>
                            <select name="lot_id" id="lot_id" class="form-control @error('lot_id') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih Nomor Lot --</option>
                                @foreach ($lots as $lot)
                                    <option value="{{ $lot->id }}">{{ $lot->lot_number }}</option>
                                @endforeach
                            </select>
                            @error('lot_id')
                                <div class="text-danger">*{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="file">Upload File Excel <span class="text-danger">(File harus berformat: xlsx,
                                    xls, csv)</span></label>
                            <input type="file" name="file" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2" id="btnSubmit">Tambah</button>
                        <a href="{{ route('code.index') }}" class="btn btn-warning">Kembali</a>
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

                var formData = new FormData(this);
                $('#btnSubmit').prop('disabled', true).text('Loading...');

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            sessionStorage.setItem('success',
                                'Berhasil menambahkan data QRCode');
                            window.location.href = "{{ route('code.index') }}";
                        }
                    },
                    error: function(response) {
                        if (response.responseJSON.error) {
                            sessionStorage.setItem('error', response.responseJSON.error);
                            window.location.href = "{{ route('code.index') }}";
                        }
                    },
                    complete: function() {
                        $('#btnSubmit').prop('disabled', false).text('Tambah');
                    }
                });
            });
        });
    </script>
@endpush
