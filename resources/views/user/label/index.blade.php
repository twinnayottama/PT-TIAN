@extends('user.layouts.master')

@section('title-page')
    Label
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Halaman Data Label</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Label</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Tabel Data Label</h4>
                    <div class="card-header-action">
                        <a href="{{ route('label.create') }}" class="btn btn-primary mr-2">
                            Tambah Data
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table id="example" class="ui selectable celled table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor lot</th>
                                    <th>Jumlah Label</th>
                                    <th>Nomor seri label</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lots as $lot)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $lot->lot_number }}</td>
                                        <td>{{ $lot->label_count ?? '' }}</td>
                                        <td>{{ $lot->firstLabel ? $lot->firstLabel->serial_number : '' }} -
                                            {{ $lot->lastLabel ? $lot->lastLabel->serial_number : '' }}</td>
                                        <td>
                                            <a href="{{ route('label.show', $lot->id) }}"
                                                class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
            ]
        });
    </script>
@endpush
