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

$controller_path = 'App\Http\Controllers';

// Main Page Route

// login and register
Route::get('login', function () {
    return view('login-view');
})->name('login');
Route::post('/login-submit', $controller_path . '\Login_controller@login')->name('login-submit');
Route::get('/logout', $controller_path . '\Login_controller@logout')->name('logout');


Route::get('register', function () {
    return view('register-view');
});


Route::group(['middleware' => 'auth'], function () {
    //   Admin
    $controller_path = 'App\Http\Controllers';
    // admin dashboard 
    Route::get('/admin/dashboard', 'App\Http\Controllers\dashboard\Analytics@index')->name('admin-dashboard');


    // Tests (Admin)
    Route::get('/admin/manage-test/test', $controller_path . '\Admin\ManageTestController@createTest')->name('create-test');
    Route::get('/admin/manage-test/quiz', $controller_path . '\Admin\ManageTestController@createTest')->name('create-quiz');
    Route::get('/admin/manage-test/add-test-common', $controller_path . '\Admin\ManageTestController@addTest')->name('create-test');
    Route::get('/admin/manage-test/add-test-individual', $controller_path . '\Admin\ManageTestController@create_new_test')->name('create-test');
    Route::get('/admin/manage-test/create-quiz', $controller_path . '\Admin\ManageTestController@createQuiz')->name('create-quiz');

    // Admin Profile
    Route::get('/admin/profile', $controller_path . '\Admin\ProfileController@index')->name('admin-profile');
    Route::get('/admin/profile/edit', $controller_path . '\Admin\ProfileController@editProfile')->name('admin-profile-edit');
    Route::post('/admin/profile/update', $controller_path . '\Admin\ProfileController@admin_profile_edit')->name('admin-edit-profile');

    // Manage students and students group (Admin)
    Route::get('/admin/manage-students/students', $controller_path . '\Admin\ManageStudentsController@students')->name('manage-students-students');
    Route::get('/admin/manage-students/fetch-students', $controller_path . '\Admin\ManageStudentsController@fetchData')->name('fetch-students');
    Route::post('/admin/manage-students/add-students', $controller_path . '\Admin\ManageStudentsController@add_students')->name('add-students');
    Route::post('/admin/manage-students/student-status', $controller_path . '\Admin\ManageStudentsController@student_status')->name('student-status');



    Route::get('/admin/manage-students/students-group', $controller_path . '\Admin\ManageStudentsController@studentsGroup')->name('managestudents-studentsgroup');
    Route::get('/admin/manage-students/add-students-group', $controller_path . '\Admin\ManageStudentsController@addnew_group')->name('add-students-group');
    Route::get('/admin/manage-students/edit-students-group', $controller_path . '\Admin\ManageStudentsController@edit_students_group')->name('edit-students-group');
    Route::get('/admin/manage-students/importstudents', $controller_path . '\Admin\ManageStudentsController@importstudents')->name('managestudents-importstudents');
    Route::get('/admin/manage-students/import-students-group', $controller_path . '\Admin\ManageStudentsController@import_students_group')->name('manageUser-importgroup');

    // Manage Colleges (Admin)
    Route::get('/admin/manage-colleges/colleges', $controller_path . '\Admin\ManageCollegeController@colleges')->name('managecolleges-colleges');
    Route::post('/admin/manage-colleges/add-college', $controller_path . '\Admin\ManageCollegeController@add_college')->name('add-college');
    Route::post('/admin/manage-colleges/edit-college', $controller_path . '\Admin\ManageCollegeController@edit_college')->name('edit-college');
    Route::post('/admin/manage-colleges/college-status', $controller_path . '\Admin\ManageCollegeController@college_status')->name('college-status');
    Route::post('/admin/manage-colleges/delete-college', $controller_path . '\Admin\ManageCollegeController@delete_college')->name('delete-college');

    Route::get('/admin/manage-colleges/importcollege', $controller_path . '\Admin\ManageCollegeController@importcolleges')->name('managecolleges-importcolleges');
    Route::post('/admin/manage-colleges/import-college', $controller_path . '\Admin\ManageCollegeController@import_college_data')->name('import-college');
    Route::get('/admin/manage-colleges/show_error_data/{error}',  $controller_path . '\Admin\ManageCollegeController@show_error_data')->name('show_error_data');
    Route::get('/admin/manage-colleges/edit-import-data',  $controller_path . '\Admin\ManageCollegeController@edit_import_data')->name('edit-import-data');
    Route::post('/admin/manage-colleges/edit-college-data',  $controller_path . '\Admin\ManageCollegeController@edit_data')->name('edit-college-data');


    // Manage Questions (Admin)
    Route::get('admin/question-bank/manage-questions', $controller_path . '\Admin\QuestionBankController@manageQuestions')->name('manage-questions');
    Route::get('admin/question-bank/add-questions', $controller_path . '\Admin\QuestionBankController@addQuestions')->name('add-questions');
    Route::get('admin/question-bank/edit-questions', $controller_path . '\Admin\QuestionBankController@editQuestions')->name('edit-questions');
    Route::get('admin/question-bank/upload-questions', $controller_path . '\Admin\QuestionBankController@uploadQuestions')->name('upload-questions');
    Route::get('admin/question-bank/view-questions', $controller_path . '\Admin\QuestionBankController@viewFilterQuestions')->name('view-filter-questions');
    Route::get('admin/skills/{skill}', $controller_path . '\Admin\QuestionBankController@filterQuestions')->name('filter-questions');

    // Masters (Admin)

    //difficulty (Admin)
    Route::get('admin/masters/difficulty', $controller_path . '\Admin\MastersController@difficulty')->name('manage-difficulty');
    Route::post('admin/masters/difficulty-add', $controller_path . '\Admin\MastersController@difficulty_add')->name('difficulty-add');
    Route::post('admin/masters/difficulty-status', $controller_path . '\Admin\MastersController@difficulty_status')->name('difficulty-status');
    Route::post('admin/masters/difficulty-update', $controller_path . '\Admin\MastersController@edit_difficulty')->name('difficulty-update');
    Route::post('admin/masters/difficulty-delete', $controller_path . '\Admin\MastersController@delete_difficulty')->name('difficulty-delete');

    // skills master
    Route::get('admin/masters/skills', $controller_path . '\Admin\MastersController@skills')->name('manage-skills');
    Route::post('admin/masters/add-skills', $controller_path . '\Admin\MastersController@skills_add')->name('add-skill');
    Route::post('admin/masters/update-skills', $controller_path . '\Admin\MastersController@edit_skills')->name('update-skill');
    Route::post('admin/masters/skills-status', $controller_path . '\Admin\MastersController@skill_status')->name('skills-status');
    Route::post('admin/masters/skill-delete', $controller_path . '\Admin\MastersController@delete_skill')->name('skill-delete');

    // topics master
    Route::get('admin/masters/topics', $controller_path . '\Admin\MastersController@topics')->name('manage-topics');
    Route::post('admin/masters/add-topic', $controller_path . '\Admin\MastersController@add_topic')->name('add-topic');
    Route::post('admin/masters/edit-topic', $controller_path . '\Admin\MastersController@edit_topic')->name('edit-topic');
    Route::post('admin/masters/topic-status', $controller_path . '\Admin\MastersController@topic_status')->name('topic-status');
    Route::post('admin/masters/delete-topic', $controller_path . '\Admin\MastersController@delete_topic')->name('delete-topic');

    // department master
    Route::get('admin/masters/department', $controller_path . '\Admin\MastersController@department')->name('manage-department');
    Route::post('admin/masters/department_add', $controller_path . '\Admin\MastersController@add_department')->name('add-department');
    Route::post('admin/masters/department-status', $controller_path . '\Admin\MastersController@department_status')->name('department-status');
    Route::post('admin/masters/department-update', $controller_path . '\Admin\MastersController@edit_department')->name('department-update');
    Route::post('admin/masters/department-delete', $controller_path . '\Admin\MastersController@delete_department')->name('department-delete');


    Route::get('admin/masters/batch', $controller_path . '\Admin\MastersController@batch')->name('manage-batch');
    Route::get('admin/masters/semester', $controller_path . '\Admin\MastersController@semester')->name('manage-semester');


    // Students

    // Student dashboard
    Route::get('/student/dashboard', $controller_path . '\Students\StudentController@index')->name('student-dashboard');


    // Student Profile
    Route::get('/student/profile', $controller_path . '\Students\StudentProfileController@index')->name('student-profile');
    Route::get('/student/edit-profile', $controller_path . '\Students\StudentProfileController@editProfile')->name('student-profile');


    // Student Report
    Route::get('/student/report', $controller_path . '\Students\ReportController@index')->name('student-report');
});


//   Admin

// admin dashboard 
// Route::get('/admin/dashboard', $controller_path . '\dashboard\Analytics@index')->name('admin-dashboard');