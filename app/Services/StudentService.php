<?php
use App\Models\Student;


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
        $student = Student::insert([
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
}