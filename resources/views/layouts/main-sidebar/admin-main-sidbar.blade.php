<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('main_trans.Programname') }}
        </li>

        <!-- Grades-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{ trans('main_trans.Grades') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('grade.index') }}">{{ trans('main_trans.Grades_list') }}</a></li>
            </ul>
        </li>

        <!-- classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                <div class="pull-left"><i ></i><span
                        class="right-nav-text">{{ trans('main_trans.classes') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('classroom.index') }}">{{ trans('My_Classes_trans.List_classes') }}</a>
                </li>
            </ul>
        </li>


        <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                        class="right-nav-text">{{ trans('main_trans.sections') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('section.index') }}">{{ trans('main_trans.List_sections') }}</a>
                </li>
            </ul>
        </li>

                <!-- students-->

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i
                    class="fas fa-user-graduate"></i>{{ trans('main_trans.students') }}<div class="pull-right"><i
                        class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="students-menu" class="collapse">
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Student_information">{{ trans('main_trans.Student_information') }}
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Student_information" class="collapse">
                        <li> <a href="{{ route('student.create') }}">{{ trans('main_trans.add_student') }}</a>
                        </li>
                        <li> <a href="{{ route('student.index') }}">{{ trans('main_trans.list_students') }}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Students_upgrade">{{ trans('main_trans.Students_Promotions') }}<div
                            class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Students_upgrade" class="collapse">
                        <li> <a href="{{ route('promotion.index') }}">{{ trans('main_trans.add_Promotion') }}</a>
                        </li>
                        <li> <a href="{{ route('promotion.create') }}">{{ trans('main_trans.list_Promotions') }}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Graduate students">{{ trans('main_trans.Graduate_students') }}<div
                            class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Graduate students" class="collapse">
                        <li> <a href="{{ route('graduated.create') }}">{{ trans('main_trans.add_Graduate') }}</a>
                        </li>
                        <li> <a href="{{ route('graduated.index') }}">{{ trans('main_trans.list_Graduate') }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>




        <!-- Teachers-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i></i><span
                        class="right-nav-text">{{ trans('main_trans.Teachers') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('teacher.index') }}">{{ trans('main_trans.List_Teachers') }}</a>
                </li>
            </ul>
        </li>


        <!-- Parents-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                <div class="pull-left"><i class="fas fa-user-tie"></i><span
                        class="right-nav-text">{{ trans('main_trans.Parents') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ url('add_parent') }}">{{ trans('main_trans.List_Parents') }}</a> </li>
            </ul>
        </li>

        <!-- Accounts-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                        class="right-nav-text">{{ trans('main_trans.Accounts') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('Fees.index') }}">{{ trans('main_trans.study_fees') }} </a> </li>
                <li> <a href="{{ route('FeeInvoice.index') }}">{{ trans('main_trans.Invoices') }}</a> </li>
                <li> <a href="{{ route('ReceiptStudent.index') }}">{{ trans('main_trans.receipt') }} </a> </li>
                <li> <a href="{{ route('ProcessFee.index') }}">{{ trans('main_trans.Exclude_fees') }} </a> </li>
                <li> <a href="{{ route('Payment.index') }}">{{ trans('main_trans.Bills_of_exchange') }} </a> </li>

            </ul>
        </li>

        <!-- Attendance-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                <div class="pull-left"><i class="fas fa-calendar-alt"></i><span
                        class="right-nav-text">{{ trans('main_trans.Attendance') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('Attendance.index') }}">{{ trans('main_trans.list_students') }} </a> </li>
            </ul>
        </li>

        <!-- Subjects-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">
                    {{ trans('main_trans.subject') }}  </span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Subjects-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('subjects.index') }}">{{ trans('main_trans.subject_list') }}</a> </li>
            </ul>
        </li>


        <!-- Exams-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span
                        class="right-nav-text">{{ trans('main_trans.Exams') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('Exams.index') }}">{{ trans('main_trans.Exams_list') }} </a> </li>
                <li> <a href="{{ route('quizzes.index') }}">{{ trans('main_trans.Quizes_list') }} </a> </li>
            </ul>

        </li>


        <!-- library-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                <div class="pull-left"><i></i><span
                        class="right-nav-text">{{ trans('main_trans.library') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('Library.index') }}">{{ trans('main_trans.Books_list') }}</a> </li>

            </ul>
        </li>

        <!-- Online classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span
                        class="right-nav-text">{{ trans('main_trans.Onlineclasses') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('OnlineIndirect.index') }}">{{ trans('main_trans.Indirect_communication_with_Zoom') }} </a> </li>

            </ul>
        </li>
        <!-- calender classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#event-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{ trans('main_trans.Calendar') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="event-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('full-calender') }}" target="_blank">{{ trans('main_trans.add_events') }} </a> </li>

            </ul>
        </li>



        <!-- Settings-->
        <li>
            <a href="{{ route('settings.index') }}">
                <div class="pull-left"><i></i><span
                        class="right-nav-text">{{ trans('main_trans.Settings') }}</span></div>
            </a>

        </li>


    </ul>
</div>
