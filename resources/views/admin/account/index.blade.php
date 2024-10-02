@extends('admin.layouts.master')

@section('title-page')
    Account
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Halaman Pengguna</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Halaman Pengguna</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.account.create') }}" class="btn btn-primary">
                            Tambah Data
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="ui selectable celled table" style="width:100%">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="{{ route('admin.account.edit', $user->id) }}"
                                            class="btn btn-success mr-2 mb-2"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.account.destroy', $user->id) }}"
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
                    width: '5%',
                    targets: 0
                },
                {
                    width: '50%',
                    targets: 2
                }
            ]
        });
    </script>
@endpush
