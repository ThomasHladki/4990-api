<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResidencyPositionApplication;
use App\Http\Requests\CreateStudentGradeRequest;
use App\Http\Requests\CreateStudentLocationPreference;
use App\Http\Requests\IdRequest;
use App\Services\StudentService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;


class StudentController extends Controller
{

    use HttpResponses;
    private StudentService $studentService;

    public function __construct(StudentService $studentService){
        $this->StudentService = $studentService;
    }


    public function getStudent(IdRequest $request)
    {
        $student = $this->studentService->getStudent($request);

        if(!$student){
            return $this->error('', 'No student found', 404);
        }
        return $this->success([
            'student' => $student
        ]);
    }

    public function getGrades(IdRequest $request)
    {
        $this->success([
            'grades' => $this->studentService->getGrades($request)
        ]);
    }

    public function getMatches(IdRequest $request)
    {
        $this->success([
            'matches' => $this->studentService->getMatches($request)
        ]);
    }

    public function createStudentGrade(CreateStudentGradeRequest $request)
    {
        return $this->success([
            'grade' => $this->studentService->createStudentGrade($request)
        ]);
    }

    public function deleteStudentGrade(IdRequest $request)
    {
        return $this->success(
            $this->studentService->deleteStudentGrade($request),
            'Deleted'
        );
    }

    public function createOrUpdateLocationPreference(CreateStudentLocationPreference $request)
    {
        $this->success([
            'preference' => $this->createOrUpdateLocationPreference($request)
        ]);
    }

    public function deleteLocationPreference(IdRequest $request)
    {
        return $this->success([
            $this->studentService->deleteLocationPreference($request),
            'Deleted'
        ]);
    }

    public function getAllApplications(IdRequest $request)
    {
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

        return $this->success([
            'application' => $application
        ]);
    }

    public function applyForPosition(CreateResidencyPositionApplication $request)
    {
        return $this->success([
            'application' => $this->studentService->applyForPosition($request)
        ]);
    }
}
