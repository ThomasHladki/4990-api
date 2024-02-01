<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResidencyPositionApplication;
use App\Http\Requests\CreateStudentGradeRequest;
use App\Http\Requests\CreateStudentLocationPreference;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\IdRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\StudentGrade;
use App\Models\StudentLocationPreference;
use App\Services\StudentService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;


class StudentController extends Controller
{

    use HttpResponses;
    private StudentService $studentService;

    public function __construct(StudentService $studentService){
        $this->studentService = $studentService;
    }


    public function getStudent(IdRequest $request)
    {
        if($request->id !== auth()->user()->student?->id){
            return $this->error('', 'Unauthorized', 403);
        }
        $student = $this->studentService->getStudent($request);
        if(!$student){
            return $this->error('', 'No student found', 404);
        }
        return $this->success([
            'student' => $student
        ]);
    }

    public function getEducationalInstitutions(){
        return $this->success([
            'institutions' => $this->studentService
        ]);
    }

    public function createStudent(CreateStudentRequest $request){
        return $this->success([
            'student' => $this->studentService->createStudent($request)
        ]);
    }

    public function updateStudent(UpdateStudentRequest $request){
        if($request->id !== auth()->user()->student?->id){
            return $this->error('', 'Unauthorized', 403);
        }
        return $this->success([
            'student' => $this->studentService->updateStudent($request)
        ]);
    }

    public function getGrades(IdRequest $request)
    {
        if($request->id !== auth()->user()->student?->id){
            return $this->error('', 'Unauthorized', 403);
        }
        return $this->success([
            'grades' => $this->studentService->getGrades($request)
        ]);
    }

    public function getMatches(IdRequest $request)
    {
        if($request->id !== auth()->user()->student?->id){
            return $this->error('', 'Unauthorized', 403);
        }
        return $this->success([
            'matches' => $this->studentService->getMatches($request)
        ]);
    }

    public function createStudentGrade(CreateStudentGradeRequest $request)
    {
        if($request->student_id !== auth()->user()->student?->id){
            return $this->error('', 'Unauthorized', 403);
        }
        return $this->success([
            'grade' => $this->studentService->createStudentGrade($request)
        ]);
    }

    public function deleteStudentGrade(IdRequest $request)
    {
        $grade = StudentGrade::query()
            ->where('id', '=', $request->id)
            ->firstOrFail();
        if($grade->student_id !== auth()->user()->student?->id){
            return $this->error('', 'Unauthorized', 403);
        }
        return $this->success(
            $this->studentService->deleteStudentGrade($request),
            'Deleted'
        );
    }

    public function createOrUpdateLocationPreference(CreateStudentLocationPreference $request)
    {
        if($request->student_id !== auth()->user()->student?->id){
            return $this->error('', 'Unauthorized', 403);
        }
        return $this->success([
            'preference' => $this->createOrUpdateLocationPreference($request)
        ]);
    }

    public function deleteLocationPreference(IdRequest $request)
    {
        $preference = StudentLocationPreference::query()
            ->where('id', '=', $request->id)
            ->firstOrFail();

        if($preference->student_id !== auth()->user()->student?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        return $this->success([
            $this->studentService->deleteLocationPreference($request),
            'Deleted'
        ]);
    }

    public function getAllApplications(IdRequest $request)
    {
        if($request->id !== auth()->user()->student?->id){
            return $this->error('', 'Unauthorized', 403);
        }
        return $this->success([
            'applications' => $this->studentService->getAllApplications($request)
        ]);
    }

    public function getApplication(IdRequest $request)
    {
        $application = $this->studentService->getApplication($request);
        if(!$application){
            return $this->error('', 'No student found', 404);
        }

        if($application->student_id !== auth()->user()->student?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        return $this->success([
            'application' => $application
        ]);
    }

    public function applyForPosition(CreateResidencyPositionApplication $request)
    {
        if($request->student_id !== auth()->user()->student?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        return $this->success([
            'application' => $this->studentService->applyForPosition($request)
        ]);
    }
}
