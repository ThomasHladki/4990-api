<?php

namespace App\Services;

use App\Http\Requests\CreateResidencyPositionApplication;
use App\Http\Requests\CreateStudentGradeRequest;
use App\Http\Requests\CreateStudentLocationPreference;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\IdRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\EducationalInstitution;
use App\Models\ResidencyPosition;
use App\Models\ResidencyPositionApplication;
use App\Models\ResidencyPositionMatch;
use App\Models\Student;
use App\Models\StudentGrade;
use App\Models\StudentLocationPreference;

class StudentService {

    private MatchingService $matchingService;

    public function __construct(MatchingService $matchingService)
    {
        $this->matchingService = $matchingService;
    }
    public function getStudent(IdRequest $request): Student|null
    {
        /** @var Student|null $student */
        $student = Student::query()
            ->where("id",'=', $request->id)
            ->first();

        return $student;
    }

    public function createStudent(CreateStudentRequest $request): Student
    {
        $student = Student::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'graduation_year' => $request->graduation_year,
            'educational_institution_id' => $request->educational_institution_id,
            'medical_discipline' => $request->medical_discipline,
            'prefers_research' => $request->prefers_research,
            'user_id' => $request->user_id,
            'has_letter_of_req' => $request->has_letter_of_req
        ]);

        $this->matchingService->matchOnStudentUpdate($student->id);

        return $student;
    }

    public function getEducationalInstitutions(){
        return EducationalInstitution::query()
            ->get();
    }

    public function updateStudent(UpdateStudentRequest $request){
        /** @var Student $student */
        $student = Student::query()
            ->where('id', '=', $request->id)
            ->firstOrFail();

        if($request->name){
            $student->name = $request->name;
        }

        if($request->dob){
            $student->dob = $request->dob;
        }

        if($request->gender){
            $student->gender = $request->gender;
        }

        if($request->graduation_year){
            $student->graduation_year = $request->graduation_year;
        }

        if($request->educational_institution_id){
            $student->educational_institution_id = $request->educational_institution_id;
        }

        if($request->medical_discipline){
            $student->medical_discipline = $request->medical_discipline;
        }

        if($request->prefers_research){
            $student->prefers_research = $request->prefers_research;
        }

        if($request->has_letter_of_req){
            $student->has_letter_of_req = true;
        }else{
            $student->has_letter_of_req = false;
        }

        $student->save();

        $this->matchingService->matchOnStudentUpdate($student->id);
        return $student;
    }   

    public function getGrades(IdRequest $request): array
    {
        return StudentGrade::query()
            ->where('student_id', '=', $request->id)
            ->get()->toArray();
    }

    public function getLocationPreference(IdRequest $request): StudentLocationPreference|null
    {
        /** @var StudentLocationPreference|null $preference */
        $preference = StudentLocationPreference::query()
            ->where('student_id', '=', $request->id)
            ->first();
        return $preference;
    }

    public function getMatches($studentId): array
    {
        return ResidencyPosition::query()
            ->whereDoesntHave('residencyPositionApplications', function($q) use ($studentId){
                $q->where('student_id', '=', $studentId);
            })
            ->whereHas('residencyPositionMatches', function($q) use ($studentId){
                $q->where('student_id', '=', $studentId)
                    ->orderBy('match_score', 'DESC');
            })
            ->get()
            ->toArray();
    }

    public function createStudentGrade(CreateStudentGradeRequest $request): StudentGrade
    {
        $grade = StudentGrade::create([
                'student_id' => $request->student_id,
                'course_code' => $request->course_code,
                'grade' => $request->grade
            ]);

        $this->matchingService->matchOnStudentUpdate($request->student_id);
        return $grade;
    }

    public function deleteStudentGrade(IdRequest $request)
    {
        $query = StudentGrade::query()
            ->where('id', '=', $request->id);

        /** @var StudentGrade $grade */
        $grade = $query->first();

        $this->matchingService->matchOnStudentUpdate($grade->student_id);

        return $query->delete();
    }

    public function createOrUpdateLocationPreference(CreateStudentLocationPreference $request): bool
    {
        $existingPref = StudentLocationPreference::query()->where('student_id', '=', $request->student_id);
        if($existingPref->exists()){
            $existingPref->delete();
        }

        /** @var bool $preference */
        if($request->has_preference){
            $preference = StudentLocationPreference::create([
                    'student_id' => $request->student_id,
                    'has_preference' => true,
                    'preferred_province' => $request->preffered_province,
                    'preferred_city' => $request->preferred_city
                ]);
        }else{
            $preference = StudentLocationPreference::create([
                    'student_id' => $request->student_id,
                    'has_preference' => false,
                    'preferred_province' => null,
                    'preferred_city' => null
                ]); 
        }

        $this->matchingService->matchOnStudentUpdate($request->student_id);
        return $preference;
    }

    public function deleteLocationPreference(IdRequest $request)
    {
        $delete = StudentLocationPreference::query()
            ->where('student_id', '=', $request->id)
            ->delete();

        $this->matchingService->matchOnStudentUpdate($request->id);
        return $delete;
    }

    public function getAllApplications($studentId): array
    {
        /* return ResidencyPositionApplication::query()
            ->where('student_id', '=', $request->id)
            ->get(); */
        /* return ResidencyPositionApplication::query()
            ->where('student_id', $studentId)
            ->get()
            ->toArray(); */
        return ResidencyPositionApplication::with('residencyPosition')
            ->where('student_id', '=', $studentId)
            ->get()
            ->toArray();

    }

    public function getApplication(IdRequest $request): ResidencyPositionApplication|null
    {
        /** @var ResidencyPositionApplication|null $application */
        $application = ResidencyPositionApplication::query()
            ->where('id', '=', $request->id)
            ->first();

        return $application;
    }

    public function applyForPosition(CreateResidencyPositionApplication $request): bool
    {
        /* return ResidencyPositionApplication::create([
                'student_id' => $request->student_id,
                'residency_position_id' => $request->residency_position_id,
                'message' => $request->message
            ]); */
        $application = ResidencyPositionApplication::create([
            'student_id' => $request->student_id,
            'residency_position_id' => $request->residency_position_id,                
            'message' => $request->message,
            'status' => ResidencyPositionApplication::STATUS_OPEN
        ]);
        
            // Check if the application was successfully created
            return $application != null;
    }
}