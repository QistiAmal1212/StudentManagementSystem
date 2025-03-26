<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\EmailController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\ajaxRequest;
use App\Http\Controllers\CrudOperationController;
use App\Http\Controllers\excelExport;
use App\Http\Controllers\pdfExport;
use App\Http\Controllers\RestApi;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
});

//=====================================RestfulApi=============================================
Route::get('/studentData',[RestApi::class, 'studentData'] )->name('studentData');
Route::get('/teacherData',[RestApi::class, 'teacherData'] )->name('teacherData');
Route::get('/class_roomData',[RestApi::class, 'studentData'] )->name('class_roomData');





Route::middleware('auth')->group(function () {

//=====================================DISPLAY PAGE===============================================
Route::get('/dashboard',[SystemController::class, 'dashboard'] )->name('dashboard');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/class-structure', [SystemController::class, 'classStructure'])->name('classStructure');
Route::get('/class_room', [SystemController::class, 'class_room'])->name('class_room');
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
Route::post('/addclass_room', [CrudOperationController::class, 'addclass_room'])->name('addclass_room');
Route::post('/addDocument', [CrudOperationController::class, 'addDocument'])->name('addDocument');
Route::post('/importStudents', [CrudOperationController::class, 'importStudents'])->name('importStudents');
Route::post('/addExam', [CrudOperationController::class, 'addExam'])->name('addExam');


//=====================================UPDATE DATA===============================================

Route::put('/updateTeacher', [CrudOperationController::class, 'updateTeacher'])->name('updateTeacher');
Route::put('/updateStudent', [CrudOperationController::class, 'updateStudent'])->name('updateStudent');
Route::put('/updateclass_room', [CrudOperationController::class, 'updateclass_room'])->name('updateclass_room');
Route::put('/updateDocument', [CrudOperationController::class, 'updateDocument'])->name('updateDocument');
Route::put('/updateResult', [CrudOperationController::class, 'updateResult'])->name('updateResult');

//=====================================DELETE DATA===============================================

Route::delete('/deleteTeacher', [CrudOperationController::class, 'deleteTeacher'])->name('deleteTeacher');
Route::delete('/deleteStudent', [CrudOperationController::class, 'deleteStudent'])->name('deleteStudent');
Route::delete('/deleteclass_room', [CrudOperationController::class, 'deleteclass_room'])->name('deleteclass_room');
Route::delete('/deleteDocument', [CrudOperationController::class, 'deleteDocument'])->name('deleteDocument');


//=====================================EXPORT EXCEL=============================================

Route::get('/exportExcelTeachers', [excelExport::class, 'exportExcelTeachers'])->name('exportExcelTeachers');
Route::get('/exportExcelStudents', [excelExport::class, 'exportExcelStudents'])->name('exportExcelStudents');
Route::get('/exportExcelclass_room', [excelExport::class, 'exportExcelclass_room'])->name('exportExcelclass_room');
Route::get('/exportExcelClassStructure/{id?}',[excelExport::class, 'exportExcelClassStructure'])->name('exportExcelClassStructure');


//=====================================EXPORT PDF===============================================

Route::get('/exportPdfTeacher', [pdfExport::class, 'exportPdfTeacher'])->name('exportPdfTeacher');
Route::get('/exportPdfStudent', [pdfExport::class, 'exportPdfStudent'])->name('exportPdfStudent');
Route::get('/exportPdfclass_room', [pdfExport::class, 'exportPdfclass_room'])->name('exportPdfclass_room');
Route::get('/exportPdfClassStructure/{id?}', [pdfExport::class, 'exportPdfClassStructure'])
   ->name('exportPdfClassStructure');



//=====================================AJAX REQUEST===============================================

// CLASS STRUCTURE DETAIL (AJAX REQUEST)
 Route::get('/getclassStructure',  [ajaxRequest::class, 'getclassStructure'])->name('getclassStructure');

//STUDENT RESULT DETAIL
Route::get('/getStudentResult',  [ajaxRequest::class, 'getStudentResult'])->name('getStudentResult');

//STUDENT RESULT DETAIL
Route::get('/getStudentResult2',  [ajaxRequest::class, 'getStudentResult2'])->name('getStudentResult2');

//GET CLASS DATA
Route::get('/getClassData',  [ajaxRequest::class, 'getClassData'])->name('getClassData');

// UPDATE DETAIL (AJAX REQUEST)
 Route::get('/getTeacherDetail',  [ajaxRequest::class, 'getTeacherDetail'])->name('getTeacherDetail');
 Route::get('/getStudentDetail',  [ajaxRequest::class, 'getStudentDetail'])->name('getStudentDetail');
 Route::get('/getclass_roomDetail',  [ajaxRequest::class, 'getclass_roomDetail'])->name('getclass_roomDetail');
 Route::get('/getDocumentDetail',  [ajaxRequest::class, 'getDocumentDetail'])->name('getDocumentDetail');




//=====================================SEND EMAIL===============================================

Route::post('/sendEmail', [EmailController::class, 'sendEmail'])->name('sendEmail');
});

require __DIR__.'/auth.php';
