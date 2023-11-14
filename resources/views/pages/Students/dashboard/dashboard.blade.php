<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template">
    <meta name="author" content="potenzaglobalsolutions.com">
    <meta name="keywords" content="HTML5 Template">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')
</head>

<body style="font-family: 'Cairo', sans-serif">

    <div class="wrapper" style="font-family: 'Cairo', sans-serif">

        <!-- Preloader -->
        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>
        <!-- Preloader -->

        @include('layouts.main-header')
        @include('layouts.main-sidebar')

        <!-- Main content -->
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="mb-0">لوحة تحكم الطالب: {{ auth()->user()->Name }}</h4>
                            <br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">المرحلة الدراسية:</h4>
                                <p>{{ App\Models\Grade::where('id', auth()->user()->Grade_id)->first()->Name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">الفصل الدراسي:</h4>
                                <p>{{ App\Models\Classroom::where('id', auth()->user()->Classroom_id)->first()->Name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">القسم:</h4>
                                <p>{{ App\Models\Section::where('id', auth()->user()->section_id)->first()->Name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layouts.footer')
        </div>
    </div>

    @include('layouts.footer-scripts')

</body>

</html>
