<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\EmailController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\ajaxRequest;
use App\Http\Controllers\CrudOperationController;
use App\Http\Controllers\excelExport;
use App\Http\Controllers\pdfExport;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
});



Route::middleware('auth')->group(function () {

//=====================================DISPLAY PAGE===============================================
Route::get('/dashboard',[SystemController::class, 'dashboard'] )->name('dashboard');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/class-structure', [SystemController::class, 'classStructure'])->name('classStructure');
Route::get('/classRoom', [SystemController::class, 'classRoom'])->name('classRoom');
Route::get('/students', [SystemController::class, 'students'])->name('students');
Route::get('/teachers', [SystemController::class, 'teachers'])->name('teachers');
Route::get('/analysis', [SystemController::class, 'analysis'])->name('analysis');
Route::get('/document', [SystemController::class, 'document'])->name('document');
Route::get('/email', [SystemController::class, 'email'])->name('email');
   

//=====================================ADD DATA===============================================

Route::post('/addTeacher', [CrudOperationController::class, 'addTeacher'])->name('addTeacher');
Route::post('/addStudent', [CrudOperationController::class, 'addStudent'])->name('addStudent');
Route::post('/addClassRoom', [CrudOperationController::class, 'addClassRoom'])->name('addClassRoom');
Route::post('/addDocument', [CrudOperationController::class, 'addDocument'])->name('addDocument');
Route::post('/importStudents', [CrudOperationController::class, 'importStudents'])->name('importStudents');

//=====================================UPDATE DATA===============================================

Route::put('/updateTeacher', [CrudOperationController::class, 'updateTeacher'])->name('updateTeacher');
Route::put('/updateStudent', [CrudOperationController::class, 'updateStudent'])->name('updateStudent');
Route::put('/updateClassRoom', [CrudOperationController::class, 'updateClassRoom'])->name('updateClassRoom');
Route::put('/updateDocument', [CrudOperationController::class, 'updateDocument'])->name('updateDocument');


//=====================================DELETE DATA===============================================

Route::delete('/deleteTeacher', [CrudOperationController::class, 'deleteTeacher'])->name('deleteTeacher');
Route::delete('/deleteStudent', [CrudOperationController::class, 'deleteStudent'])->name('deleteStudent');
Route::delete('/deleteClassRoom', [CrudOperationController::class, 'deleteClassRoom'])->name('deleteClassRoom');
Route::delete('/deleteDocument', [CrudOperationController::class, 'deleteDocument'])->name('deleteDocument');


//=====================================EXPORT EXCEL=============================================

Route::get('/exportExcelTeachers', [excelExport::class, 'exportExcelTeachers'])->name('exportExcelTeachers');
Route::get('/exportExcelStudents', [excelExport::class, 'exportExcelStudents'])->name('exportExcelStudents');
Route::get('/exportExcelClassRoom', [excelExport::class, 'exportExcelClassRoom'])->name('exportExcelClassRoom');
Route::get('/exportExcelClassStructure', [excelExport::class, 'exportClassStructure'])->name('exportClassStructure');



//=====================================EXPORT PDF===============================================

Route::get('/exportPdfTeacher', [pdfExport::class, 'exportPdfTeacher'])->name('exportPdfTeacher');
Route::get('/exportPdfStudent', [pdfExport::class, 'exportPdfStudent'])->name('exportPdfStudent');
Route::get('/exportPdfClassRoom', [pdfExport::class, 'exportPdfClassRoom'])->name('exportPdfClassRoom');
Route::get('/exportClassStructure', [pdfExport::class, 'exportClassStructure'])->name('');



//=====================================AJAX REQUEST===============================================

// CLASS STRUCTURE DETAIL (AJAX REQUEST)
 Route::get('/getclassStructure',  [ajaxRequest::class, 'getclassStructure'])->name('getclassStructure');

// UPDATE DETAIL (AJAX REQUEST)
 Route::get('/getTeacherDetail',  [ajaxRequest::class, 'getTeacherDetail'])->name('getTeacherDetail');
 Route::get('/getStudentDetail',  [ajaxRequest::class, 'getStudentDetail'])->name('getStudentDetail');
 Route::get('/getClassRoomDetail',  [ajaxRequest::class, 'getClassRoomDetail'])->name('getClassRoomDetail');
 Route::get('/getDocumentDetail',  [ajaxRequest::class, 'getDocumentDetail'])->name('getDocumentDetail');




//=====================================SEND EMAIL===============================================

Route::post('/sendEmail', [EmailController::class, 'sendEmail'])->name('sendEmail');
});

require __DIR__.'/auth.php';
