<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\classrooms\ClassroomController;
use App\Http\Controllers\Exams\ExamController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Controllers\Online_classes\OnlineIndirectController;
use App\Http\Controllers\Parent\dashboard\parentprofileController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Students\FeeInvoiceController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Students\Promotion\PromotionController;
use App\Http\Controllers\Students\Graduated\GraduatedController;
use App\Http\Controllers\Students\Payment\PaymentController;
use App\Http\Controllers\Students\ProcessFee\ProcessFeeController;
use App\Http\Controllers\Students\ReceiptStudent\ReceiptStudentController;
use App\Http\Controllers\Students\Attendance\AttendanceController;
use App\Http\Controllers\Students\dashboard\FullCalenderStudentController;
use App\Http\Controllers\Students\dashboard\profileStudentController;
use App\Http\Controllers\Students\dashboard\StudentQuizController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Teachers\dashboard\ExamsTeacherController;
use App\Http\Controllers\Teachers\dashboard\QuestionController;
use App\Http\Controllers\Teachers\dashboard\QuizController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Teachers\dashboard\StudentsTeacherController;
use App\Http\Controllers\Teachers\dashboard\profileController;
use App\Http\Controllers\Parent\dashboard\SonController;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Support\Facades\DB;


// -------------------------common----------------------------

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher,web']
    ],
    function () {

        Route::resource('quizzes', QuizController::class);
        Route::get('/Get_classrooms/{id}', [QuizController::class, 'getClassrooms']);
        Route::get('/Get_Sectionss/{id}', [QuizController::class, 'Get_Sectionss']);
        Route::get('/add_questions/{id}', [QuestionController::class, 'add_questions']);
        Route::resource('question', QuestionController::class);
        Route::get('showResults/{quiz_id}', [QuestionController::class, 'show_results'])->name("question.show_results");
        Route::resource('OnlineIndirect', OnlineIndirectController::class);
        Route::get('classes/{id}', [SectionController::class, 'classes'])->name("classes");
        Route::get('Get_Sections/{id}', [StudentController::class, 'Get_Sections'])->name("Get_Sections");
        Route::get('full-calender', [FullCalenderController::class, 'index'])->name("full-calender");
        Route::post('full-calender/action', [FullCalenderController::class, 'action']);
    }
);



// -----------------------------------student----------------------------------------

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/student/dashboard', function () {
            return view('pages.Students.dashboard.dashboard');
        });

        Route::get('calender_student', [FullCalenderStudentController::class, 'index'])->name("calender_student");
        Route::post('calender_student/action', [FullCalenderStudentController::class, 'action']);
        Route::resource('studentQuiz', StudentQuizController::class);
        Route::get('profileStudent', [profileStudentController::class, 'index'])->name("profileStudent");
        Route::post('profileStudent/update', [profileStudentController::class, 'update'])->name("profileStudent.update");
    }
);

// -----------------------------------teacher----------------------------------------

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/teacher/dashboard', function () {
            $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck("section_id");
            $section_count = Section::whereIn("id", $ids)->count();
            $student_count = Student::whereIn("section_id", $ids)->count();
            return view('pages.Teachers.dashboard.dashboard', compact("student_count", "section_count"));
        });

        Route::get('/StudentsTeacher', [StudentsTeacherController::class, 'index'])->name("StudentsTeacher");
        Route::get('/SectionsTeacher', [StudentsTeacherController::class, 'Sections_method'])->name("SectionsTeacher");
        Route::get('/attendanceTeacher', [StudentsTeacherController::class, 'attendance'])->name("attendanceTeacher");
        Route::get('/attendanceShow/{id}', [StudentsTeacherController::class, 'attendanceShow'])->name("attendanceShow");
        Route::post('/storeAttendance', [StudentsTeacherController::class, 'store_attendance'])->name("storeAttendance");
        Route::get('/attendanceReport', [StudentsTeacherController::class, 'attendance_report'])->name("attendanceReport");
        Route::post('/attendanceReport', [StudentsTeacherController::class, 'attendance_report_show'])->name("attendanceReportShow");
        Route::resource('ExamsTeacher', ExamsTeacherController::class);
        Route::get('profile', [profileController::class, 'index'])->name("profile.index");
        Route::post('profile/update', [profileController::class, 'update'])->name("profile.update");
    }
);



// -----------------------------------parent----------------------------------------
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/parent/dashboard', function () {
            $sons = Student::where("parent_id", auth()->user()->id)->get();
            return view('pages.parents.dashboard', compact("sons"));
        });

        Route::resource('sons', SonController::class);
        Route::get('/son_attendance', [SonController::class, 'attendance_report'])->name("son.attendance");
        Route::post('/son_attendance_show', [SonController::class, 'attendance_report_show'])->name("son.attendance.show");
        Route::get('/sonFeesInvoices', [SonController::class, 'feesInvoices'])->name("son.feesInvoices");
        Route::get('/receipt_sons/{id}', [SonController::class, 'receipt_sons'])->name("son.receipt");
        Route::get('parent_profile', [parentprofileController::class, 'index'])->name("parent_profile.index");
        Route::post('parent_profile/update', [parentprofileController::class, 'update'])->name("parent_profile.update");
    }
);


// -------------------------------------login--------------------------------
Route::get('/', [HomeController::class, 'index'])->name("selection");
Route::get('/login/{type}', [LoginController::class, 'show'])->middleware("guest")->name("login.show");
Route::post("/login", [LoginController::class, 'login'])->name("login");
Route::post('/logout/{type}', [LoginController::class, 'logout'])->name("logout");



// -----------------------------------admin----------------------------------------


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {



        Route::middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified',
        ])->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
        });
        Route::resource('grade', GradeController::class);
        Route::resource('classroom', ClassroomController::class);
        Route::delete('delete-all', [ClassroomController::class, 'removeMulti']);
        Route::get('search', [ClassroomController::class, 'search'])->name("search");
        Route::resource('section', SectionController::class);
        Route::get('downloadFile/{student_name}/{file_name}', [StudentController::class, 'downloadFile'])->name("downloadFile");
        Route::get('download_file/{file_name}', [LibraryController::class, 'download_file'])->name("download_file");
        Route::post('upload_files', [StudentController::class, 'upload_files'])->name("upload_files");
        Route::post('delete_files', [StudentController::class, 'delete_files'])->name("delete_files");
        Route::resource('teacher', TeacherController::class);
        Route::resource('student', StudentController::class);
        Route::resource('promotion', PromotionController::class);
        Route::post('destroy_one', [PromotionController::class, 'destroy_one'])->name("destroy_one");
        Route::resource('graduated', GraduatedController::class);
        Route::resource('Fees', FeesController::class);
        Route::resource('FeeInvoice', FeeInvoiceController::class);
        Route::resource('ReceiptStudent', ReceiptStudentController::class);
        Route::resource('ProcessFee', ProcessFeeController::class);
        Route::resource('Payment', PaymentController::class);
        Route::resource('Attendance', AttendanceController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('Exams', ExamController::class);
        Route::resource('Library', LibraryController::class);
        Route::resource('settings', SettingController::class);
        Route::get('amount/{id}', [FeeInvoiceController::class, 'amount'])->name("amount");
    }
);

// --------------------------------------Parent_livewire------------------------------------
Route::view('add_parent', 'livewire.show_Form')->name("add_parent");
