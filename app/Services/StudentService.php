<?php
use App\Http\Requests\CreateResidencyPositionApplication;
use App\Http\Requests\CreateStudentGradeRequest;
use App\Http\Requests\CreateStudentLocationPreference;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\IdRequest;
use App\Models\ResidencyPositionApplication;
use App\Models\ResidencyPositionMatch;
use App\Models\Student;
use App\Models\StudentGrade;
use App\Models\StudentLocationPreference;


class StudentService {
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
        return Student::create([
                'name' => $request->name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'graduation_year' => $request->graduation_year,
                'educational_institution_id' => $request->educational_institution_id,
                'medical_discipline' => $request->medical_discipline,
                'prefers_research' => $request->prefers_research,
            ]);
    }

    public function getGrades(IdRequest $request): array
    {
        return StudentGrade::query()
            ->where('student_id', '=', $request->id)
            ->get();
    }

    public function getLocationPreference(IdRequest $request): StudentLocationPreference|null
    {
        /** @var StudentLocationPreference|null $preference */
        $preference = StudentLocationPreference::query()
            ->where('student_id', '=', $request->id)
            ->first();
        return $preference;
    }

    public function getMatches(IdRequest $request): array
    {
        return ResidencyPositionMatch::query()
            ->where('student_id', '=', $request->id)
            ->orderBy('match_score', 'DESC')
            ->get();
    }

    public function createStudentGrade(CreateStudentGradeRequest $request): StudentGrade
    {
        return StudentGrade::create([
                'student_id' => $request->student_id,
                'course_code' => $request->course_code,
                'grade' => $request->grade
            ]);
    }

    public function deleteStudentGrade(IdRequest $request): bool
    {
        return StudentGrade::query()
            ->where('id', '=', $request->id)
            ->delete();
    }

    public function createOrUpdateLocationPreference(CreateStudentLocationPreference $request): bool
    {
        if(StudentLocationPreference::query()->where('student_id', '=', $request->student_id)->exists()){
            StudentLocationPreference::query()
            ->where('student_id', '=', $request->student_id)
            ->delete();
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
        return $preference;
    }

    public function deleteLocationPreference(IdRequest $request): bool
    {
        return StudentLocationPreference::query()
            ->where('student_id', '=', $request->id)
            ->delete();
    }

    public function getAllApplications(IdRequest $request): array
    {
        return ResidencyPositionApplication::query()
            ->where('student_id', '=', $request->id)
            ->get();

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
        return ResidencyPositionApplication::create([
                'student_id' => $request->student_id,
                'residency_position_id' => $request->residency_position_id,
                'message' => $request->message
            ]);
    }

}