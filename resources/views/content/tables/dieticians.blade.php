@extends('layouts/contentLayoutMaster')

@section('title', 'Dieticians')

@section('vendor-style')

@endsection
@section('page-style')
@endsection

@section('content')

    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card>

                    {!! $dataTable->table() !!}

                </x-card>
            </div>
        </div>
    </section>

@endsection
@section('vendor-script')
@endsection
@section('page-script')
@endsection
