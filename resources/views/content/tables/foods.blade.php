@extends('layouts/contentLayoutMaster')

@section('title', 'Foods')
@section('page-style')
@endsection

@section('content')

    <!-- Dashboard Analytics Start -->
    <section id="food-section">
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card>
                    <x-slot name="card_body">
                        {!! $dataTable->table() !!}
                    </x-slot>
                </x-card>
            </div>
        </div>
    </section>

@endsection
@section('page-script')
@endsection
