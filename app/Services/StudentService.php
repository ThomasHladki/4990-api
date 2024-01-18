<?php
use App\Models\ResidencyPositionApplication;
use App\Models\ResidencyPositionMatch;
use App\Models\Student;
use App\Models\StudentGrade;
use App\Models\StudentLocationPreference;


class StudentService {
    public function getStudent(int $id): Student|null
    {
        /** @var Student|null $student */
        $student = Student::query()
            ->where("id",'=', $id)
            ->first();

        return $student;
    }

    public function createStudent(CreateStudentRequest $request): bool
    {
        return Student::query()
            ->insert([
                'name' => $request->name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'graduation_year' => $request->graduation_year,
                'educational_institution_id' => $request->educational_institution_id,
                'medical_discipline' => $request->medical_discipline,
                'prefers_research' => $request->prefers_research,
            ]);
    }

    public function getGrades(int $studentId): array
    {
        return StudentGrade::query()
            ->where('student_id', '=', $studentId)
            ->get();
    }

    public function getLocationPreference(int $studentId): StudentLocationPreference|null
    {
        /** @var StudentLocationPreference|null $preference */
        $preference = StudentLocationPreference::query()
            ->where('student_id', '=', $studentId)
            ->first();
        return $preference;
    }

    public function getMatches(int $studentId): array
    {
        return ResidencyPositionMatch::query()
            ->where('student_id', '=', $studentId)
            ->orderBy('match_score', 'DESC')
            ->get();
    }

    public function createStudentGrade(CreateStudentGradeRequest $request): bool
    {
        return StudentGrade::query()
            ->insert([
                'student_id' => $request->student_id,
                'course_code' => $request->course_code,
                'grade' => $request->grade
            ]);
    }

    public function deleteStudentGrade(int $studentGradeId): bool
    {
        return StudentGrade::query()
            ->where('id', '=', $studentGradeId)
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
            $preference = StudentLocationPreference::query()
                ->insert([
                    'student_id' => $request->student_id,
                    'has_preference' => true,
                    'preferred_province' => $request->preffered_province,
                    'preferred_city' => $request->preferred_city
                ]);
        }else{
            $preference = StudentLocationPreference::query()
                ->insert([
                    'student_id' => $request->student_id,
                    'has_preference' => false,
                    'preferred_province' => null,
                    'preferred_city' => null
                ]); 
        }
        return $preference;
    }

    public function deleteLocationPreference(int $studentId): bool
    {
        return StudentLocationPreference::query()
            ->where('student_id', '=', $studentId)
            ->delete();
    }

    public function getAllApplications(int $studentId): array
    {
        return ResidencyPositionApplication::query()
            ->where('student_id', '=', $studentId)
            ->get();

    }

    public function getApplication(int $id): ResidencyPositionApplication|null
    {
        /** @var ResidencyPositionApplication|null $application */
        $application = ResidencyPositionApplication::query()
            ->where('id', '=', $id)
            ->first();

        return $application;
    }



    public function applyForPosition(CreateResidencyPositionApplication $request): bool
    {
        return ResidencyPositionApplication::query()
            ->insert([
                'student_id' => $request->student_id,
                'residency_position_id' => $request->residency_position_id,
                'message' => $request->message
            ]);
    }

}