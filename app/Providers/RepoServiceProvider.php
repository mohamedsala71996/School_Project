<?php

namespace App\Providers;

use App\Repository\Attendance\AttendanceRepository;
use App\Repository\Attendance\AttendanceRepositoryInterface;
use App\Repository\Exams\ExamRepository;
use App\Repository\Exams\ExamRepositoryInterface;
use App\Repository\ExamsTeacher\ExamsTeacherRepository;
use App\Repository\ExamsTeacher\ExamsTeacherRepositoryInterface;
use App\Repository\FeeInvoices\FeeInvoicesRepositoryInterface;
use App\Repository\FeeInvoices\FeeInvoicesRepository;
use App\Repository\fees\FeesRepository;
use App\Repository\fees\FeesRepositoryInterface;
use App\Repository\graduated\graduatedRepository;
use App\Repository\graduated\graduatedRepositoryInterface;
use App\Repository\Payment\PaymentRepository;
use App\Repository\Payment\PaymentRepositoryInterface;
use App\Repository\ProcessFee\ProcessFeeRepository;
use App\Repository\ProcessFee\ProcessFeeRepositoryInterface;
use App\Repository\promotions\promotionsRepository;
use App\Repository\promotions\promotionsRepositoryInterface;
use App\Repository\ReceiptStudent\ReceiptStudentRepository;
use App\Repository\ReceiptStudent\ReceiptStudentRepositoryInterface;
use App\Repository\students\StudentRepository;
use App\Repository\Subject\SubjectRepositoryInterface;
use App\Repository\Subject\SubjectRepository;
use App\Repository\students\StudentRepositoryInterface;
use App\Repository\TeacherRepository;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
