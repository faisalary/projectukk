<?php

// use Illuminate\Support\Facades\Route;

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

use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isApplicant;
use App\Http\Controllers\Front\FrontJobsController;

Route::group(
    ['namespace' => 'Front', 'as' => 'jobs.'],
    function () {
        Route::get('/', [FrontJobsController::class,'jobOpenings'])->name('jobOpenings');
        // Route::get('/', 'FrontJobsController@jobOpenings')->name('jobOpenings');
        Route::get('/search', 'FrontSearchController@searchOpenings')->name('searchOpenings');
        Route::get('/job-offer/{slug?}', 'FrontJobOfferController@index')->name('job-offer');
        Route::post('/save-offer', 'FrontJobOfferController@saveOffer')->name('save-offer');
        Route::get('/job/{slug}', 'FrontJobsController@jobDetail')->name('jobDetail');
        Route::get('/job/{slug}/apply', 'FrontJobsController@jobApply')->name('jobApply');
        Route::post('/job/saveApplication', 'FrontJobsController@saveApplication')->name('saveApplication');
        Route::get('/job/getApplication', 'FrontJobsController@saveApplication')->name('getApplication');
        Route::post('/job/fetch-country-state', 'FrontJobsController@fetchCountryState')->name('fetchCountryState');
        Route::get('auth/callback/{provider}', 'FrontJobsController@callback')->name('linkedinCallback');
        Route::get('auth/redirect/{provider}', 'FrontJobsController@redirect')->name('linkedinRedirect');
        Route::get('/fetch-jobs', 'FrontJobsController@fetchJobs');
        Route::get('/fetch-locations', 'FrontJobsController@fetchLocations');
    }
);

//Front routes end


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::post('mark-notification-read', ['uses' => 'NotificationController@markAllRead'])->name('mark-notification-read');

    //profile user
    Route::group(['middleware' => isApplicant::class], function () {
        Route::get('/profile/setup', 'ProfileUserController@index')->name('profile.setup');
        Route::get('/profile', 'ProfileUserController@edit')->name('profile.index');
        Route::get('/profile/information', 'ProfileUserController@edit')->name('profile.information');
        Route::get('/profile/educations', 'ProfileUserController@edit')->name('profile.educations');
        Route::get('/profile/skills', 'ProfileUserController@edit')->name('profile.skills');
        Route::get('/profile/languages', 'ProfileUserController@edit')->name('profile.languages');
        Route::get('/profile/portfolio', 'ProfileUserController@edit')->name('profile.portfolio');
        Route::post('/store-profile', 'ProfileUserController@store')->name('store-profile');
        Route::post('/store-personal', 'ProfileUserController@storePersonal')->name('store-personal');
        Route::post('/store-information', 'ProfileUserController@storeInformation')->name('store-information');
        Route::post('/store-educations', 'ProfileUserController@storeEducations')->name('store-educations');
        Route::post('/store-skills', 'ProfileUserController@storeSkills')->name('store-skills');
        Route::post('/store-languages', 'ProfileUserController@storeLanguages')->name('store-languages');
        Route::post('/store-portfolio', 'ProfileUserController@storePortfolio')->name('store-portfolio');
        Route::get('/profile/applications', 'ApplicationUserController@index')->name('application.index');
    });

    // Admin routes
    Route::group(
        ['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => isAdmin::class],
        function () {
            Route::get('/dashboard', 'AdminDashboardController@index')->name('dashboard');
            Route::resource('profile', 'AdminProfileController');
            Route::post('todo-items/update-todo-item', 'AdminTodoItemController@updateTodoItem')->name('todo-items.updateTodoItem');
            Route::resource('todo-items', 'AdminTodoItemController');

            Route::get('job-categories/data', 'AdminJobCategoryController@data')->name('job-categories.data');
            Route::get('job-categories/getSkills/{categoryId}', 'AdminJobCategoryController@getSkills')->name('job-categories.getSkills');
            Route::resource('job-categories', 'AdminJobCategoryController');

            Route::get('job-industries/data', 'AdminJobIndustryController@data')->name('job-industries.data');
            Route::resource('job-industries', 'AdminJobIndustryController');

            //Questions
            Route::get('questions/data', 'AdminQuestionController@data')->name('questions.data');
            Route::resource('questions', 'AdminQuestionController');

            // company settings
            Route::group(
                ['prefix' => 'settings'],
                function () {
                    // Company Setting routes
                    Route::resource('settings', 'CompanySettingsController', ['only' => ['edit', 'update', 'index']]);

                    // Application Form routes
                    Route::resource('application-setting', 'ApplicationSettingsController');
                    
                    // Role permission routes
                    Route::post('role-permission/assignAllPermission', ['as' => 'role-permission.assignAllPermission', 'uses' => 'ManageRolePermissionController@assignAllPermission']);
                    Route::post('role-permission/removeAllPermission', ['as' => 'role-permission.removeAllPermission', 'uses' => 'ManageRolePermissionController@removeAllPermission']);
                    Route::post('role-permission/assignRole', ['as' => 'role-permission.assignRole', 'uses' => 'ManageRolePermissionController@assignRole']);
                    Route::post('role-permission/detachRole', ['as' => 'role-permission.detachRole', 'uses' => 'ManageRolePermissionController@detachRole']);
                    Route::post('role-permission/storeRole', ['as' => 'role-permission.storeRole', 'uses' => 'ManageRolePermissionController@storeRole']);
                    Route::post('role-permission/deleteRole', ['as' => 'role-permission.deleteRole', 'uses' => 'ManageRolePermissionController@deleteRole']);
                    Route::get('role-permission/showMembers/{id}', ['as' => 'role-permission.showMembers', 'uses' => 'ManageRolePermissionController@showMembers']);
                    Route::resource('role-permission', 'ManageRolePermissionController');

                    //language settings
                    Route::get('language-settings/change-language', ['uses' => 'LanguageSettingsController@changeLanguage'])->name('language-settings.change-language');
                    Route::put('language-settings/change-language-status/{id}', 'LanguageSettingsController@changeStatus')->name('language-settings.changeStatus');

                    Route::resource('language-settings', 'LanguageSettingsController');

                    Route::resource('theme-settings', 'AdminThemeSettingsController');

                    Route::get('smtp-settings/sent-test-email', ['uses' => 'AdminSmtpSettingController@sendTestEmail'])->name('smtp-settings.sendTestEmail');
                    Route::resource('smtp-settings', 'AdminSmtpSettingController');

                    Route::resource('sms-settings', 'AdminSmsSettingsController', ['only' => ['index', 'update']]);

                    Route::resource('linkedin-settings', 'AdminLinkedInSettingsController');

                    // Footer Links
                    Route::get('footer-settings/data', 'FooterSettingController@data')->name('footer-settings.data');
                    Route::resource('footer-settings', 'FooterSettingController');

                    Route::get('update-application', ['uses' => 'UpdateApplicationController@index'])->name('update-application.index');
                }
            );

            Route::get('skills/data', 'AdminSkillsController@data')->name('skills.data');
            Route::resource('skills', 'AdminSkillsController');

            Route::get('locations/data', 'AdminLocationsController@data')->name('locations.data');
            Route::resource('locations', 'AdminLocationsController');

            Route::get('majors/data', 'AdminMajorsController@data')->name('majors.data');
            Route::resource('majors', 'AdminMajorsController');


            Route::get('jobs/data', 'AdminJobsController@data')->name('jobs.data');
            Route::get('jobs/application-data', 'AdminJobsController@applicationData')->name('jobs.applicationData');
            Route::post('jobs/send-emails', 'AdminJobsController@sendEmails')->name('jobs.sendEmails');
            Route::get('jobs/send-email', 'AdminJobsController@sendEmail')->name('jobs.sendEmail');
            Route::resource('jobs', 'AdminJobsController');

            Route::post('job-applications/rating-save/{id?}', 'AdminJobApplicationController@ratingSave')->name('job-applications.rating-save');
            Route::get('job-applications/create-schedule/{id?}', 'AdminJobApplicationController@createSchedule')->name('job-applications.create-schedule');
            Route::post('job-applications/store-schedule', 'AdminJobApplicationController@storeSchedule')->name('job-applications.store-schedule');
            Route::get('job-applications/question/{jobID}/{applicationId?}', 'AdminJobApplicationController@jobQuestion')->name('job-applications.question');
            Route::get('job-applications/export/{status}/{location}/{startDate}/{endDate}/{jobs}', 'AdminJobApplicationController@export')->name('job-applications.export');
            Route::get('job-applications/data/{company_id?}/{job_id?}', 'AdminJobApplicationController@data')->name('job-applications.data');
            Route::get('job-applications/table-view', 'AdminJobApplicationController@table')->name('job-applications.table');
            Route::get('job-applications/t/{company}/{job}/{status}', 'AdminJobApplicationController@table');
            Route::post('job-applications/updateIndex', 'AdminJobApplicationController@updateIndex')->name('job-applications.updateIndex');
            Route::post('job-applications/updateStatus', 'AdminJobApplicationController@updateStatus')->name('job-applications.updateStatus');
            Route::post('job-applications/add-skills/{applicationId}', 'AdminJobApplicationController@addSkills')->name('job-applications.addSkills');
            Route::resource('job-applications', 'AdminJobApplicationController');

            Route::resource('application-status', 'AdminApplicationStatusController');

            Route::get('interview-schedule/data', 'InterviewScheduleController@data')->name('interview-schedule.data');
            Route::get('interview-schedule/table-view', 'InterviewScheduleController@table')->name('interview-schedule.table-view');
            Route::post('interview-schedule/change-status', 'InterviewScheduleController@changeStatus')->name('interview-schedule.change-status');
            Route::post('interview-schedule/change-status-multiple', 'InterviewScheduleController@changeStatusMultiple')->name('interview-schedule.change-status-multiple');
            Route::get('interview-schedule/notify/{id}/{type}', 'InterviewScheduleController@notify')->name('interview-schedule.notify');
            Route::get('interview-schedule/response/{id}/{type}', 'InterviewScheduleController@employeeResponse')->name('interview-schedule.response');
            Route::resource('interview-schedule', 'InterviewScheduleController');

            Route::get('team/data', 'AdminTeamController@data')->name('team.data');
            Route::post('team/change-role', 'AdminTeamController@changeRole')->name('team.changeRole');
            Route::resource('team', 'AdminTeamController');

            Route::get('candidate/data', 'AdminCandidateDatabaseController@data')->name('candidate.data');
            Route::resource('candidate', 'AdminCandidateDatabaseController');
            Route::get('candidate/{id}', 'AdminCandidateDatabaseController@show')->name('candidate.show');

            Route::get('company/{id}/dataJobs', 'AdminCompanyController@dataJobs')->name('company.dataJobs');
            Route::get('company/data', 'AdminCompanyController@data')->name('company.data');
            Route::resource('company', 'AdminCompanyController');
            Route::get('master-company/data', 'AdminCompanyController@data')->name('master-company.data');
            Route::resource('master-company', 'AdminCompanyController');
            Route::get('company/{company_id?}/{job_id?}', 'AdminJobApplicationController@index')->name('company.job-applications');
            Route::get('company/{company_id?}/{job_id?}/table', 'AdminJobApplicationController@table')->name('company.job-applications.table');
            Route::get('company/{company_id?}/{job_id?}/application/{application_id}', 'AdminJobApplicationController@show')->name('company.job-applications.show');

            Route::resource('applicant-note', 'ApplicantNoteController');

            Route::resource('sticky-note', 'AdminStickyNotesController');

            Route::resource('departments', 'AdminDepartmentController');

            Route::resource('designations', 'AdminDesignationController');

            Route::get('documents/data', 'AdminDocumentController@data')->name('documents.data');
            Route::get('documents/download-document/{document}', 'AdminDocumentController@downloadDoc')->name('documents.downloadDoc');
            Route::resource('documents', 'AdminDocumentController');

            Route::get('exp', 'AdminJobApplicationController@showExperience')->name('exp');
            Route::get('exp/data', 'AdminJobApplicationController@getExperience')->name('exp.data');
        }
    );

    Route::get('change-mobile', 'VerifyMobileController@changeMobile')->name('changeMobile');
    Route::post('send-otp-code', 'VerifyMobileController@sendVerificationCode')->name('sendOtpCode');
    Route::post('send-otp-code/account', 'VerifyMobileController@sendVerificationCode')->name('sendOtpCode.account');
    Route::post('verify-otp-phone', 'VerifyMobileController@verifyOtpCode')->name('verifyOtpCode');
    Route::post('verify-otp-phone/account', 'VerifyMobileController@verifyOtpCode')->name('verifyOtpCode.account');
    Route::get('remove-session', 'VerifyMobileController@removeSession')->name('removeSession');
});

Route::get('{slug}', 'Front\FrontJobsController@customPage')->name('custom');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
