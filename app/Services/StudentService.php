<?php
use App\Models\ResidencyPositionMatch;
use App\Models\Student;
use App\Models\StudentGrade;
use App\Models\StudentLocationPreference;


class StudentService{


    public function getStudent(int $id): Student|null
    {
        /** @var Student|null $student */
        $student = Student::query()
            ->where("id",'=', $id)
            ->first();

        return $student;
    }

    public function createStudent(CreateStudentRequest $request): Student
    {
        /** @var Student $student */
        $student = Student::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'graduation_year' => $request->graduation_year,
            'educational_institution_id' => $request->educational_institution_id,
            'medical_discipline' => $request->medical_discipline,
            'prefers_research' => $request->prefers_research,
        ]);

        return $student;
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

    public function createStudentGrade(CreateStudentGradeRequest $request): StudentGrade
    {
        return StudentGrade::create([
            'student_id' => $request->student_id,
            'course_code' => $request->course_code,
            'grade' => $request->grade
        ])
            
    }

}