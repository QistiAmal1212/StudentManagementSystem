<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Models\Classroom_teacher;
use App\Models\Classroom;
use App\Models\students;
use App\Models\documents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Imports\studentsImport;
use App\Models\exam;
use App\Models\studentResult;

use Maatwebsite\Excel\Facades\Excel;




class CrudOperationController extends Controller
{




public function addTeacher(Request $request)
{
        try
        {
            $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_tell' => ['required', 'string', 'max:12', 'min:11'],
            'ic_number' => ['required', 'string', 'max:12', 'min:12','unique:' . Classroom_teacher::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Classroom_teacher::class],
            ]);

            $teacher = new Classroom_teacher();
            $teacher->name = $request->input('name');
            $teacher->ic_number = $request->input('ic_number');
            $teacher->no_tell = $request->input('no_tell');
            $teacher->email = $request->input('email');
            $teacher->is_class_teacher = 0;
            $teacher->save();

            return redirect('teachers')->with('success', 'Teacher added successfully');
        }

        catch (\Exception $e)
        {

            $errorMessage = $e->getMessage();
            Session::flash('error', $errorMessage);
            return redirect()->back()->withInput();
        }

}




public function addClassroom(Request $request)
{

    try
    {
        $request->validate([
        'class_name' => ['required', 'string', 'max:255', 'unique:' . Classroom::class],
        ]);


        $tId=$request->input('teacher_id');

        $Classroom = new Classroom();
        $Classroom->class_name = $request->input('class_name');
        $Classroom->form = $request->input('form');
        $Classroom->teacher_id = $request->input('teacher_id');
        $Classroom->save();

        $teacherChange =  Classroom_teacher::WHERE('teacher_id',$tId)->first();
        $teacherChange->is_class_teacher=1;
        $teacherChange->save();
        return redirect('Classroom')->with('success', 'Classroom added successfully');

    }
    catch (\Exception $e)
    {
       $errorMessage = $e->getMessage();
       Session::flash('error', $errorMessage);
       return redirect()->back()->withInput();

    }

}




public function addStudent(Request $request)
{
    try
    {

        $request->validate([

        'name' => ['required', 'string'],
        'class' => ['required'],
        'family_income ' => ['required'],
        'total_family_member' => ['required'],
        'phone' => ['required', 'string', 'max:12', 'min:11'],
        'ic_number' => ['required', 'string', 'max:12', 'min:12', 'unique:' . students::class],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . students::class],
        ]);

        $student = new students();
        $student->name = $request->input('name');
        $student->ic_number = $request->input('ic_number');
        $student->no_tell = $request->input('phone');
        $student->email = $request->input('email');
        $student->Classroom_id = $request->input('class');
        $student->family_income  = $request->input('family_income ');
        $student->total_family_member = $request->input('total_family_member');
        $student->save();

        return redirect('students')->with('success', 'student added successfully');

    }

    catch (\Exception $e)
    {

       $errorMessage = $e->getMessage();
       Session::flash('error', $errorMessage);
       return redirect()->back()->withInput();

    }

}




public function addDocument(Request $request)
{
    try
    {
        $request->validate([
            'file' => ['required'],
            'title' => ['required'],
            ]);

      //get the file
      $file = $request->file('file');
      // give name to file to be store
      $fileName = time() . '.' . $file->getClientOriginalExtension();
      // store the file with name you created
      $file->storeAs('documents', $fileName, 'public');
      // get the path to store in database
      $filePath = 'documents/' . $fileName;
      $fullUrl = asset('storage/' . $filePath);


      $document = new documents();
      $document->title = $request->input('title');
      $document->document_path = $fullUrl;
      $document->save();

      return redirect('document')->with('success', 'document added successfully');

    }


    catch (\Exception $e)
    {
      $errorMessage = $e->getMessage();
      Session::flash('error', $errorMessage);
      return redirect()->back()->withInput();

    }


}



public function addExam(Request $request)
{
    try
    {
        $request->validate([
            'form' => ['required'],
            'title' => ['required'],
            ]);



      $exam = new exam();
      $exam->title = $request->input('title');
      $exam->form = $request->input('form');

      $exam->save();
      $checkForm =$exam->form;
      $exam_id =$exam->exam_id;

      $Classrooms = Classroom::where('form', $checkForm)->get();
      $Classroom_ids = $Classrooms->pluck('Classroom_id');
      $students = Students::whereIn('Classroom_id', $Classroom_ids)->get();

      foreach($students as $student)
      {
          $studentResult = new studentResult();
          $studentResult->exam_id=$exam_id;
          $studentResult->name=$student->name;
          $studentResult->status="pending";
          $studentResult->ic_number=$student->ic_number;
          $findclass_name= Classroom::Where('Classroom_id',$student->Classroom_id)->first();
          $studentResult->class_name=$findclass_name->class_name;
          $studentResult->save();
      }



      return redirect('exam')->with('success', 'exam added successfully');

    }


    catch (\Exception $e)
    {
      $errorMessage = $e->getMessage();
      Session::flash('error', $errorMessage);
      return redirect()->back()->withInput();

    }


}






public function updateTeacher(Request $request)
{
    try {
        $teacher_id = $request->input('updateId');
        $teacher = Classroom_teacher::WHERE('teacher_id', $teacher_id)->first();
        $teacher->name = $request->input('updateName');
        $teacher->ic_number = $request->input('updateic_number');
        $teacher->no_tell = $request->input('updateno_tell');
        $teacher->email = $request->input('updateEmail');
        $teacher->save();
        return redirect('teachers')->with('success', 'update successfully');
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        Session::flash('error', $errorMessage);
        return redirect()->back()->withInput();
    }
}



public function updateClassroom(Request $request)
{
    try {
        $Classroom_id = $request->input('updateClassId');
        $Classroom = Classroom::WHERE('Classroom_id', $Classroom_id)->first();
        $teacherbefore=$Classroom->teacher_id;
        $teacherAfter= $request->input('updateteacher_id');
        $Classroom->class_name = $request->input('updateclass_name');
        $Classroom->form = $request->input('updateForm');
        $Classroom->teacher_id = $request->input('updateteacher_id');
        $Classroom->save();

        $teacher=Classroom_teacher::WHERE('teacher_id',$teacherbefore)->first();
        $teacher->is_class_teacher=0;
        $teacher->save();

        $newTeacher=Classroom_teacher::WHERE('teacher_id',$teacherAfter)->first();
        $newTeacher->is_class_teacher=1;
        $newTeacher->save();

        return redirect('Classroom')->with('success', 'update successfully');
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        Session::flash('error', $errorMessage);
        return redirect()->back()->withInput();
    }
}




public function updateStudent(Request $request)
{
    try {
        $student_id = $request->input('updateId');
        $student = students::WHERE('student_id', $student_id)->first();
        $student->name = $request->input('updateName');
        $student->ic_number = $request->input('updateic_number');
        $student->no_tell = $request->input('updatePhone');
        $student->email = $request->input('updateEmail');
        $student->family_income  = $request->input('updatefamily_income ');
        $student->total_family_member = $request->input('updatetotal_family_member');
        $student->Classroom_id = $request->input('updateClass');
        $student->save();



        return redirect('students')->with('success', 'update successfully');
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        Session::flash('error', $errorMessage);
        return redirect()->back()->withInput();
    }
}




public function updateDocument(Request $request)
{

}




public function deleteTeacher(Request $request)
{
   try
   {

    $selectedTeacher = $request->input('selectedTeacher');
    $teachers = Classroom_teacher::WHEREIN('teacher_id',$selectedTeacher)->get();
    $checkTeacher = Classroom_teacher::WHEREIN('teacher_id',$selectedTeacher)->WHERE('is_class_teacher',1)->get();
   if($checkTeacher->count() == 0)

   {

      foreach ($teachers as $teacher)
      {
      $teacher->delete();
      }

       return redirect('teachers')->with('success', 'delete successfully');

   }

   else
   {

       return redirect('teachers')->with('error', 'teacher you want delete still class teacher');

   }

   }



   catch (\Exception $e)
   {

   $errorMessage = $e->getMessage();
   Session::flash('error', $errorMessage);
   return redirect()->back()->withInput();

   }


}



public function deleteClassroom(Request $request)
{
    try
    {

     $selectedClass = $request->input('selectedClass');
     $Classroom = Classroom::WHEREIN('Classroom_id',$selectedClass)->get();

     $checkId = students::WHEREIN('Classroom_id',$selectedClass)->get();




    if($checkId->count() == 0)

    {

       foreach ($Classroom as $Classroom)
       {
        $checkId2 = Classroom_teacher::WHERE('teacher_id',$Classroom->teacher_id)->first();
     $checkId2->is_class_teacher=0;

       $Classroom->delete();
       $checkId2->save();
       }

        return redirect('Classroom')->with('success', 'delete successfully');

    }

    else
    {

        return redirect('Classroom')->with('error', 'class you want delete still got student');

    }

    }



    catch (\Exception $e)
    {

    $errorMessage = $e->getMessage();
    Session::flash('error', $errorMessage);
    return redirect()->back()->withInput();

    }

}




public function deleteStudent(Request $request)
{
    try
    {

     $selectedStudent = $request->input('selectedStudent');
     $students = students::WHEREIN('student_id',$selectedStudent)->get();

       foreach ($students as $student)
       {
       $student->delete();
       }

        return redirect('students')->with('success', 'delete successfully');

    }


    catch (\Exception $e)
    {

    $errorMessage = $e->getMessage();
    Session::flash('error', $errorMessage);
    return redirect()->back()->withInput();

    }

}




public function deleteDocument(Request $request)
{
    try
    {

     $selectedDocument = $request->input('selectedDocument');
     $documents = documents::WHEREIN('document_id',$selectedDocument)->get();

       foreach ($documents as $document)
       {

       $fileUrl = $document->document_path;
       // Extract the path from the URL
       $filePath = parse_url($fileUrl, PHP_URL_PATH);
       // Remove the leading slash if present
       $filePath = str_replace('/storage', '', $filePath);
       $document->delete();

     if ($filePath)
       {

        Storage::disk('public')->delete($filePath);
         return redirect('document')->with('success', 'delete successfully');
       }

       }



    }


    catch (\Exception $e)
    {

    $errorMessage = $e->getMessage();
    Session::flash('error', $errorMessage);
    return redirect()->back()->withInput();

    }
}


public function importStudents()
{
   try
   {

    Excel::import(new studentsImport, request()->file('file'));

    return redirect()->route('students')->with('success', 'Data imported successfully!');

   }
   catch (\Exception $e)
   {
    $errorMessage = $e->getMessage();
    Session::flash('error', $errorMessage);
    return redirect()->back()->withInput();
   }



}


public function updateResult(Request $request)
{
    try
    {
     $ic_number=$request->input('updateId');
     $result=studentResult::Where('ic_number',$ic_number)->first();
     $result->name= $request->input('name');
     $result->bahasa_melayu= $request->input('bahasa_melayu');
     $result->english= $request->input('english');
     $result->math= $request->input('math');
     $result->science= $request->input('science');
     $result->sejarah= $request->input('sejarah');
     $result->status= "successful";
     $result->average= ($result->bahasa_melayu+$result->english+$result->math+$result->science+$result->sejarah)/5;
     $result->save();

     return redirect()->route('grading')->with('success', 'Data update successfully!');

    }
    catch (\Exception $e)
    {
     $errorMessage = $e->getMessage();
     Session::flash('error', $errorMessage);
     return redirect()->back()->withInput();
    }
}


}
