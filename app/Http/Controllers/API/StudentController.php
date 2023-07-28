<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;



class StudentController extends Controller
{
    public function index(){
        $student=Student::all();
        
        if($student->count()>0){
            return response()->json([
                'status' => '200',
                'student' => $student,
              
            ],200);
        } else{
            return response()->json([
                'status' => '404',
                'message' => 'No Records Found'
            ],404);
        }
        
    }

    public function postStudent(Request $request){
        $validator=Validator::make($request->all(),[
            'Name' => 'required|string|max:191',
            'Course' => 'required|string|max:191',
            'Email' => 'required|email|max:191',
            'Phone'=>'required|digits:10',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => '422',
                'error' => $validator->messages()
            ],422);
        } else{
            $student=Student::create([
                'Name' => $request->Name,
                'Course'=>$request->Course,
                'Email' => $request->Email,
                'Phone' => $request->Phone
            ]);

            if($student){
                return response()->json([
                    'status' => '200',
                    'message' => 'Student Created Successfully'
                ],200);
            } else{
                return response()->json([
                    'status' => '500',
                    'message' => 'Something went wrong'
                ],500);
            }
        }
    }

    public function getStudent($id){
        $student=Student::find($id);
            if($student){
                return response()->json([
                    'status' => '200',
                    'student' => $student,
                ],200);
            } else{
                return response()->json([
                    'status' => '404',
                    'message' => 'No Such Student Found',
                ],404);
            }
        
    }

    public function updateStudent(Request $request,$id){
        $validator=Validator::make($request->all(),[
            'Name' => 'required|string|max:191',
            'Course' => 'required|string|max:191',
            'Email' => 'required|email|max:191',
            'Phone'=>'required|digits:10',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => '422',
                'error' => $validator->messages()
            ],422);
        } else{
            $student=Student::find($id);
            if($student){
                $student->update([
                    'Name' => $request->Name,
                    'Course'=>$request->Course,
                    'Email' => $request->Email,
                    'Phone' => $request->Phone
                ]);

                return response()->json([
                    'status' => '200',
                    'message' => 'Student Updated Successfully'
                ],200);
            } else{
                return response()->json([
                    'status' => '500',
                    'message' => 'No Such Student Found'
                ],500);
            }
        }
    }

    public function deleteStudent($id){
        $student=Student::find($id);
        if($student){
            $student->delete();
            return response()->json([
                'status' => '200',
                'message' => 'Student Deleted Successfully'
            ],200);

        } else{
            return response()->json([
                'status' => '500',
                'message' => 'No Such Student Found'
            ],500);
        }
    }

    public function getStudentProfile($id){
        $student=Student::find($id)->StudentDetails;
        if($student){
            return response()->json([
                'status' => '200',
                'student' => $student,
            ],200);
        } else{
            return response()->json([
                'status' => '404',
                'message' => 'No Such Student Found',
            ],404);
        }
    }

    public function deleteStudentProfile($id){
        $student=Student::find($id)->StudentDetails;
        if($student){
            $student->delete();
            return response()->json([
                'status' => '200',
                'message' => 'Student Deleted Successfully',
            ],200);
        } else{
            return response()->json([
                'status' => '404',
                'message' => 'No Such Student Found',
            ],404);
        }
    }

    public function createStudentDetails(Request $request,$id){
        $student =Student::find($id);
        if($student){
            $details=$student->StudentDetails()->create([
                "address"=>$request->address,
                "university"=>$request->university,
            ]);
            if($details){
                return response()->json([
                    'status' => '200',
                    'message' => 'Student Details Created Successfully',
                ],200);
            } else{
                return response()->json([
                    'status' => '500',
                    'message' => 'something went wrong',
                ],404);
            }
        } else{
            return response()->json([
                'status' => '404',
                'message' => 'No Such Student Found',
            ],404);
        }
        

    }
}
