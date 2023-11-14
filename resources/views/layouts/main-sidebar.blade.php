<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            @if (auth()->guard('web')->check())
            @include('layouts.main-sidebar.admin-main-sidbar')
            @endif
            @if (auth()->guard('student')->check())
            @include('layouts.main-sidebar.student-main-sidbar')
            @endif
            @if (auth()->guard('teacher')->check())
            @include('layouts.main-sidebar.teacher-main-sidbar')
            @endif
            @if (auth()->guard('parent')->check())
            @include('layouts.main-sidebar.parent-main-sidbar')
            @endif
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
