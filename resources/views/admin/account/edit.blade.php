@extends('admin.layouts.master')

@section('title-page')
    Edit
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Manajemen Pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.account.index') }}">Pengguna</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Edit Manajemen Pengguna</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.account.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}" autofocus>
                            @error('name')
                                <div class="text-danger">*{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}" autofocus>
                            @error('email')
                                <div class="text-danger">*{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror"
                                autofocus>
                                <option value="">-- Pilih Role --</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="text-danger">*{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password Baru <span class="text-warning">(Boleh kosong)</span></label>
                            <input type="password" id="password" name="password" class="form-control "
                                placeholder="Masukkan Password" value="{{ old('password') }}">
                        </div>

                        <button class="btn btn-primary mr-2" type="submit">Edit</button>
                        <a href="{{ route('admin.account.index') }}" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
