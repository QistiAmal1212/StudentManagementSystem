<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\EmailController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\AjaxRequest;
use App\Http\Controllers\CrudOperationController;
use App\Http\Controllers\ExcelExport;
use App\Http\Controllers\pdfExport;
use App\Http\Controllers\RestApi;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
});

//=====================================RestfulApi=============================================
Route::get('/studentData',[RestApi::class, 'studentData'] )->name('studentData');
Route::get('/teacherData',[RestApi::class, 'teacherData'] )->name('teacherData');
Route::get('/classroomData',[RestApi::class, 'studentData'] )->name('classroomData');





Route::middleware('auth')->group(function () {

//=====================================DISPLAY PAGE===============================================
Route::get('/dashboard',[SystemController::class, 'dashboard'] )->name('dashboard');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/class-structure', [SystemController::class, 'classStructure'])->name('classStructure');
Route::get('/classroom', [SystemController::class, 'classroom'])->name('classroom');
Route::get('/students', [SystemController::class, 'students'])->name('students');
Route::get('/teachers', [SystemController::class, 'teachers'])->name('teachers');
Route::get('/analysis', [SystemController::class, 'analysis'])->name('analysis');
Route::get('/document', [SystemController::class, 'document'])->name('document');
Route::get('/email', [SystemController::class, 'email'])->name('email');
Route::get('/exam', [SystemController::class, 'exam'])->name('exam');
Route::get('/grading', [SystemController::class, 'grading'])->name('grading');
Route::match(['get', 'post'],'/examReport', [SystemController::class, 'examReport'])->name('examReport');
// Route::post('/report', [SystemController::class, 'report'])->name('report');




//=====================================ADD DATA===============================================

Route::post('/addTeacher', [CrudOperationController::class, 'addTeacher'])->name('addTeacher');
Route::post('/addStudent', [CrudOperationController::class, 'addStudent'])->name('addStudent');
Route::post('/addclassroom', [CrudOperationController::class, 'addclassroom'])->name('addclassroom');
Route::post('/addDocument', [CrudOperationController::class, 'addDocument'])->name('addDocument');
Route::post('/importStudents', [CrudOperationController::class, 'importStudents'])->name('importStudents');
Route::post('/addExam', [CrudOperationController::class, 'addExam'])->name('addExam');


//=====================================UPDATE DATA===============================================

Route::put('/updateTeacher', [CrudOperationController::class, 'updateTeacher'])->name('updateTeacher');
Route::put('/updateStudent', [CrudOperationController::class, 'updateStudent'])->name('updateStudent');
Route::put('/updateclassroom', [CrudOperationController::class, 'updateclassroom'])->name('updateclassroom');
Route::put('/updateDocument', [CrudOperationController::class, 'updateDocument'])->name('updateDocument');
Route::put('/updateResult', [CrudOperationController::class, 'updateResult'])->name('updateResult');

//=====================================DELETE DATA===============================================

Route::delete('/deleteTeacher', [CrudOperationController::class, 'deleteTeacher'])->name('deleteTeacher');
Route::delete('/deleteStudent', [CrudOperationController::class, 'deleteStudent'])->name('deleteStudent');
Route::delete('/deleteclassroom', [CrudOperationController::class, 'deleteclassroom'])->name('deleteclassroom');
Route::delete('/deleteDocument', [CrudOperationController::class, 'deleteDocument'])->name('deleteDocument');


//=====================================EXPORT EXCEL=============================================

Route::get('/exportExcelTeachers', [ExcelExport::class, 'exportExcelTeachers'])->name('exportExcelTeachers');
Route::get('/exportExcelStudents', [ExcelExport::class, 'exportExcelStudents'])->name('exportExcelStudents');
Route::get('/exportExcelclassroom', [ExcelExport::class, 'exportExcelclassroom'])->name('exportExcelclassroom');
Route::get('/exportExcelClassStructure/{id?}',[ExcelExport::class, 'exportExcelClassStructure'])->name('exportExcelClassStructure');


//=====================================EXPORT PDF===============================================

Route::get('/exportPdfTeacher', [pdfExport::class, 'exportPdfTeacher'])->name('exportPdfTeacher');
Route::get('/exportPdfStudent', [pdfExport::class, 'exportPdfStudent'])->name('exportPdfStudent');
Route::get('/exportPdfclassroom', [pdfExport::class, 'exportPdfclassroom'])->name('exportPdfclassroom');
Route::get('/exportPdfClassStructure/{id?}', [pdfExport::class, 'exportPdfClassStructure'])
   ->name('exportPdfClassStructure');



//=====================================AJAX REQUEST===============================================

// CLASS STRUCTURE DETAIL (AJAX REQUEST)
 Route::get('/getclassStructure',  [AjaxRequest::class, 'getclassStructure'])->name('getclassStructure');

//STUDENT RESULT DETAIL
Route::get('/getstudent_result',  [AjaxRequest::class, 'getstudent_result'])->name('getstudent_result');

//STUDENT RESULT DETAIL
Route::get('/getstudent_result2',  [AjaxRequest::class, 'getstudent_result2'])->name('getstudent_result2');

//GET CLASS DATA
Route::get('/getClassData',  [AjaxRequest::class, 'getClassData'])->name('getClassData');

// UPDATE DETAIL (AJAX REQUEST)
 Route::get('/getTeacherDetail',  [AjaxRequest::class, 'getTeacherDetail'])->name('getTeacherDetail');
 Route::get('/getStudentDetail',  [AjaxRequest::class, 'getStudentDetail'])->name('getStudentDetail');
 Route::get('/getclassroomDetail',  [AjaxRequest::class, 'getclassroomDetail'])->name('getclassroomDetail');
 Route::get('/getDocumentDetail',  [AjaxRequest::class, 'getDocumentDetail'])->name('getDocumentDetail');




//=====================================SEND EMAIL===============================================

Route::post('/sendEmail', [EmailController::class, 'sendEmail'])->name('sendEmail');
});

require __DIR__.'/auth.php';
