@extends('layouts/contentLayoutMaster')

@section('title', 'App Setting')

@section('page-style')
@endsection

@section('content')
    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card title="App Setting">
                    <x-form id="add-app-setting" :reset="0" method="POST" class="" :route="route('admin.setting.version-control')">
                        <x-divider type="success" text="Android" />
                        <div class="col-10 mb-2">
                            <x-input type="number" value="{{ $version->android_version ?? '' }}" attrs="required"
                                name="android_version" />
                        </div>
                        <div class="col-2 mb-2 text-center">
                            <x-custom-switch label="Force Update" id="andriod_force" :checked="$version->android_force_update ?? false" type="danger"
                                value="1" name="android_force_update" />
                        </div>
                        <x-divider type="success" text="IOS" />
                        <div class="col-10 mb-2">
                            <x-input type="number" value="{{ $version->ios_version ?? '' }}" attrs="required"
                                name="ios_version" />
                        </div>
                        <div class="col-2 mb-2 text-center">
                            <x-custom-switch label="Force Update" id="ios_force_update" :checked="$version->ios_force_update ?? false" type="danger"
                                value="1" name="ios_force_update" />
                        </div>
                    </x-form>
                </x-card>
            </div>
        </div>
    </section>


@endsection
@section('page-script')

@endsection
