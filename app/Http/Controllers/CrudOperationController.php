<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Models\classRoom_Teacher;
use App\Models\classRoom;
use App\Models\students;
use App\Models\documents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Session;
use App\Imports\studentsImport;
use Maatwebsite\Excel\Facades\Excel;




class CrudOperationController extends Controller
{
   



public function addTeacher(Request $request)
{
        try 
        {
            $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'noTell' => ['required', 'string', 'max:12', 'min:11'],
            'icNumber' => ['required', 'string', 'max:12', 'min:12','unique:' . classRoom_Teacher::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . classRoom_Teacher::class],
            ]);
    
            $teacher = new classRoom_Teacher();
            $teacher->name = $request->input('name');
            $teacher->icNumber = $request->input('icNumber');
            $teacher->noTell = $request->input('noTell');
            $teacher->email = $request->input('email');
            $teacher->isClassTeacher = 0;
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
    



public function addClassRoom(Request $request)
{

    try
    {
        $request->validate([
        'className' => ['required', 'string', 'max:255', 'unique:' . classRoom::class],
        ]);


        $tId=$request->input('teacherId');

        $classroom = new classRoom();
        $classroom->className = $request->input('className');
        $classroom->form = $request->input('form');
        $classroom->teacherId = $request->input('teacherId');
        $classroom->save();

        $teacherChange =  classRoom_Teacher::WHERE('teacherId',$tId)->first();
        $teacherChange->isClassTeacher=1;
        $teacherChange->save();
        return redirect('classRoom')->with('success', 'classRoom added successfully');

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
        'familyIncome' => ['required'],
        'totalFamilyMember' => ['required'],
        'phone' => ['required', 'string', 'max:12', 'min:11'],
        'icNumber' => ['required', 'string', 'max:12', 'min:12', 'unique:' . students::class],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . students::class],
        ]);

        $student = new students();
        $student->name = $request->input('name');
        $student->icNumber = $request->input('icNumber');
        $student->noTell = $request->input('phone');
        $student->email = $request->input('email');
        $student->classroomId = $request->input('class');
        $student->familyIncome = $request->input('familyIncome');
        $student->totalFamilyMember = $request->input('totalFamilyMember');
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
      $document->documentPath = $fullUrl;
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
  

    




public function updateTeacher(Request $request)
{
    try {
        $teacherId = $request->input('updateId');
        $teacher = classRoom_Teacher::WHERE('teacherId', $teacherId)->first();
        $teacher->name = $request->input('updateName');
        $teacher->icNumber = $request->input('updateIcNumber');
        $teacher->noTell = $request->input('updateNoTell');
        $teacher->email = $request->input('updateEmail');
        $teacher->save();
        return redirect('teachers')->with('success', 'update successfully');
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        Session::flash('error', $errorMessage);
        return redirect()->back()->withInput();
    }
}



public function updateClassRoom(Request $request)
{
    try {
        $classroomId = $request->input('updateClassId');
        $classRoom = classRoom::WHERE('classroomId', $classroomId)->first();
        $teacherbefore=$classRoom->teacherId;
        $teacherAfter= $request->input('updateTeacherId');
        $classRoom->className = $request->input('updateClassName');
        $classRoom->form = $request->input('updateForm');
        $classRoom->teacherId = $request->input('updateTeacherId');
        $classRoom->save();

        $teacher=classRoom_Teacher::WHERE('teacherId',$teacherbefore)->first();
        $teacher->isClassTeacher=0;
        $teacher->save();

        $newTeacher=classRoom_Teacher::WHERE('teacherId',$teacherAfter)->first();
        $newTeacher->isClassTeacher=1;
        $newTeacher->save();

        return redirect('classRoom')->with('success', 'update successfully');
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        Session::flash('error', $errorMessage);
        return redirect()->back()->withInput();
    }  
}




public function updateStudent(Request $request)
{
    try {
        $studentId = $request->input('updateId');
        $student = students::WHERE('studentId', $studentId)->first();
        $student->name = $request->input('updateName');
        $student->icNumber = $request->input('updateIcNumber');
        $student->noTell = $request->input('updatePhone');
        $student->email = $request->input('updateEmail');
        $student->familyIncome = $request->input('updateFamilyIncome');
        $student->totalFamilyMember = $request->input('updateTotalFamilyMember');
        $student->classroomId = $request->input('updateClass');
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
    $teachers = classRoom_Teacher::WHEREIN('teacherId',$selectedTeacher)->get();
    $checkTeacher = classRoom_Teacher::WHEREIN('teacherId',$selectedTeacher)->WHERE('isClassTeacher',1)->get();
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



public function deleteClassRoom(Request $request)
{
    try
    {
 
     $selectedClass = $request->input('selectedClass');
     $classRoom = classRoom::WHEREIN('classroomId',$selectedClass)->get();

     $checkId = students::WHEREIN('classroomId',$selectedClass)->get();

   
    

    if($checkId->count() == 0)
 
    {
     
       foreach ($classRoom as $classRoom)
       { 
        $checkId2 = classRoom_Teacher::WHERE('teacherId',$classRoom->teacherId)->first();
     $checkId2->isClassTeacher=0;
    
       $classRoom->delete(); 
       $checkId2->save();
       }
 
        return redirect('classRoom')->with('success', 'delete successfully');
 
    }
 
    else
    {
 
        return redirect('classRoom')->with('error', 'class you want delete still got student');
 
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
     $students = students::WHEREIN('studentId',$selectedStudent)->get();

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
     $documents = documents::WHEREIN('documentId',$selectedDocument)->get();

       foreach ($documents as $document)
       {
     
       $fileUrl = $document->documentPath;
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
    


}
