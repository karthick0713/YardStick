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
Route::get('', function () {
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


    // courses(Admin)

    Route::get('/admin/courses', $controller_path . '\Admin\ManageCourseController@manage_courses')->name('manage-courses');
    Route::get('/admin/new-course', $controller_path . '\Admin\ManageCourseController@create_new_course')->name('create-new-course');


    // Tests (Admin)
    Route::get('/admin/manage-test/manage-test', $controller_path . '\Admin\ManageTestController@manage_test')->name('manage-test');
    Route::post('/admin/manage-test/save-test', $controller_path . '\Admin\ManageTestController@save_test')->name('save-test');
    Route::get('/admin/manage-test/quiz', $controller_path . '\Admin\ManageTestController@createTest')->name('create-quiz');
    Route::get('/admin/manage-test/create-new-test', $controller_path . '\Admin\ManageTestController@create_new_test')->name('create-new-test');
    Route::get('/admin/manage-test/get-test-details', $controller_path . '\Admin\ManageTestController@get_test_details')->name('get-test-details');
    Route::get('/admin/manage-test/get-selected-questions', $controller_path . '\Admin\ManageTestController@get_selected_questions')->name('get-selected-questions');
    Route::get('/admin/manage-test/get-detailed-question-view', $controller_path . '\Admin\ManageTestController@get_detailed_question_view')->name('get-detailed-question-view');


    Route::get('/admin/manage-test/add-test-individual', $controller_path . '\Admin\ManageTestController@create_new_test')->name('create-test');
    Route::get('/admin/manage-test/create-quiz', $controller_path . '\Admin\ManageTestController@createQuiz')->name('create-quiz');

    // Admin Profile
    Route::get('/admin/profile', $controller_path . '\Admin\ProfileController@index')->name('admin-profile');
    Route::get('/admin/profile/edit', $controller_path . '\Admin\ProfileController@editProfile')->name('admin-profile-edit');
    Route::post('/admin/profile/update', $controller_path . '\Admin\ProfileController@admin_profile_edit')->name('admin-edit-profile');

    // Manage students and students group (Admin)
    Route::get('/admin/manage-students/students', $controller_path . '\Admin\ManageStudentsController@students')->name('manage-students-students');
    Route::get('/admin/manage-students/fetch-students', $controller_path . '\Admin\ManageStudentsController@fetchData')->name('fetch-students');
    Route::post('/admin/manage-students/add-students',  $controller_path . '\Admin\ManageStudentsController@add_students')->name('add-students');
    Route::post('/admin/manage-students/student-status', $controller_path . '\Admin\ManageStudentsController@student_status')->name('student-status');
    Route::get('/admin/manage-students/fetch-student-details', $controller_path . '\Admin\ManageStudentsController@fetch_student_details')->name('fetch-student-details');
    Route::get('/admin/manage-students/get-edit-details', $controller_path . '\Admin\ManageStudentsController@get_edit_data')->name('get-edit-details');
    Route::post('/admin/manage-students/edit-students', $controller_path . '\Admin\ManageStudentsController@edit_students')->name('edit-students');
    Route::post('/admin/manage-students/delete-student', $controller_path . '\Admin\ManageStudentsController@deleteStudent')->name('delete-student');


    Route::get('/admin/manage-students/importstudents', $controller_path . '\Admin\ManageStudentsController@importstudents')->name('managestudents-importstudents');
    Route::get('/admin/manage-students/edit-import-student-data', $controller_path . '\Admin\ManageStudentsController@edit_import_student_data')->name('edit-imported-student-data');
    Route::post('/admin/manage-students/student-imports', $controller_path . '\Admin\ManageStudentsController@excel_importstudents')->name('student-excel-import');
    Route::post('/admin/manage-students/submit-excel-edit-data', $controller_path . '\Admin\ManageStudentsController@update_import_student_data')->name('submit-excel-edit-data');



    Route::get('/admin/manage-students/students-group', $controller_path . '\Admin\ManageStudentsController@studentsGroup')->name('managestudents-studentsgroup');
    Route::get('/admin/manage-students/get-students-for-group', $controller_path . '\Admin\ManageStudentsController@get_students_for_group')->name('get-students-for-group');
    Route::post('/admin/manage-students/save-student-group', $controller_path . '\Admin\ManageStudentsController@save_group')->name('save-student-group');
    Route::get('/admin/manage-students/view-group-students', $controller_path . '\Admin\ManageStudentsController@get_group_students')->name('view-group-students');
    Route::post('/admin/manage-students/group-status', $controller_path . '\Admin\ManageStudentsController@group_status_update')->name('group-status');
    Route::post('/admin/manage-students/delete-group', $controller_path . '\Admin\ManageStudentsController@delete_student_group')->name('delete-group');
    Route::get('/admin/manage-students/add-students-group', $controller_path . '\Admin\ManageStudentsController@addnew_group')->name('add-students-group');
    Route::get('/admin/manage-students/edit-students-group/{id}', $controller_path . '\Admin\ManageStudentsController@edit_students_group')->name('edit-students-group');
    Route::get('/admin/manage-students/get-data-for-edit', $controller_path . '\Admin\ManageStudentsController@group_data_for_edit')->name('get-data-for-edit');
    Route::post('/admin/manage-students/update-students-group', $controller_path . '\Admin\ManageStudentsController@update_students_group')->name('update-students-group');


    Route::get('/admin/manage-students/import-students-group', $controller_path . '\Admin\ManageStudentsController@import_students_group')->name('manageUser-importgroup');
    Route::post('/admin/manage-students/import-student-group-excel', $controller_path . '\Admin\ManageStudentsController@import_group_excel')->name('import-student-group-excel');
    Route::get('/admin/manage-students/check-imported-group', $controller_path . '\Admin\ManageStudentsController@check_imported_group')->name('edit-imported-group-data');
    Route::post('/admin/manage-students/submit-edited-group-data', $controller_path . '\Admin\ManageStudentsController@update_imported_validate_data')->name('submit-edited-imported-group-data');


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
    Route::post('admin/question-bank/save-questions', $controller_path . '\Admin\QuestionBankController@save_questions')->name('save-questions');
    Route::get('admin/question-bank/view-detailed-questions', $controller_path . '\Admin\QuestionBankController@view_detailed_question')->name('view-detailed-questions');
    Route::get('admin/question-bank/edit-questions/{question_code}', $controller_path . '\Admin\QuestionBankController@editQuestions')->name('edit-questions');
    Route::post('admin/question-bank/update-questions', $controller_path . '\Admin\QuestionBankController@update_questions')->name('update-questions');
    Route::post('admin/question-bank/questions-status', $controller_path . '\Admin\QuestionBankController@question_status')->name('questions-status');
    Route::post('admin/question-bank/delete-question', $controller_path . '\Admin\QuestionBankController@delete_question')->name('delete-question');



    Route::get('admin/question-bank/upload-questions', $controller_path . '\Admin\QuestionBankController@uploadQuestions')->name('upload-questions');
    Route::post('admin/question-bank/import-excel-pro-questions', $controller_path . '\Admin\QuestionBankController@import_excel_data')->name('import-excel-programming-questions');



    Route::get('admin/question-bank/view-questions', $controller_path . '\Admin\QuestionBankController@viewFilterQuestions')->name('view-filter-questions');
    Route::post('admin/question-bank/set-filter-session', $controller_path . '\Admin\QuestionBankController@set_filter_session')->name('set-filter-session');
    Route::get('admin/question-bank/get-filtered-questions', $controller_path . '\Admin\QuestionBankController@get_filtered_question')->name('get-filtered-questions');
    Route::get('admin/skills/{skill}', $controller_path . '\Admin\QuestionBankController@filter_questions')->name('filter-questions');

    // Masters (Admin)

    //difficulty (Admin)
    Route::get('admin/masters/difficulty', $controller_path . '\Admin\MastersController@difficulty')->name('manage-difficulty');
    Route::post('admin/masters/difficulty-add', $controller_path . '\Admin\MastersController@difficulty_add')->name('difficulty-add');
    Route::post('admin/masters/difficulty-status', $controller_path . '\Admin\MastersController@difficulty_status')->name('difficulty-status');
    Route::post('admin/masters/difficulty-update', $controller_path . '\Admin\MastersController@edit_difficulty')->name('difficulty-update');
    Route::post('admin/masters/difficulty-delete', $controller_path . '\Admin\MastersController@delete_difficulty')->name('difficulty-delete');

    // categories master

    Route::get('admin/masters/categories', $controller_path . '\Admin\MastersController@categories')->name('manage-categories');
    Route::post('admin/masters/category-add', $controller_path . '\Admin\MastersController@category_add')->name('category-add');
    Route::post('admin/masters/category-status', $controller_path . '\Admin\MastersController@category_status')->name('category-status');
    Route::post('admin/masters/category-update', $controller_path . '\Admin\MastersController@edit_category')->name('category-update');
    Route::post('admin/masters/category-delete', $controller_path . '\Admin\MastersController@delete_category')->name('category-delete');

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



//Ajax Controller's Route:

Route::get('/ajax/ajax-student-group-detail', $controller_path . '\AjaxController@student_group_detail')->name('ajax-student-group-detail');
Route::get('/ajax/ajax-get-skills', $controller_path . '\AjaxController@get_skills')->name('ajax-get-skills');
Route::get('/ajax/ajax-get-difficulties', $controller_path . '\AjaxController@get_difficulties')->name('ajax-get-difficulties');
Route::get('/ajax/ajax-get-departments', $controller_path . '\AjaxController@get_department')->name('ajax-get-departments');
Route::get('/ajax/ajax-get-topics', $controller_path . '\AjaxController@get_topics')->name('ajax-get-topics');
Route::get('/ajax/ajax-get-colleges', $controller_path . '\AjaxController@get_colleges')->name('ajax-get-colleges');
Route::get('/ajax/ajax-get-questions', $controller_path . '\AjaxController@get_questions')->name('ajax-get-questions');
Route::get('/ajax/ajax-get-categories', $controller_path . '\AjaxController@get_categories')->name('ajax-get-categories');


//   Admin

// admin dashboard 
// Route::get('/admin/dashboard', $controller_path . '\dashboard\Analytics@index')->name('admin-dashboard');