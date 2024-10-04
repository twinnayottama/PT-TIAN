@extends('user.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Lihat Data QRCode</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('code.index') }}">QRCode</a></div>
                <div class="breadcrumb-item">Show</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Lihat Data QRCode</h4>

                    <div class="card-header-action">
                        <form action="{{ route('code.destroy', $lot->id) }}" method="POST" id="delete-all-form">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn btn-danger mr-2" id="delete-all-button">Hapus semua
                                QRCode</button>
                            <a href="{{ route('code.index') }}" class="btn btn-warning">Kembali</a>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example" class="ui selectable celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Token</th>
                                <th>Nomor Seri</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($codes as $code)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $code->token }}</td>
                                    <td>{{ $code->serial_number }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('#example').DataTable({
            rowReorder: true,
            layout: {
                topStart: {
                    pageLength: {
                        menu: [10, 25, 50]
                    }
                },
                topEnd: {
                    search: {
                        placeholder: 'Type search here'
                    }
                },
                bottomEnd: {
                    paging: {
                        numbers: 3
                    }
                }
            },
            columnDefs: [{
                    className: "dt-head-center",
                    targets: [0, 1, 2]
                },
                {
                    className: "dt-body-center",
                    targets: [0, 1, 2]
                },
                {
                    width: '12%',
                    targets: 0
                },
            ]
        });

        document.getElementById('delete-all-button').addEventListener('click', function() {
            if (confirm('Apakah anda ingin menghapus semua data qrcode?')) {
                document.getElementById('delete-all-form').submit();
            }
        });
    </script>
@endpush
