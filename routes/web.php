<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
        #################################################################
        #################################################################
        #Mcamarac package for local translatable and Session translatable#
        #################################################################
        #################################################################

Auth::routes();
Route::group(['middleware' => 'guest'],function(){
    Route::get('/', function()
    {
        return view('auth.login');
    });

});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

         ###################### start Grade ################
        Route::group(['namespace' => 'Grade'],function(){

            Route::resource('grade', 'GradeController');

        });

        ###################### start Classrooms ################
        Route::group(['namespace' => 'Classroom'],function(){

            Route::resource('classroom', 'ClassroomController');
            Route::post('delete_all','ClassroomController@deleteAll')->name('delete_all');
        });

        ###################### start Sections ################
         Route::group(['namespace' => 'Sections'],function(){

             Route::resource('section', 'SectionController');
             Route::get('/classes/{id}', 'SectionController@getclasses');

         });

        ###################### start Parent With Livewire ################

        Route::view('parents','livewire.show_form')->name('parents');


        ###################### start Sections ################
        Route::group(['namespace' => 'Teachers'],function(){

            Route::resource('teachers', 'TeachersController');
        });

        ###################### start Students ################
        Route::group(['namespace' => 'Students'],function(){

            Route::resource('students', 'StudentController');
            Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
            Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
            Route::post('upload-image', 'StudentController@upload_image')->name('upload_image');
            Route::get('Download_attachment/{students_name}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
            Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');

                    ####### Student Promotion ############
            Route::resource('promotion','PromotionController');

                    ####### Students Graduation ############
            Route::resource('graduations','GraduationController');
            Route::post('delete/{id}','MainCategoriesController@graduate')->name('admin.mainCategories.delete');
        });


             ################## Start Fees ###########
        Route::group(['namespace' => 'Fees'],function(){

            Route::resource('fees','FeesController');
            Route::resource('fees_invoice','FeesInvoiceControoler');
            Route::resource('receipt_student','ReceiptStudentController');
                                        //استبعاد فلوس
            Route::resource('processing_fees','ProcessingFeesController');
                    //الطالب هيسترد فلوس دفعها وليكن هياخد فلوس الباص
            Route::resource('PaymentStudent','PaymentStudentController');

        });

          ###################### start Attendance ################

        Route::group(['namespace' => 'Attendance'],function(){

            Route::resource('attendance', 'AttendanceController');
        });

         ###################### start Subjects ################

        Route::group(['namespace' => 'Subjects'],function(){

            Route::resource('subjects', 'SubjectController');
        });

              ###################### start Exams ################

        Route::group(['namespace' => 'Quiz'],function(){

            Route::resource('quiz', 'QuizController');
            Route::resource('question', 'QuestionController');

        });

        ###################### start Zoom [online classes ] ################

        Route::group(['namespace' => 'Zoom'],function(){

            Route::resource('online_classes', 'OnlineClassesController');

            //offline classes
            Route::get('/indirect', 'OnlineClassesController@indirectCreate')->name('indirect.create');
            Route::post('/indirect', 'OnlineClassesController@storeIndirect')->name('indirect.store');

        });

        ################ Start Library ###############

        Route::group(['namespace'=>'Library'],function(){

            Route::resource('library','LibraryController');
            Route::get('download_book/{filename}','LibraryController@download')->name('download_book');
        });

        ################ End  Library ###############




});






