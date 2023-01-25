@extends('layouts/contentLayoutMaster')

@section('title', 'User Details')
@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-user.css')) }}" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.css">
    <style>
        .badge i,
        .badge svg {
            height: 20px !important;
            width: 20px !important;
        }
    </style>
@endsection

@section('content')

    <section class="app-user-view-account">
        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-4 order-1 order-md-0">
                <!-- User Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <div class="user-info text-center">
                                    <h4>{{ $user->name ?? 'N/A' }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around my-2 pt-75">
                            <div class="d-flex align-items-start mr-2">
                                <span class="badge bg-light-primary p-75 rounded">

                                    <svg aria-hidden="true" focusable="false" data-prefix="fa-light"
                                        data-icon="bullseye-arrow" class="svg-inline--fa fa-bullseye-arrow fa-w-16"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M509.7 221.9c-1.156-8.781-9.5-15.31-17.97-13.72c-8.75 1.156-14.91 9.219-13.72 17.97C479.3 235.9 480 245.1 480 256c0 123.5-100.5 224-224 224s-224-100.5-224-224s100.5-224 224-224c10.03 0 20.06 .6562 29.88 1.969c8.5 1.5 16.81-4.969 17.97-13.72c1.188-8.75-4.969-16.81-13.72-17.97C278.9 .75 267.4 0 256 0C114.8 0 0 114.8 0 256s114.8 256 256 256s256-114.8 256-256C512 244.6 511.3 233.1 509.7 221.9zM256 128c8.844 0 16-7.156 16-16S264.8 96 256 96C167.8 96 96 167.8 96 256s71.78 160 160 160s160-71.78 160-160c0-8.844-7.156-16-16-16S384 247.2 384 256c0 70.59-57.41 128-128 128s-128-57.41-128-128S185.4 128 256 128zM244.7 244.7c-6.25 6.25-6.25 16.38 0 22.62c6.246 6.246 16.37 6.254 22.62 0l89.95-89.95l71.6 14.32c1.047 .2031 2.094 .3119 3.141 .3119c4.203 0 8.281-1.656 11.31-4.687l64-64c4.172-4.172 5.703-10.3 4-15.95c-1.703-5.641-6.391-9.891-12.17-11.05l-69.55-13.91l-13.91-69.55c-1.156-5.781-5.408-10.47-11.05-12.17c-5.672-1.719-11.77-.1719-15.95 4l-64 64c-3.781 3.781-5.422 9.203-4.375 14.45l14.32 71.6L244.7 244.7zM421.3 113.4l42.29 8.461l-36.81 36.8l-42.28-8.451L421.3 113.4zM390.2 48.46l8.461 42.29l-36.81 36.8l-8.451-42.28L390.2 48.46z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <div class=" ml-75">
                                    <h4 class="mb-0">{{ $user->user_data->user_goal->name ?? 'N/A' }}</h4>
                                    <small>Goal</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <span class="badge bg-light-primary p-75 rounded">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fa-light"
                                        data-icon="person-running" class="svg-inline--fa fa-person-running fa-w-14"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path
                                            d="M296 112C326.9 112 352 86.88 352 56S326.9 0 296 0S240 25.12 240 56S265.1 112 296 112zM296 32C309.2 32 320 42.77 320 56S309.2 80 296 80S272 69.23 272 56S282.8 32 296 32zM151.2 337.7c-7.906-3.906-17.47-.7344-21.47 7.156L118.1 368H32c-8.844 0-16 7.156-16 16s7.156 16 16 16h96c6.062 0 11.59-3.422 14.31-8.844l16-32C162.3 351.3 159.1 341.6 151.2 337.7zM416 240h-60.11c-6.125 0-11.62-3.43-14.34-8.898l-20.52-40.79c-13.62-27.23-36.09-49.73-63.34-63.36C238.1 117.2 216.2 112 194.3 112H154.7c-10.31 0-20.56 3.422-28.78 9.609L70.41 163.2c-7.062 5.297-8.5 15.33-3.219 22.39c5.312 7.094 15.34 8.5 22.41 3.203l55.5-41.59C147.8 145.1 151.2 144 154.7 144h39.69c3.738 0 7.396 .916 11.12 1.301L170.4 215.5C152.8 250.6 163.8 294.2 196.1 316.8l105.4 73.78l-28.84 101c-2.438 8.484 2.469 17.34 10.97 19.78C285.1 511.8 286.6 512 288 512c6.969 0 13.38-4.578 15.38-11.61l32-112c1.875-6.562-.5938-13.58-6.188-17.5L214.4 290.6c-19.38-13.55-26-39.69-15.44-60.8l38.22-76.42c2.014 .8574 4.201 1.25 6.158 2.229c21.09 10.53 38.5 27.95 49.03 49.05l20.44 40.83C321 261.8 337.5 272 355.8 272H416c8.844 0 16-7.156 16-16S424.8 240 416 240z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <div class=" ml-75">
                                    <h4 class="mb-0">{{ $user->user_data->user_activity->name ?? 'N/A' }}</h4>
                                    <small>Activty</small>
                                </div>
                            </div>
                        </div>
                        <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-75 d-flex justify-content-between">
                                    <span class="fw-bolder mr-25">Name:</span>
                                    <span>{{ $user->name ?? 'N/A' }}</span>
                                </li>
                                <li class="mb-75 d-flex justify-content-between">
                                    <span class="fw-bolder mr-25">email:</span>
                                    <span>{{ $user->email ?? 'N/A' }}</span>
                                </li>
                                <li class="mb-75 d-flex justify-content-between">
                                    <span class="fw-bolder mr-25">phone:</span>
                                    <span>{{ $user->phone ?? 'N/A' }}</span>
                                </li>
                                <li class="mb-75 d-flex justify-content-between">
                                    <span class="fw-bolder mr-25">Gender:</span>
                                    <span>{{ $user->user_data->gender ?? 'N/A' }}</span>
                                </li>
                                <li class="mb-75 d-flex justify-content-between">
                                    <span class="fw-bolder mr-25">DOB:</span>
                                    <span>{{ $user->user_data->dob ?? 'N/A' }}</span>
                                </li>
                                <li class="mb-75 d-flex justify-content-between">
                                    <span class="fw-bolder mr-25">Height (cm):</span>
                                    <span>{{ $user->user_data->height ?? 'N/A' }}</span>
                                </li>
                                <li class="mb-75 d-flex justify-content-between">
                                    <span class="fw-bolder mr-25">Weight (kg):</span>
                                    <span>{{ $user->user_data->weight ?? 'N/A' }}</span>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>

                <div class="card border-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-2 align-items-start">
                            <span class="badge bg-light-primary">Medical Condition</span>
                        </div>
                        <div class="col-12">
                            <ul class="list-unstyled">
                                @forelse ($user->medical_conditions as $key => $condition)
                                    <li class="mb-75">
                                        <span class="fw-bolder mr-25">Condition {{ $key + 1 }} :</span>
                                        <span class="badge badge-light-danger">{{ $condition->condition->name }}</span>
                                    </li>
                                @empty
                                    <li class="mb-75">
                                        <span class="badge badge-light-success">No Medical Condition</span>
                                    </li>
                                @endforelse

                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8 col-lg-8 order-1 order-md-0">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h4 class="card-title text-center">User Mood History</h4>
                            </div>
                            <div class="table-responsive">
                                <table data-toggle="table" data-search="true" data-pagination="true"
                                    class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Mood</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($user->moods as $mood)
                                            <tr>
                                                <td>{{ $mood->id }}</td>
                                                <td>{{ $mood->mood->name }}</td>
                                                <td>{{ $mood->created_at->format('jS F Y h:i A') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-danger">No mood histry found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h4 class="card-title text-center">User water intake history</h4>
                            </div>
                            <div class="table-responsive">
                                <table data-toggle="table" data-search="true" data-pagination="true"
                                    class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>water intake (ml)</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($user->water as $w)
                                            <tr>
                                                <td>{{ $w->id }}</td>
                                                <td>{{ $w->water_amount }}ml.</td>
                                                <td>{{ $w->created_at->format('jS F Y h:i A') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-danger">
                                                    No Water intake history found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h4 class="card-title text-center">User step counter history</h4>
                            </div>
                            <div class="table-responsive">
                                <table data-toggle="table" data-search="true" data-pagination="true"
                                    class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Step count</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($user->steps as $step)
                                            <tr>
                                                <td>{{ $step->id }}</td>
                                                <td>{{ $step->step_count }} steps.</td>
                                                <td>{{ $step->created_at->format('jS F Y h:i A') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-danger">
                                                    No Water intake history found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header justify-content-center">
                                <h4 class="card-title text-center">User subscription history</h4>
                            </div>
                            <div class="table-responsive">
                                <table data-toggle="table" data-search="true" data-pagination="true"
                                    class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Package Name</th>
                                            <th>Package Price</th>
                                            <th>Currency</th>
                                            <th>Start Date</th>
                                            <th>End Date </th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($user->subscriptions as $sub)
                                            <tr>
                                                <td>{{ $sub->id }}</td>
                                                <td>{{ json_decode($sub->subscription, true)['title'] }}</td>
                                                <td>{{ $sub->transaction->paid_amount }}</td>
                                                <td>{{ $sub->transaction->currency }}</td>
                                                <td>{{ \Carbon\Carbon::createFromDate($sub->start_date)->format('jS F Y h:i A') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::createFromDate($sub->end_date)->format('jS F Y h:i A') }}
                                                </td>
                                                <td>{{ $sub->created_at->format('jS F Y h:i A') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-danger">
                                                    No Water intake history found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>





        </div>
    </section>

@endsection

@section('page-script')
    <script src="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.js"></script>
@endsection
