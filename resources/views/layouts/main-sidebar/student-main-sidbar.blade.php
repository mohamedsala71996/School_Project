<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/student/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('main_trans.Programname') }}
        </li>
        <!-- calender classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#event-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">التقويم</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="event-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('calender_student') }}" target="_blank">عرض الأحداث</a> </li>

            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#quiz-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">الاختبارات</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="quiz-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('studentQuiz.index') }}">عرض الاختبارات </a> </li>

            </ul>
        </li>

        <!-- الملف الشخصي-->
        <li>
            <a href="{{ route('profileStudent') }}"><i class="fas fa-chalkboard"></i><span class="right-nav-text">الملف
                    الشخصي</span></a>
        </li>


    </ul>
</div>
