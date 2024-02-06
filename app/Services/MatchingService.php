<?php
 
namespace App\Services;

use App\Models\ResidencyPosition;
use App\Models\ResidencyPositionGrade;
use App\Models\Student;
use App\Models\StudentGrade;
use App\Models\StudentLocationPreference;
use App\Models\MedicalInstitution;
use Carbon\Carbon;

class MatchingService{



    public function assignMatchScore(int $student_id, int $position_id): int
    {
        /** @var Student $student */
        $student = Student::query()
            ->where('id', '=', $student_id)
            ->firstOrFail();
        
        /** @var ResidencyPosition $position */
        $position = ResidencyPosition::query()
            ->where('id', '=', $position_id)
            ->firstOrFail();

        $score = 0;
        $gradeAverage = 0.0;
        $studentGrades = $student->studentGradesGrades()->get()->all();

        $gradeSum = 0;
        $count = 0;

        foreach($studentGrades as $studentGrade){
            /** @var StudentGrade $studentGrade */
            $count++;
            $gradeSum+= $studentGrade->grade;
        }

        if($count > 0){
            $gradeAverage = $gradeSum/$count;
        }

        if($gradeAverage < $position->grade_avg_requirement){
            return -1;
        }


        if(($position->residencyPositionGrades()->count()) > 0 && ($student->studentGrades()->count() > 0)){
            $positionCourseCodes = [];
            $positionGrades = $position->residencyPositionGrades()->get()->all();
            
            foreach($positionGrades as $positionGrade){
                /** @var ResidencyPositionGrade $positionGrade */
                $positionCourseCodes[strtolower($positionGrade->course_code)] = true;
            }
            
            foreach($studentGrades as $studentGrade){
                /** @var StudentGrade $studentGrade */
                if(isset($positionCourseCodes[strtolower($studentGrade->course_code)]) && strtolower($studentGrade->course_code) >= 50){
                    $score++;
                }
            }
        }

        if($position->research_focused && $student->prefers_research){
            $score += 3;
        }

        if($student->studentLocationPreference()->exists()){
            /** @var StudentLocationPreference $preference */
            $preference = $student->studentLocationPreference()->first();
            /** @var MedicalInstitution $institution */
            $institution = $position->medicalInstitution()->first();

            if($preference->has_preference && strtolower($preference->preferred_city) === strtolower($institution->city) && strtolower($preference->preffered_province) === strtolower($institution->province)){
                $score += 2;
            }
        }

        if($position->prefers_new_grads && (Carbon::now()->year - $student->graduation_year <= 1)){
            $score += 3;
        }   
        
        if(strtolower($position->medical_discipline) !== strtolower($student->medical_discipline)){
            return -1;
        }
    }
}