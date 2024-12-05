<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display all subjects
     * http://localhost:8000/api/subjects
     */

     public function index(){
        return response()->json([
            'ok' => true,
            'message' => 'Retrieved Successfully',
            'data' => Subject::all()
        ], 200);
     }

     /**
      * Create a new subject
      * http://localhost:8000/api/subjects/
      */

      public function create(Request $request){
        $validator = validator($request->all(), [
            'subject_name' => 'required | max:30',
            'subject_type' => 'required | max:30'
        ]);

        if($validator->fails()){
            return response()->json([
                'ok' => false,
                'message' => 'Subject Creation Failed',
                'errors' => $validator->errors()
            ],400);
        }

        $subjects = Subject::create($validator->validated());
        return response()->json([
            'ok' => true,
            'message' => 'Subject Created Successfully',
            'data' => $subjects
        ], 200);
      }

      /**
       * Update a subject
       * http://localhost:8000/api/subjects/{id}
      */

      public function update(Request $request, $id){
        $validator = validator($request->all(), [
            'subject_name' => 'required | max:30',
            'subject_type' => 'required | max:30'
        ]);

        if($validator->fails()){
            return response()->json([
                'ok' => false,
                'message' => 'Subject Update Failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $subjects = Subject::find($id);
        $subjects->update($validator->validated());
        return response()->json([
            'ok' => true,
            'message' => 'Subject Updated Successfully',
            'data' => $subjects
        ], 200);
      }

      /**
       * Delete a subject
       * http://localhost:8000/api/subjects/{id}
       */

       public function destroy($id){
        $subjects = Subject::find($id);
        $subjects->delete();
        return response()->json([
            'ok' => true,
            'message' => 'Subject Deleted Successfully',
            'data' => $subjects
        ], 200);
       }
}
