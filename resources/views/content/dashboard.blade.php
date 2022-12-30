@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')
@section('page-style')
    <style>
        .avatar-content svg {
            width: 25px;
        }
    </style>
@endsection

@section('content')

    <section id="dashboard-analytics">
        <div class="row match-height">

            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card cursor-pointer">
                    <div class="card-header">
                        <div>
                            <h2 class="font-weight-bolder mb-0">8</h2>
                            <p class="card-text">New Users</p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="screen-users"
                                    class="svg-inline--fa fa-screen-users fa-w-20" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }
                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M320 383.1C355.2 383.8 383.8 355.3 383.8 320S355.2 256.2 320 256C284.8 256.2 256.2 284.7 256.2 320S284.8 383.8 320 383.1zM343.8 416h-47.5C256.4 416 224 449.5 224 490.7C224 502.4 233.3 512 244.8 512h150.3C406.7 512 416 502.4 416 490.7C416 449.5 383.6 416 343.8 416zM567.8 416h-47.5C480.4 416 448 449.5 448 490.7C448 502.4 457.3 512 468.8 512h150.3C630.7 512 640 502.4 640 490.7C640 449.5 607.6 416 567.8 416zM544 383.1C579.2 383.8 607.8 355.3 607.8 320S579.2 256.2 544 256C508.8 256.2 480.2 284.7 480.2 320S508.8 383.8 544 383.1zM96 383.1C131.2 383.8 159.8 355.3 159.8 320S131.2 256.2 96 256C60.78 256.2 32.21 284.7 32.21 320S60.78 383.8 96 383.1zM119.8 416h-47.5C32.42 416 0 449.5 0 490.7C0 502.4 9.34 512 20.83 512h150.3C182.7 512 192 502.4 192 490.7C192 449.5 159.6 416 119.8 416z"
                                            fill="currentColor"></path>
                                        <path class="fa-secondary"
                                            d="M96 64h448v160c24.62 0 47 9.625 64 25V49.63c0-27.38-21.5-49.63-48-49.63h-480c-26.5 0-48 22.25-48 49.63v199.4c17-15.38 39.38-25 64-25V64z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card cursor-pointer">
                    <div class="card-header">
                        <div>
                            <h2 class="font-weight-bolder mb-0">13</h2>
                            <p class="card-text">Total Subscribed Users</p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="user-cowboy"
                                    class="svg-inline--fa fa-user-cowboy fa-w-14" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }
                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M223.1 132.6c53.24 0 91.02-8.625 117.1-18.5C330 64.5 309.5 0 276.6 0c-10.37 0-19.62 4.5-27.37 10.5C241.8 16.28 232.9 19.13 224 19.29C215.1 19.13 206.2 16.28 198.8 10.5C191 4.5 181.8 0 171.4 0C138.6 0 118 64.5 106.9 114.1C133 124 170.7 132.6 223.1 132.6zM224 256c106.7 0 196.3-67.43 223.1-138.9c2.75-7.625-.938-15.94-8.686-19.44c-7.623-3.5-16.81-1.312-21.93 5.312c-.875 1.25-45.63 61.63-192.5 61.63S32.39 104.3 31.52 103C26.39 96.38 17.27 94.13 9.647 97.63c-7.75 3.5-11.5 11.88-8.749 19.5C27.66 188.6 117.3 256 224 256zM334 384H114c-53.44 0-100.1 36.38-113 88.24C-4.044 492.4 11.19 512 32 512h383.1c20.81 0 36.09-19.56 31.04-39.76C434.1 420.4 387.5 384 334 384z"
                                            fill="currentColor"></path>
                                        <path class="fa-secondary"
                                            d="M351.1 224c0 70.69-57.3 128-127.1 128S96 294.8 96 224.1c0-.9766 .2646-1.986 .2861-2.957C132.9 242.2 176.6 256 224 256s91.05-13.78 127.7-34.85C351.7 222.1 351.1 223 351.1 224z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card cursor-pointer">
                    <div class="card-header">
                        <div>
                            <h2 class="font-weight-bolder mb-0">93</h2>
                            <p class="card-text">Total Users</p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="users"
                                    class="svg-inline--fa fa-users fa-w-20" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }
                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M319.9 320c57.41 0 103.1-46.56 103.1-104c0-57.44-46.54-104-103.1-104c-57.41 0-103.1 46.56-103.1 104C215.9 273.4 262.5 320 319.9 320zM369.9 352H270.1C191.6 352 128 411.7 128 485.3C128 500.1 140.7 512 156.4 512h327.2C499.3 512 512 500.1 512 485.3C512 411.7 448.4 352 369.9 352z"
                                            fill="currentColor"></path>
                                        <path class="fa-secondary"
                                            d="M128 160c44.18 0 80-35.82 80-80S172.2 0 128 0C83.82 0 48 35.82 48 80S83.82 160 128 160zM512 160c44.18 0 80-35.82 80-80S556.2 0 512 0c-44.18 0-80 35.82-80 80S467.8 160 512 160zM551.9 192h-61.84c-12.8 0-24.88 3.037-35.86 8.24C454.8 205.5 455.8 210.6 455.8 216c0 33.71-12.78 64.21-33.16 88h199.7C632.1 304 640 295.6 640 285.3C640 233.8 600.6 192 551.9 192zM185.5 200.1C174.6 194.1 162.6 192 149.9 192H88.08C39.44 192 0 233.8 0 285.3C0 295.6 7.887 304 17.62 304h199.5c-20.38-23.79-33.16-54.29-33.16-88C183.9 210.6 184.9 205.4 185.5 200.1z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card cursor-pointer">
                    <div class="card-header">
                        <div>
                            <h2 class="font-weight-bolder mb-0">4</h2>
                            <p class="card-text">Total Dietician</p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="school"
                                    class="svg-inline--fa fa-school fa-w-20" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }
                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M497.8 111.1l-160-106.6c-10.75-7.164-24.75-7.164-35.5 0l-160 106.6C133.4 117.1 128 127.1 128 138.6v373.4l128-.0049v-128c0-17.67 14.33-32 32-32h64c17.67 0 32 14.33 32 32v128l128 .0049V138.6C512 127.1 506.6 117.1 497.8 111.1zM320 255.1c-44.13 0-80-35.88-80-80.01c0-44.13 35.88-80 80-80s80 35.87 80 80C400 220.1 364.1 255.1 320 255.1z"
                                            fill="currentColor"></path>
                                        <path class="fa-secondary"
                                            d="M0 247.1v232.9c0 17.67 14.33 32 32 32l96 .0048V181.4L21.88 216.7C8.811 221.1 0 233.3 0 247.1zM618.1 216.7L512 181.4v330.7l96-.0048c17.67 0 32-14.33 32-32V247.1C640 233.3 631.2 221.1 618.1 216.7zM352 159.1l-16-.0055V143.1c0-8.801-7.199-15.1-16-15.1S304 135.2 304 143.1v32c0 8.801 7.201 16 16 16H352c8.801 0 16-7.201 16-16C368 167.2 360.8 159.1 352 159.1z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card cursor-pointer">
                    <div class="card-header">
                        <div>
                            <h2 class="font-weight-bolder mb-0">21</h2>
                            <p class="card-text">Total Subscription</p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="images-user"
                                    class="svg-inline--fa fa-images-user fa-w-18" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }
                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M240 320h192c8.836 0 16-7.164 16-16c0-26.51-21.49-48-48-48h-128c-26.51 0-48 21.49-48 48C224 312.8 231.2 320 240 320zM336 224c35.35 0 64-28.66 64-64s-28.65-64-64-64s-64 28.66-64 64S300.7 224 336 224zM456 480H120C53.83 480 0 426.2 0 360v-240C0 106.8 10.75 96 24 96S48 106.8 48 120v240c0 39.7 32.3 72 72 72h336c13.25 0 24 10.75 24 24S469.3 480 456 480z"
                                            fill="currentColor"></path>
                                        <path class="fa-secondary"
                                            d="M528 32h-384C117.5 32 96 53.49 96 80v256C96 362.5 117.5 384 144 384h384c26.51 0 48-21.49 48-48v-256C576 53.49 554.5 32 528 32zM336 96c35.35 0 64 28.66 64 64s-28.65 64-64 64s-64-28.66-64-64S300.7 96 336 96zM432 320h-192c-8.836 0-16-7.164-16-16c0-26.51 21.49-48 48-48h128c26.51 0 48 21.49 48 48C448 312.8 440.8 320 432 320z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="card cursor-pointer">
                    <div class="card-header">
                        <div>
                            <h2 class="font-weight-bolder mb-0">1198</h2>
                            <p class="card-text">Total Profit</p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                    data-icon="calendar-clock" class="svg-inline--fa fa-calendar-clock fa-w-18"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }
                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M448 112C448 85.49 426.5 64 400 64H352V31.1C352 14.33 337.7 0 320 0S288 14.33 288 31.1V64H160V31.1C160 14.33 145.7 0 128 0S96 14.33 96 31.1V64H48C21.49 64 0 85.49 0 112V192h448V112zM432 224C352.5 224 288 288.5 288 368s64.46 144 144 144C511.5 512 576 447.5 576 368S511.5 224 432 224zM480 384h-48c-8.844 0-16-7.156-16-16V304.8c0-8.844 7.156-16 16-16s16 7.156 16 16V352h32c8.844 0 16 7.156 16 16S488.8 384 480 384z"
                                            fill="currentColor"></path>
                                        <path class="fa-secondary"
                                            d="M448 192h-16c5.402 0 10.72 .3301 16 .8066V192zM256 368C256 270.8 334.8 192 432 192H0v272C0 490.5 21.5 512 48 512h283C285.7 480.2 256 427.6 256 368z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-12">
                <div class="card cursor-pointer">
                    <div class="card-header">
                        <div>
                            <h2 class="font-weight-bolder mb-0">58</h2>
                            <p class="card-text">Total Recipe</p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                    data-icon="address-card" class="svg-inline--fa fa-address-card fa-w-18"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }
                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M176 256c35.35 0 64-28.65 64-64s-28.65-64-64-64s-64 28.65-64 64S140.7 256 176 256zM208 288h-64C99.82 288 64 323.8 64 368C64 376.8 71.16 384 80 384h192c8.836 0 16-7.164 16-16C288 323.8 252.2 288 208 288z"
                                            fill="currentColor"></path>
                                        <path class="fa-secondary"
                                            d="M512 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h448c35.35 0 64-28.65 64-64V96C576 60.65 547.3 32 512 32zM176 128c35.35 0 64 28.65 64 64s-28.65 64-64 64s-64-28.65-64-64S140.7 128 176 128zM272 384h-192C71.16 384 64 376.8 64 368C64 323.8 99.82 288 144 288h64c44.18 0 80 35.82 80 80C288 376.8 280.8 384 272 384zM496 320h-128C359.2 320 352 312.8 352 304S359.2 288 368 288h128C504.8 288 512 295.2 512 304S504.8 320 496 320zM496 256h-128C359.2 256 352 248.8 352 240S359.2 224 368 224h128C504.8 224 512 231.2 512 240S504.8 256 496 256zM496 192h-128C359.2 192 352 184.8 352 176S359.2 160 368 160h128C504.8 160 512 167.2 512 176S504.8 192 496 192z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-4 col-12">
                <div class="card cursor-pointer">
                    <div class="card-header">
                        <div>
                            <h2 class="font-weight-bolder mb-0">31</h2>
                            <p class="card-text">Paid Recipe</p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                    data-icon="id-card-clip" class="svg-inline--fa fa-id-card-clip fa-w-18"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }
                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M352 32c0-19.2-12.8-32-32-32H256C236.8 0 224 12.8 224 32v96h128V32zM288 352c35.35 0 64-28.66 64-64s-28.65-64-64-64S224 252.7 224 288S252.7 352 288 352zM352 384H224c-26.51 0-48 21.49-48 48C176 440.8 183.2 448 192 448h192c8.836 0 16-7.164 16-16C400 405.5 378.5 384 352 384z"
                                            fill="currentColor"></path>
                                        <path class="fa-secondary"
                                            d="M528 64H352v64h16C377.6 128 384 134.4 384 144S377.6 160 368 160h-160C198.4 160 192 153.6 192 144S198.4 128 208 128H224V64H48C22.4 64 0 86.4 0 112v352C0 489.6 22.4 512 48 512h480c25.6 0 48-22.4 48-48v-352C576 86.4 553.6 64 528 64zM288 224c35.35 0 64 28.66 64 64s-28.65 64-64 64s-64-28.66-64-64S252.7 224 288 224zM384 448H192c-8.836 0-16-7.164-16-16C176 405.5 197.5 384 224 384h128c26.51 0 48 21.49 48 48C400 440.8 392.8 448 384 448z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-12">
                <div class="card cursor-pointer">
                    <div class="card-header">
                        <div>
                            <h2 class="font-weight-bolder mb-0">59</h2>
                            <p class="card-text">Total Blogs</p>
                        </div>
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone"
                                    data-icon="user-xmark" class="svg-inline--fa fa-user-xmark fa-w-20" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <defs>
                                        <style>
                                            .fa-secondary {
                                                opacity: .4
                                            }
                                        </style>
                                    </defs>
                                    <g class="fa-group">
                                        <path class="fa-primary"
                                            d="M577.9 223.1l47.03-47.03c9.375-9.375 9.375-24.56 0-33.94s-24.56-9.375-33.94 0L544 190.1l-47.03-47.03c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l47.03 47.03l-47.03 47.03c-9.375 9.375-9.375 24.56 0 33.94c9.373 9.373 24.56 9.381 33.94 0L544 257.9l47.03 47.03c9.373 9.373 24.56 9.381 33.94 0c9.375-9.375 9.375-24.56 0-33.94L577.9 223.1z"
                                            fill="currentColor"></path>
                                        <path class="fa-secondary"
                                            d="M224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3C0 496.5 15.52 512 34.66 512h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row match-height">
            <section id="apexchart">
                <div class="row">
                    <!-- Area Chart starts -->
                    <div class="col-12">
                        <div class="card">
                            <div
                                class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                                <div>
                                    <h4 class="card-title">User Stats</h4>

                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="font-medium-2" data-feather="calendar"></i>
                                    <input type="text"
                                        class="form-control flat-picker bg-transparent border-0 shadow-none"
                                        placeholder="YYYY-MM-DD" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="line-area-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Area Chart ends -->

                    <!-- Column Chart Starts -->
                    <div class="col-12">
                        <div class="card">
                            <div
                                class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                                <h4 class="card-title">Plan Sold</h4>
                                <div class="d-flex align-items-center mt-md-0 mt-1">
                                    <i class="font-medium-2" data-feather="calendar"></i>
                                    <input type="text"
                                        class="form-control flat-picker bg-transparent border-0 shadow-none"
                                        placeholder="YYYY-MM-DD" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="column-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column Chart Ends -->


                    <!-- Line Chart Starts -->
                    <div class="col-12">
                        <div class="card">
                            <div
                                class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                                <div>
                                    <h4 class="card-title mb-25">Subscription</h4>
                                </div>
                                <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                                    <h5 class="fw-bolder mb-0 me-1">₹ 100,000</h5>
                                    <span class="badge badge-light-secondary">
                                        <i class="text-danger font-small-3" data-feather="arrow-down"></i>
                                        <span class="align-middle">20%</span>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="line-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Line Chart Ends -->

                    <!-- Bar Chart Starts -->
                    <div class="col-xl-12 col-12">
                        <div class="card">
                            <div
                                class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                                <div>
                                    <p class="card-subtitle text-muted mb-25">Earnings</p>
                                    <h4 class="card-title fw-bolder">₹74,382.72</h4>
                                </div>
                                <div class="d-flex align-items-center mt-md-0 mt-1">
                                    <i class="font-medium-2" data-feather="calendar"></i>
                                    <input type="text"
                                        class="form-control flat-picker bg-transparent border-0 shadow-none"
                                        placeholder="YYYY-MM-DD" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="bar-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Bar Chart Ends -->
                </div>
            </section>

        @endsection

        @section('page-script')
            <script src="{{ asset(mix('js/scripts/charts/chart-apex.js')) }}"></script>
            <script>
                window.me = @json(auth()->user());
            </script>
            <script src="{{ asset(mix('js/app.js')) }}"></script>
        @endsection
