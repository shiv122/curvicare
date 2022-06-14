@extends('layouts/contentLayoutMaster')

@section('title', 'Blog List')
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base/pages/page-blog.css') }}" />
@endsection

@section('content')
    <section id="dashboard-analytics">
        <div class="blog-list-wrapper">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h4>Blogs</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row match-height">
                @forelse ($blogs as $b)
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <a href="page-blog-detail.html">
                                <img class="card-img-top img-fluid" src="{{ asset($b->image->image) }}"
                                    alt="Blog Post pic">
                            </a>
                            <div class="card-body d-flex flex-column">
                                <h4 class="card-title">
                                    <a href="page-blog-detail.html" class="blog-title-truncate text-body-heading">
                                        {{ $b->title }}
                                    </a>
                                </h4>
                                <div class="media">
                                    <div class="avatar mr-50">
                                        <img src="{{ asset($b->dietician->image) }}" alt="{{ $b->dietician->name }}"
                                            width="24" height="24">
                                    </div>
                                    <div class="media-body">
                                        <small class="text-muted mr-25">by</small>
                                        <small><a href="javascript:void(0);"
                                                class="text-body">{{ $b->dietician->name }}</a></small>
                                        <span class="text-muted ml-50 mr-25">|</span>
                                        <small class="text-muted">{{ $b->created_at }}</small>
                                    </div>
                                </div>
                                <div class="my-1 py-25">
                                    @forelse ($b->tags as $t)
                                        <a href="javascript:void(0);">
                                            <div class="badge badge-pill badge-light-info mr-50">{{ $t->tag->name }}</div>
                                        </a>
                                    @empty
                                    @endforelse
                                </div>
                                <span class="card-text blog-content-truncate">
                                    {{-- {{ Str::of($b->description)->limit(50) }} --}}
                                    {!! $b->description !!}
                                </span>

                                <div class="d-flex flex-column justify-content-end align-baseline h-50">
                                    <div>
                                        <hr>
                                    </div>
                                    <a href="{{ route('work-in-progress') }}" class="font-weight-bold">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
@endsection

@section('page-script')
@endsection
