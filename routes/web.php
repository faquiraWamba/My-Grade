<?php

use App\Http\Controllers\ClassCourseController;
use App\Http\Controllers\ClassCourseTeacherController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\CourseTeacherController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResitController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TutorController;
use App\Models\Class_Course;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('api/students/reportCards/{matricule}/{semester}',[StudentController::class, 'student_report_card'])->name('student.report.card');
Route::prefix('download')->controller(PdfController::class)->group(function(){
    Route::get('student/report/semester/{semester}/{student_id}','studentReportPDF')->name('student.report');
    Route::get('student/report/card/{student_id}','studentReportCardPDF')->name('student.reportCard');
}); 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::middleware('is_admin')->group(function(){
        Route::prefix('specialities')->controller(SpecialityController::class)->group(function(){
            Route::get('/','index')->name('specialities');
            Route::get('/create','create')->name('speciality.create');
            Route::get('/{id}/edit','edit')->name('speciality.edit');
            Route::get('/{id}','show')->name('speciality');
            Route::put('/{id}/edit','update')->name('speciality.update');
            Route::post('/','store')->name('speciality.store');
            Route::delete('/delete','delete')->name('speciality.delete');
        });
        Route::prefix('classes')->controller(ClasseController::class)->group(function(){
            Route::get('/','index')->name('classes');
            Route::get('/create','create')->name('class.create');
            Route::get('/{id}','show')->name('class');
            Route::get('/{id}/edit','edit')->name('class.edit');
            Route::get('/level/{level}','showLevel')->name('class.level');
            Route::get('/class_note/{class_id}/{semester}','classNotes')->name('class.notes');
            Route::get('/class_catchup/courses/{class_id}/{semester}','classCatchup')->name('class.catchUp');
            Route::put('/{id}/update','update')->name('class.update');
            Route::post('/','store')->name('class.store');
            Route::delete('/delete','delete')->name('class.delete');
        });
        Route::prefix('Resits')->controller(ResitController::class)->group(function(){
            Route::post('/send-to-resit','sendToResit')->name('send.to.resit');
        
        });
        Route::prefix('students')->controller(StudentController::class)->group(function(){
            Route::get('/','index')->name('students');
            Route::get('/create','create')->name('student.create');
            Route::get('/{id}/edit','edit')->name('student.edit');
            Route::get('/{id}','show')->name('student');
            Route::put('/{id}/edit','update')->name('student.update');
            Route::post('/','store')->name('student.store');
            Route::delete('/delete','delete')->name('student.delete');
        });
        Route::prefix('courses')->controller(CourseController::class)->group(function(){
            Route::get('/','index')->name('courses');
            Route::get('/create','create')->name('course.create');
            Route::get('/{id}/edit','edit')->name('course.edit');
            Route::get('/{id}','show')->name('course');
            Route::put('/{id}/edit','update')->name('course.update');
            Route::post('/','store')->name('course.store');
            Route::delete('/delete','delete')->name('course.delete');
        });
        Route::prefix('teachers')->controller(TeacherController::class)->group(function(){
            Route::get('/','index')->name('teachers');
            Route::get('/create','create')->name('teacher.create');
            Route::get('/{id}/edit','edit')->name('teacher.edit');
            Route::get('/{id}','show')->name('teacher');
            Route::put('/{id}/edit','update')->name('teacher.update');
            Route::post('/','store')->name('teacher.store');
            Route::delete('/delete','delete')->name('teacher.delete');
        });
        Route::prefix('tutors')->controller(TutorController::class)->group(function(){
            Route::get('/','index')->name('tutors');
            Route::get('/create/{student_id?}','create')->name('tutor.create');
            Route::get('/{id}/edit','edit')->name('tutor.edit');
            Route::get('/{id}','show')->name('tutor');
            Route::put('/{id}/edit','update')->name('tutor.update');
            Route::post('/{student_id?}','store')->name('tutor.store');
            Route::delete('/delete','delete')->name('tutor.delete');
        });
        Route::prefix('class_courses')->controller(ClassCourseController::class)->group(function(){
            // Route::get('/{course_id}/{class_id}','index')->name('class_courses');
            Route::get('/create/{class_id}','create')->name('class_course.create');
            Route::post('/{class_id}','store')->name('class_course.store');
            Route::delete('/delete/{id}','destroy')->name('class_course.delete');
        });
        Route::prefix('teacher_course')->controller(CourseTeacherController::class)->group(function(){
            Route::get('/{id}','show')->name('teacher_course');
            Route::post('/coursteacher/{teacher_id}','store')->name('course_teacher.store');
            Route::delete('remove_course/{id}','destroy')->name('course_teacher.delete');
        });
        Route::prefix('class_course_teachers')->controller(ClassCourseTeacherController::class)->group(function(){
            // Route::get('/{id}','show')->name('teacher_class_course');
            Route::get('/addclass/{course_teacher_id}','create')->name('teacher_class_course.create');
            Route::post('/classcoursteacher/{teacher_course_id}','store')->name('teacher_class_course.store');
            Route::delete('delete/{teacher_course_id}/{class_course_id}','destroy')->name('class_course_teacher.delete');

        });
        Route::prefix('messages')->group(function(){
            Route::get('form/email/{class_id}/{semester}', [MessageController::class, 'formMessageGoogle'])->name('form_message');
            Route::post('store/{class_id}/{semester}', [MessageController::class, 'sendMessageGoogle'])->name('send.message.google');
        });

           });
    Route::middleware('is_adminteacher')->group(function(){
        Route::prefix('teacher_courses')->controller(ClassCourseTeacherController::class)->group(function(){
            Route::get('classes/{teacher_course_id}/{teacher_id?}','index')->name('my_class_courses');
            Route::get('classe/{teacher_course_id}/{class_course_id}/{admin?}','show')->name('my_class_course');
        });
        // Route::prefix('classes')->controller(ClasseController::class)->group(function(){
        //     Route::get('/{id}','show')->name('class');
        // });
    });
    Route::middleware('is_teacher')->group(function(){
        Route::prefix('teacher')->controller(CourseTeacherController::class)->group(function(){
            Route::get('/course','index')->name('teacher_courses');
            Route::get('/{id}','show')->name('teacher_course');
        });
        Route::prefix('notes')->controller(NoteController::class)->group(function(){
            Route::get('/notes','index')->name('notes');
            Route::post('/{type}/store','store')->name('notes.store');
            Route::post('/{type}/update','update')->name('notes.submit');
        });
       
    });
    Route::middleware('is_adminstudent')->group(function(){
        Route::prefix('courses_student')->controller(CourseStudentController::class)->group(function(){
            Route::get('/{student_id?}','index')->name('course_students');
            Route::get('note/{course_student_id}/{course_id}','show')->name('course_student.notes');
            Route::post('/{class_student_id}/{class_course_id}','store')->name('course_student.store');
            Route::delete('delete/{course_student_id}','destroy')->name('course_student.delete');
        }); 
        Route::prefix('class_courses')->controller(ClassCourseController::class)->group(function(){
            Route::get('/{class_id?}','index')->name('class_courses');
        });
       
       
    });
    
    Route::middleware('is_adminTutor')->group(function(){
        Route::prefix('childrens')->controller(TutorController::class)->group(function(){
            Route::get('of/{student_id?}','children')->name('children');
        }); 
    });
    Route::middleware('is_adminstudenttutor')->group(function(){
       
        Route::prefix('students')->controller(StudentController::class)->group(function(){
            Route::get('grades/student/{semester}/{student_id?}','notes')->name('student.notes');
            Route::get('card/byyear/{student_id?}/{school_year?}','card')->name('student.card');
        });
    });
});
Route::middleware(['auth'])->get('/home',[HomeController::class,'index'])->name('home');

require __DIR__.'/auth.php';
