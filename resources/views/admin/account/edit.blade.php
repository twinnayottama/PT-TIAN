@extends('admin.layouts.master')

@section('title-page')
    Edit
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Pengguna</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Edit Pengguna</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.account.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="password">Password Baru</label>
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
