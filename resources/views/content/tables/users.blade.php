@extends('layouts/contentLayoutMaster')

@section('title', 'Users')
@section('page-style')
@endsection

@section('content')

    <!-- Dashboard Analytics Start -->
    <section id="user-section">
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card>
                    {!! $dataTable->table() !!}
                </x-card>
            </div>
        </div>
    </section>

    <x-modal id="data-viewer-modal" size="lg" title="description">

    </x-modal>

@endsection
@section('page-script')
@endsection
