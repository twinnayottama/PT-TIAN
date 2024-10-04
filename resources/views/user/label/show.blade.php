@extends('user.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Lihat Data Label</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('label.index') }}">Label</a></div>
                <div class="breadcrumb-item">Show</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Lihat Data Label</h4>

                    <div class="card-header-action">
                        <form action="{{ route('label.destroy', $lot->id) }}" method="POST" id="delete-all-form">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn btn-danger mr-2" id="delete-all-button">Hapus semua
                                label</button>
                            <a href="{{ route('label.index') }}" class="btn btn-warning">Kembali</a>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table id="example" class="ui selectable celled table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Seri Label</th>
                                    <th>Produsen Benih</th>
                                    <th>Kelas Benih</th>
                                    <th>Varietas</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach ($labels as $label)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $label->serial_number }}</td>
                                        <td>{{ $label->seed_producers }}</td>
                                        <td>{{ $label->seed_class }}</td>
                                        <td>{{ $label->varieties }}</td>
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

        document.getElementById('delete-all-button').addEventListener('click', function() {
            if (confirm('Apakah anda ingin menghapus semua data label?')) {
                document.getElementById('delete-all-form').submit();
            }
        });
    </script>
@endpush
