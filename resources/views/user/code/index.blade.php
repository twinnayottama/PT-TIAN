@extends('user.layouts.master')

@section('title-page')
    QRCode
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data QRCode</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('code.index') }}">QRCode</a></div>
                <div class="breadcrumb-item">Index</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Tabel Data QRCode</h4>
                    <div class="card-header-action">
                        <a href="{{ route('code.create') }}" class="btn btn-primary mr-2">
                            Tambah Data
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example" class="ui selectable celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor lot</th>
                                <th>Jumlah QRCode</th>
                                <th>Nomor seri QRCode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lots as $lot)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $lot->lot_number }}</td>
                                    <td>{{ $lot->code_count }}</td>
                                    <td>{{ $lot->firstCode ? $lot->firstCode->serial_number : '' }} -
                                        {{ $lot->lastCode ? $lot->lastCode->serial_number : '' }}</td>
                                    <td>
                                        <a href="{{ route('code.show', $lot->id) }}" class="btn btn-warning mr-2 mb-2"><i
                                                class="fas fa-eye"></i></a>
                                    </td>
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
                        menu: [10, 25, 50, 100]
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
                    targets: [0, 1, 2, 3, 4]
                },
                {
                    className: "dt-body-center",
                    targets: [0, 1, 2, 3, 4]
                },
                {
                    width: '12%',
                    targets: 0
                },
                {
                    width: '20%',
                    targets: 2
                }
            ]
        });
    </script>
@endpush
