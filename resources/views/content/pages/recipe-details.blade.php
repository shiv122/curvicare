@extends('layouts/contentLayoutMaster')

@section('title', 'Recipe Details')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection
@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-user.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
    <section class="app-user-view">

        <div class="row">

            <div class="col-12">
                <div class="card user-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                <div class="user-avatar-section">
                                    <div class="d-flex justify-content-start">
                                        <img class="img-fluid rounded" src="{{ asset($recipe->image) }}" height="104"
                                            width="104" alt="User avatar" />
                                        <div class="d-flex flex-column ml-1">
                                            <div class="user-info mb-1">
                                                <h4 class="mb-0">{{ $recipe->name }}</h4>
                                            </div>
                                            <div class="d-flex flex-wrap">
                                                <a href="{{ route('admin.recipe.edit', $recipe->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <button class="btn btn-outline-danger ml-1">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                                <div class="user-info-wrapper">
                                    <div class="row">
                                        @forelse ($recipe->tags as $tag)
                                            <div class="col-md-6"> <span
                                                    class="align-middle badge badge-success">{{ $tag->name }}</span>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>



            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h4 class="card-title">Composition</h4>

                    </div>
                    <div class="card-body p-0">
                        <div class="row">
                            @forelse ($recipe->compositions as $comp)
                                <div class="col-md-6 text-center">
                                    <x-gauge id="composition_{{ $comp->id }}"
                                        value="{{ $comp->quantity?->percentage }}" label="{{ $comp->name }}" />
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="card user-card">
                    <div class="card-header d-flex justify-content-center align-items-center pt-75 pb-1">
                        <h4 class="mb-0">Foods</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card collapse-icon">

                                    <div class="card-body">
                                        <div class="collapse-margin" id="food_data">
                                            @forelse ($recipe->foods as $f)
                                                <div class="card">
                                                    <div class="card-header" id="headings-{{ $f->id }}"
                                                        data-toggle="collapse" role="button"
                                                        data-target="#collapse-{{ $f->id }}" aria-expanded="false"
                                                        aria-controls="collapse-{{ $f->id }}">
                                                        <span class="lead collapse-title"> {{ $f->name }} </span>
                                                    </div>

                                                    <div id="collapse-{{ $f->id }}" class="collapse"
                                                        aria-labelledby="headings-{{ $f->id }}"
                                                        data-parent="#food_data">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <x-divider text="Images" />
                                                                <div class="col-12">
                                                                    <x-swiper id="{{ $f->id }}" :images="$f->images->pluck('image')" />
                                                                </div>

                                                                <x-divider text="Ingredients" />
                                                                @forelse ($f->ingredients as $ing)
                                                                    <div class="col-12">
                                                                        <div class="media-list media-bordered">
                                                                            <div class="media">
                                                                                <div class="media-left">
                                                                                    <img src="{{ asset($ing->image) }}"
                                                                                        alt="avatar" height="64"
                                                                                        width="64"
                                                                                        class="rounded-circle view-on-click cursor-pointer">
                                                                                </div>
                                                                                <div class="media-body">
                                                                                    <h4 class="media-heading">
                                                                                        {{ $ing->name }}
                                                                                    </h4>
                                                                                    {{ $ing->description ?? 'No description' }}
                                                                                </div>
                                                                                <div class="">
                                                                                    <span class="badge badge-light-info">
                                                                                        {{ $ing->quantity->quantity }}
                                                                                        {{ $ing->quantity->unit }}

                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                @empty
                                                                @endforelse


                                                                <x-divider text="Description" />
                                                                <div class="col-12">
                                                                    {!! $f->description !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                    <div class="alert-body">
                                                        No Foods found.
                                                    </div>
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-center align-items-center pt-75">
                        <h4 class="mb-0">Caution</h4>
                    </div>
                    <div class="card-body px-1">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                    <div class="alert-body">
                                        <i data-feather="info" class="mr-50 align-middle"></i>
                                        <span>{{ $recipe->caution }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>
@endsection
@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
@endsection
@section('page-script')
@endsection
