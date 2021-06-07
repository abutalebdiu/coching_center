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

Route::get('clear', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('storage:link');
    return 'DONE'; //Return anything
});




/*================================
        Home page routes
==================================*/


Route::get('/','FrontendController@index')->name('frontend');
Route::get('allbatch','FrontendController@allbatch')->name('allbatch');
Route::get('batch/enroll/{id}','FrontendController@batchenroll')->name('batch.enroll');




Route::get('blogs','FrontendController@blogs')->name('blogs');
Route::get('blog/detail/{id}','FrontendController@blogdetail')->name('blog.detail');

Route::get('notices','FrontendController@notices')->name('notices');
Route::get('notice/detail/{id}','FrontendController@noticedetail')->name('notice.detail');


Route::get('contact','FrontendController@contact')->name('contact');
Route::post('contactstore','FrontendController@contactstore')->name('contactstore');






/* =====================================================
                student login and Register routes
   =====================================================*/

Route::group(['namespace' => 'Students'], function () {

    Route::get('student/login','LoginController@studentlogin')->name('student.login');
    Route::post('student/login','LoginController@studentauthlogin')->name('student.login');
    Route::get('student/register','LoginController@studentregister')->name('student.register');
    Route::post('student/register/store','LoginController@studentregisterstore')->name('student.register.store');

     Route::get('student/logout','LoginController@studentlogout')->name('student.logout');

});

/* =====================================================
                student dashboard routes
   =====================================================*/


Route::group(['namespace' => 'Students','middleware' => ['auth', 'student']], function () {


    Route::get('student/dashboard','DashboardController@index')->name('student.dashboard');
    Route::get('student/profile','ProfileController@index')->name('student.profile');
    Route::get('student/profile/edit','ProfileController@edit')->name('student.profile.edit');
    Route::post('student/profile/update','ProfileController@update')->name('student.profile.update');








});










/* ===================================================
        Backend routes
  ====================================================*/



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['namespace' => 'Backend\StudentSetting' ,'middleware' => ['auth', 'admin']], function () {

	Route::get('classes/index','ClassesController@index')->name('classes.index');
	Route::post('classes/store','ClassesController@store')->name('classes.store');
	Route::get('classes/edit/{id}','ClassesController@edit')->name('classes.edit');
	Route::get('classes/destroy/{id}','ClassesController@destroy')->name('classes.destroy');


	Route::get('sessiones/index','SessionesController@index')->name('sessiones.index');
	Route::post('sessiones/store','SessionesController@store')->name('sessiones.store');
	Route::get('sessiones/edit/{id}','SessionesController@edit')->name('sessiones.edit');
	Route::get('sessiones/destroy/{id}','SessionesController@destroy')->name('sessiones.destroy');


	Route::get('batch/index','BatchController@index')->name('batch.index');
	Route::post('batch/store','BatchController@store')->name('batch.store');
	Route::get('batch/edit/{id}','BatchController@edit')->name('batch.edit');
	Route::get('batch/destroy/{id}','BatchController@destroy')->name('batch.destroy');


	Route::get('section/index','SectionController@index')->name('section.index');
	Route::post('section/store','SectionController@store')->name('section.store');
	Route::get('section/edit/{id}','SectionController@edit')->name('section.edit');
	Route::get('section/destroy/{id}','SectionController@destroy')->name('section.destroy');




 	Route::get('batch/schedule/index','BatchSettingController@index')->name('batch.schedule.index');
 	Route::get('batch/schedule/create','BatchSettingController@create')->name('batch.schedule.create');
 	Route::post('batch/schedule/store','BatchSettingController@store')->name('batch.schedule.store');
 	Route::get('batch/schedule/edit/{id}','BatchSettingController@edit')->name('batch.schedule.edit');
 	Route::post('batch/schedule/update/{id}','BatchSettingController@update')->name('batch.schedule.update');
 	Route::get('batch/schedule/destroy/{id}','BatchSettingController@destroy')->name('batch.schedule.destroy');


 	Route::get('batch/setting/schedule/datetime/{id}','BatchSettingController@datetimedestroy')->name('batch.setting.schedule.datetime');

});



Route::group(['namespace'=>'Backend\Student','middleware'=>['auth','admin']],function(){

    Route::get('student/index','StudentController@index')->name('student.index');
    Route::get('student/create','StudentController@create')->name('student.create');
    Route::post('student/store','StudentController@store')->name('student.store');
    Route::get('student/show/{id}','StudentController@show')->name('student.show');
    Route::get('student/edit/{id}','StudentController@edit')->name('student.edit');
    Route::post('student/update/{id}','StudentController@update')->name('student.update');
    Route::get('student/destroy/{id}','StudentController@destroy')->name('student.destroy');

    //ajax call
    Route::get('get/batch/setting','StudentController@getbatchsetting')->name('get.batch.setting');
    Route::get('get/class/type/by/batch/setting','StudentController@getClassTypeByBatchSetting')->name('get_class_type_by_batch_setting');


    Route::get('get/batch/student/sms','StudentController@getbatchstudentforsms')->name('getbatchstudentforsms');




    /**Promotion class */
    Route::group(['prefix'=>'student','as'=>'admin.'],function(){
        Route::resource('promotion-class','PromotionClassController');
        Route::get('promotion/form/page/by/ajax','PromotionClassController@promotionFromByAjax')->name('promotionFromByAjax');
        Route::get('promotion-class/create','PromotionClassController@create')->name('promotion-class.create');
    });
    /**Absent Student */
    Route::group(['prefix'=>'student','as'=>'admin.'],function(){
        Route::resource('absent','AbsentController');
        Route::get('absent/destory/{id}','AbsentController@destroy')->name('studentAbsentDestory');
    });


    /**Student Add New Batch */
    Route::group(['prefix'=>'student/add','as'=>'admin.'],function(){
        Route::resource('new-batch','AddNewBatchController');
        //ajax call
    Route::get('get/batch/setting','AddNewBatchController@getbatchsetting')->name('get_batch_setting');
    });
});




/** get student by keyup method */
Route::group(['as'=>'admin.','prefix'=>'admin/get/student','namespace'=>'Backend\Student','middleware'=>['auth','admin']],function(){
    Route::get('by/key/up','GetStudentController@getStudentByKeyup')->name('get_student_by_key_up');
    Route::get('get/student/batch/by/student/id','GetStudentController@getStudentBatch')->name('getStudentBatch');
    Route::get('get/batch/type/by/student/batch','GetStudentController@getStudentBatchType')->name('getStudentBatchType');
});
/** get student by keyup method */





/** Module */
Route::group(['as'=>'admin.','prefix'=>'admin/module','namespace'=>'Backend\Module','middleware'=>['auth','admin']],function(){
    Route::resource('module','ModuleController');
    Route::get('module/delete/{module}','ModuleController@destroy')->name('moduleDestory');
});

/** Fee  */
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Backend\Fee','middleware'=>['auth','admin']],function(){
    Route::resource('fee-category','FeeCategoryController');
    Route::get('fee/category/delete/{feeCategory}','FeeCategoryController@destroy')->name('feeCategoryDestory');

    /**fee setting amount*/
    Route::resource('fee-amount-setting','FeeAmountSettingController');
    Route::get('fee/amount/setting/delete/{feeAmountSetting}','FeeAmountSettingController@destroy')->name('feeAmountSettingDestory');

    /**fee setting */
    Route::resource('fee-setting','FeeSettingController');
    Route::get('fee/setting/delete/{feeSetting}','FeeSettingController@destroy')->name('feeSettingDestory');

    /**fee Collection */
    Route::resource('fee-collection','FeeCollectionController');
    Route::get('get/fee/category/amount/and/others','FeeCollectionController@getFeeCategoryAmount')->name('fee_collection_getFeeCategoryAmount');

    Route::get('fee/collection/show/{id}','FeeCollectionController@show')->name('feeCollectionShow');
    Route::get('fee/collection/edit/{id}','FeeCollectionController@edit')->name('feeCollectionEdit');
    Route::post('fee/collection/update/{id}','FeeCollectionController@update')->name('feeCollectionUpdate');
    Route::get('fee/collection/delete/{id}','FeeCollectionController@destroy')->name('feeCollectionDestory');

    /**get batch setting id by class, student/user id and session id */
    Route::get('get/batch-id/by/user/class/session/id','FeeCollectionController@getBatchSettingIdByClassSessionUserId')->name('getBatchSettingIdByClassSessionUserId');

    /**Monthly Fee due list */
    Route::get('monthly/fee/due/list','FeeCollectionController@monthlyFeeDueList')->name('monthlyFeeDueList');
    Route::get('monthly/fee/due/list/search/result','FeeCollectionController@monthlyFeeDueListSearchResult')->name('monthlyFeeDueListSearchResult');


    Route::get('others/fee/collection','OthersFeeCollectionController@othersFeeCollection')->name('othersFeeCollection');
    Route::get('search/fee/amount/setting/by/some/data','OthersFeeCollectionController@searchFeeAmountSettingByOthersData')->name('searchFeeAmountSettingByOthersData');
    Route::get('others/fee/collection/by/student','OthersFeeCollectionController@othersFeeCollectionByStudent')->name('othersFeeCollectionByStudent');
    Route::post('store/others/fee/collection/by/student','OthersFeeCollectionController@storeOthersFeeCollectionByStudent')->name('storeOthersFeeCollectionByStudent');
    Route::get('others/fee/due/list','OthersFeeCollectionController@othersFeeDueList')->name('othersFeeDueList');


});



/** Waiver */
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Backend\Waiver','middleware'=>['auth','admin']],function(){
    Route::resource('waiver-type','WaiverTypeController');
    Route::get('waiver-type/delete/{waiverType}','WaiverTypeController@destroy')->name('waiverTypeDestory');

    Route::resource('waiver','WaiverController');
    Route::get('waiver/delete/{waiver}','WaiverController@destroy')->name('waiverDestory');

    /**student Waiver */
    Route::resource('student-waiver','StudentWaiverController');
    Route::get('student-waiver/all/data/by/ajax','StudentWaiverController@getWaiverStudentDataByStudentId')->name('getWaiverStudentDataByStudentId');
    Route::get('student/waiver/delete/{studentWaiver}','StudentWaiverController@destroy')->name('studentWaiverDestory');
});



Route::group(['prefix'=>'admin/user','namespace'=>'Backend\Student','middleware'=>['auth','admin']],function(){
    Route::get('index','UserController@index')->name('user.index');
    Route::get('create','UserController@create')->name('user.create');
    Route::post('store','UserController@store')->name('user.store');
    Route::get('show/{id}','UserController@show')->name('user.show');
    Route::get('edit/{id}','UserController@edit')->name('user.edit');
    Route::post('update/{id}','UserController@update')->name('user.update');
    Route::get('destroy/{id}','UserController@destroy')->name('user.destroy');

    Route::get('profile','ProfileController@index')->name('user.profile');
    Route::get('profile/edit','ProfileController@edit')->name('user.profile.edit');
    Route::post('profile/update','ProfileController@update')->name('user.profile.update');
    Route::get('setting','ProfileController@setting')->name('user.setting');
    Route::post('setting/update','ProfileController@changepassword')->name('user.setting.update');
});












  /* Payment Method */
    Route::group(['as'=>'admin.','prefix'=>'admin/payment','namespace'=>'Backend\Payment'], function(){
        Route::resource('paymentMethod','PaymentMethodController');
    });
    /* Account */
    Route::group(['as'=>'admin.','prefix'=>'admin/payment','namespace'=>'Backend\Payment'], function(){
        Route::resource('account','AccountController');
        //by ajax
        Route::get('get/account/by/payment/method','AccountController@getAccountByPaymentMethod')->name('getAccountByPaymentMethod');
    });

    /* Bank */ //           //"payment_method_id" => "required|exists:payment_methods,id",
    Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Backend\Payment'], function(){
        Route::resource('bank','BankController');
    });



    Route::group(['prefix'=>'accounts/payment/reports','namespace'=>'Backend\Payment'],function(){
       Route::get('paid','PaymentReportController@paidreports')->name('payment.reports.paid');
       Route::get('unpaid','PaymentReportController@unpaidreports')->name('payment.reports.unpaid');
       Route::get('allreports','PaymentReportController@allreports')->name('payment.reports.allreports');
    });







/*   ========================
        MCQ question and ans routes
    ==============================*/

    /**Mcq Question  */
    Route::group(['as'=>'admin.mcq.','prefix'=>'mcq','namespace'=>'Backend\Question\McqQuestion','middleware'=>['auth','admin']],function()
    {
        Route::get('question/list','McqQuestionController@index')->name('index');
        Route::get('question/create','McqQuestionController@create')->name('create');
        Route::post('question/store','McqQuestionController@store')->name('store');
        Route::get('question/show/{mcqQuestionSubject}','McqQuestionController@show')->name('show');

        Route::get('question/exam/{mcqQuestionSubject}','McqQuestionController@exam')->name('exam');
    });
    Route::group(['as'=>'admin.exam.question.','prefix'=>'exam/mcq/question','namespace'=>'Backend\ExamQuestion','middleware'=>['auth','admin']],function()
    {
        Route::get('start','McqQuestionController@create')->name('create');
        Route::post('store/answer','McqQuestionController@store')->name('store');
    });

    /**Mcq Question Setting */
    Route::group(['as'=>'admin.','prefix'=>'exam/question','namespace'=>'Backend\ExamQuestion','middleware'=>['auth','admin']],function()
    {
        Route::resource('mcq-setting','McqQuestionSettingController');
    });
    /**Student Mcq Question Setting */
    Route::group(['as'=>'admin.','prefix'=>'exam/question','namespace'=>'Backend\ExamQuestion','middleware'=>['auth','admin']],function()
    {
        Route::get('mcq/student/setting','StudentQuestionSettingController@mcqIndex')->name('mcq.question.student.setting.index');
        Route::get('mcq/student/setting/create','StudentQuestionSettingController@mcqCreate')->name('mcq.question.student.setting.create');
        Route::get('mcq/student/setting/create/student/list','StudentQuestionSettingController@mcqCreateStudentList')->name('mcq.question.student.setting.create.student.list');
        Route::post('mcq/student/setting/store','StudentQuestionSettingController@mcqStoreStudent')->name('mcq.question.student.setting.store');
    });
    /**Mcq Question  Part End*/


Route::group(['prefix'=>'quiz','namespace'=>'Backend\Question','middleware'=>['auth','admin']],function()
{
    Route::get('index','QuizController@index')->name('quiz.index');
    Route::get('create','QuizController@create')->name('quiz.create');
    Route::post('store','QuizController@store')->name('quiz.store');
    Route::get('show/{id}','QuizController@show')->name('quiz.show');
    Route::get('edit/{id}','QuizController@edit')->name('quiz.edit');
    Route::post('update/{id}','QuizController@update')->name('quiz.update');
    Route::get('destroy/{id}','QuizController@destroy')->name('quiz.destroy');
});




Route::group(['prefix'=>'quizquestion','namespace'=>'Backend\Question','middleware'=>['auth','admin']],function()
  {
      Route::get('index','QuizQuestionController@index')->name('quizquestion.index');
      Route::get('create','QuizQuestionController@create')->name('quizquestion.create');
      Route::post('store','QuizQuestionController@store')->name('quizquestion.store');
      Route::get('show/{id}','QuizQuestionController@show')->name('quizquestion.show');
      Route::get('edit/{id}','QuizQuestionController@edit')->name('quizquestion.edit');
      Route::post('update/{id}','QuizQuestionController@update')->name('quizquestion.update');
      Route::get('destroy/{id}','QuizQuestionController@destroy')->name('quizquestion.destroy');

});



/* ======== Atendance controller  ===================*/










Route::group(['prefix'=>'student/attendance','namespace'=>'Backend\Attendance','middleware'=>['auth','admin']],function()
  {
      Route::get('index','AttendanceController@index')->name('student.attendance.index');
      Route::get('create','AttendanceController@create')->name('student.attendance.create');
      Route::post('store','AttendanceController@store')->name('student.attendance.store');
      Route::get('show/{id}','AttendanceController@show')->name('student.attendance..show');
      Route::get('edit/{id}','AttendanceController@edit')->name('student.attendance..edit');
      Route::post('update/{id}','AttendanceController@update')->name('student.attendance..update');
      Route::get('destroy/{id}','AttendanceController@destroy')->name('student.attendance..destroy');

});














Route::group(['namespace' => 'Backend\Website' ,'middleware' => ['auth', 'admin']], function () {

    Route::group(['prefix'=>'blog'],function (){
         Route::get('index','BlogController@index')->name('blog.index');
         Route::get('create','BlogController@create')->name('blog.create');
         Route::post('store','BlogController@store')->name('blog.store');
         Route::get('edit/{id}','BlogController@edit')->name('blog.edit');
         Route::get('show/{id}','BlogController@show')->name('blog.show');
         Route::post('update/{id}','BlogController@update')->name('blog.update');
         Route::get('destroy/{id}','BlogController@destroy')->name('blog.destroy');
    });


    Route::group(['prefix'=>'slider'],function (){
         Route::get('index','SliderController@index')->name('slider.index');
         Route::get('create','SliderController@create')->name('slider.create');
         Route::post('store','SliderController@store')->name('slider.store');
         Route::get('edit/{id}','SliderController@edit')->name('slider.edit');
         Route::get('show/{id}','SliderController@show')->name('slider.show');
         Route::post('update/{id}','SliderController@update')->name('slider.update');
         Route::get('destroy/{id}','SliderController@destroy')->name('slider.destroy');
    });

    Route::group(['prefix'=>'contact'],function (){
        Route::get('index','ContactController@index')->name('contact.index');
        Route::get('create','ContactController@create')->name('contact.create');
        Route::post('store','ContactController@store')->name('contact.store');
        Route::get('edit/{id}','ContactController@edit')->name('contact.edit');
        Route::get('show/{id}','ContactController@show')->name('contact.show');
        Route::post('update/{id}','ContactController@update')->name('contact.update');
        Route::get('destroy/{id}','ContactController@destroy')->name('contact.destroy');
    });

    Route::group(['prefix'=>'notice'],function (){
        Route::get('index','NoticeController@index')->name('notice.index');
        Route::get('create','NoticeController@create')->name('notice.create');
        Route::post('store','NoticeController@store')->name('notice.store');
        Route::get('edit/{id}','NoticeController@edit')->name('notice.edit');
        Route::get('show/{id}','NoticeController@show')->name('notice.show');
        Route::post('update/{id}','NoticeController@update')->name('notice.update');
        Route::get('destroy/{id}','NoticeController@destroy')->name('notice.destroy');
    });



});


Route::group(['namespace' => 'Backend\Question' ,'middleware' => ['auth', 'admin']], function () {


    Route::group(['prefix'=>'old_question'],function (){
        Route::get('index','OldQuestionController@index')->name('old_question.index');
        Route::get('create','OldQuestionController@create')->name('old_question.create');
        Route::post('store','OldQuestionController@store')->name('old_question.store');
        Route::get('edit/{id}','OldQuestionController@edit')->name('old_question.edit');
        Route::get('show/{id}','OldQuestionController@show')->name('old_question.show');
        Route::post('update/{id}','OldQuestionController@update')->name('old_question.update');
        Route::get('destroy/{id}','OldQuestionController@destroy')->name('old_question.destroy');




        Route::get('boardquestion/index','OldQuestionController@boardquestionindex')->name('boardquestion.index');

    });

    Route::group(['prefix'=>'year'],function (){
        Route::get('index','YearController@index')->name('year.index');
        Route::get('create','YearController@create')->name('year.create');
        Route::post('store','YearController@store')->name('year.store');
        Route::get('edit/{id}','YearController@edit')->name('year.edit');
        Route::get('show/{id}','YearController@show')->name('year.show');
        Route::post('update/{id}','YearController@update')->name('year.update');
        Route::get('destroy/{id}','YearController@destroy')->name('year.destroy');
    });

    Route::group(['prefix'=>'subject'],function (){
        Route::get('index','SubjectController@index')->name('subject.index');
        Route::get('create','SubjectController@create')->name('subject.create');
        Route::post('store','SubjectController@store')->name('subject.store');
        Route::get('edit/{id}','SubjectController@edit')->name('subject.edit');
        Route::get('show/{id}','SubjectController@show')->name('subject.show');
        Route::post('update/{id}','SubjectController@update')->name('subject.update');
        Route::get('destroy/{id}','SubjectController@destroy')->name('subject.destroy');
    });


     Route::group(['prefix'=>'written/question'],function (){
        Route::get('index','WrittenQuestionController@index')->name('written.question.index');
        Route::get('create','WrittenQuestionController@create')->name('written.question.create');
        Route::post('store','WrittenQuestionController@store')->name('written.question.store');
        Route::get('edit/{id}','WrittenQuestionController@edit')->name('written.question.edit');
        Route::get('show/{id}','WrittenQuestionController@show')->name('written.question.show');
        Route::post('update/{id}','WrittenQuestionController@update')->name('written.question.update');
        Route::get('destroy/{id}','WrittenQuestionController@destroy')->name('written.question.destroy');
     });











});



Route::group(['prefix'=>'website','namespace'=>'Backend\Website','middleware'=>['auth','admin']],function()
{
      Route::get('index','WebSettingController@index')->name('website.setting.index');
      Route::get('create','WebSettingController@create')->name('website.setting.create');
      Route::post('store','WebSettingController@store')->name('website.setting.store');
      Route::get('show/{id}','WebSettingController@show')->name('website.setting.show');
      Route::get('edit/','WebSettingController@edit')->name('website.setting.edit');
      Route::post('update','WebSettingController@update')->name('website.setting.update');
      Route::get('destroy/{id}','WebSettingController@destroy')->name('website.setting.destroy');
});



Route::group(['prefix'=>'social-media','namespace'=>'Backend\Website','middleware'=>['auth','admin']],function()
  {
      Route::get('index','SocialMediaController@index')->name('social.index');
      Route::get('create','SocialMediaController@create')->name('social.create');
      Route::post('store','SocialMediaController@store')->name('social.store');
      Route::get('show/{id}','SocialMediaController@show')->name('social.show');
      Route::get('edit/{id}','SocialMediaController@edit')->name('social.edit');
      Route::post('update/{id}','SocialMediaController@update')->name('social.update');
      Route::get('destroy/{id}','SocialMediaController@destroy')->name('social.destroy');

});



/*  ================ Sheet Controller ================================= */

Route::group(['namespace' => 'Backend\Sheet' ,'middleware' => ['auth', 'admin']], function () {
        Route::get('index','SheetController@index')->name('sheet.index');
        Route::get('create','SheetController@create')->name('sheet.create');
        Route::post('store','SheetController@store')->name('sheet.store');
        Route::get('edit/{id}','SheetController@edit')->name('sheet.edit');
        Route::get('show/{id}','SheetController@show')->name('sheet.show');
        Route::post('update/{id}','SheetController@update')->name('sheet.update');
        Route::get('destroy/{id}','SheetController@destroy')->name('sheet.destroy');
});







/* ========================= sms controller  =================================*/

Route::group(['namespace'=>'Backend\SMS','middleware'=>['auth','admin']],function(){
    Route::get('all/student/sms','SmsController@allstudentsms')->name('all.student.sms');
    Route::post('all/student/sms/send','SmsController@allstudentsmssend')->name('all.student.sms.send');

    Route::get('batch/sms','SmsController@batchsms')->name('batch.sms');
    Route::post('batch/sms/send','SmsController@batchsmssend')->name('batch.sms.send');

    Route::get('single/sms','SmsController@singlesms')->name('single.sms');
    Route::post('single/sms/send','SmsController@singlesmssend')->name('single.sms.send');

    Route::get('surprise/sms','SmsController@customsms')->name('surprise.sms');
    Route::post('surprise/sms/send','SmsController@customsmssend')->name('surprise.sms.send');

});




Route::group(['namespace' => 'Backend\SMS' ,'middleware' => ['auth', 'admin']], function () {

    Route::group(['prefix'=>'sms_history'],function (){
        Route::get('index','SmsHistoryController@index')->name('sms_history.index');

    });

    Route::group(['prefix'=>'sms_templete'],function (){
        Route::get('index','SmsTempleteController@index')->name('sms_templete.index');
        Route::get('create','SmsTempleteController@create')->name('sms_templete.create');
        Route::post('store','SmsTempleteController@store')->name('sms_templete.store');
        Route::get('edit/{id}','SmsTempleteController@edit')->name('sms_templete.edit');
        Route::get('show/{id}','SmsTempleteController@show')->name('sms_templete.show');
        Route::post('update/{id}','SmsTempleteController@update')->name('sms_templete.update');
        Route::get('destroy/{id}','SmsTempleteController@destroy')->name('sms_templete.destroy');
    });

});



