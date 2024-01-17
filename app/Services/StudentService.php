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

    public function createStudent(CreateStudentRequest $request){

    }
}