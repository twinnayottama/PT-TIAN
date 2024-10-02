@extends('admin.layouts.master')

@section('title-page')
    Create
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Pengguna</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Tambah Pengguna</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.account.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Masukkan nama pengguna" value="{{ old('name') }}" autofocus>
                            @error('name')
                                <div class="text-danger">*{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email"
                                value="{{ old('email') }}" autofocus>
                            @error('email')
                                <div class="text-danger">*{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror"
                                autofocus>
                                <option value="">-- Pilih Role --</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role')
                                <div class="text-danger">*{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password"
                                value="{{ old('password') }}" autofocus>
                            @error('password')
                                <div class="text-danger">*{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-2" type="submit">Buat</button>
                        <a href="{{ route('admin.account.index') }}" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
