@extends('user.layouts.master')

@section('title-page')
    Lot
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Lot</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('lot.index') }}">Lot</a></div>
                <div class="breadcrumb-item">Index</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Tabel Data Lot</h4>
                    <div class="card-header-action">
                        <a href="{{ route('lot.create') }}" class="btn btn-primary">
                            Tambah Data
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example" class="ui selectable celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Lot</th>
                                <th>Tanggal dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lots as $lot)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $lot->lot_number ?? '' }}</td>
                                    <td>{{ date('d-M-Y', strtotime($lot->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('lot.show', $lot->id) }}" class="btn btn-warning mr-2 mb-2"><i
                                                class="fas fa-eye"></i></a>
                                        <a href="{{ route('lot.edit', $lot->id) }}" class="btn btn-success mr-2 mb-2"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="{{ route('lot.destroy', $lot->id) }}"
                                            class="btn btn-danger mr-2 mb-2 delete-item"><i class="fas fa-trash"></i></a>
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
                    targets: [0, 1, 2, 3]
                },
                {
                    className: "dt-body-center",
                    targets: [0, 1, 2, 3]
                },
                {
                    width: '12%',
                    targets: 0
                },
                {
                    width: '20%',
                    targets: 3
                }
            ]
        });
    </script>
@endpush
