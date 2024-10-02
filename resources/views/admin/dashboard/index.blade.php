@extends('admin.layouts.master')

@section('title-page')
    Dashboard
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Admin</h1>
        </div>

        <div class="row">
            @foreach ($cards as $card)
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-{{ $card['bg_color'] }}">
                            <i class="{{ $card['icon'] }}"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ $card['title'] }}</h4>
                            </div>
                            <div class="card-body mt-3">
                                {{ $card['value'] }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
