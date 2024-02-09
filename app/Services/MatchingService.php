<?php
 
namespace App\Services;

use App\Models\ResidencyPosition;
use App\Models\ResidencyPositionGrade;
use App\Models\ResidencyPositionMatch;
use App\Models\Student;
use App\Models\StudentGrade;
use App\Models\StudentLocationPreference;
use App\Models\MedicalInstitution;
use Carbon\Carbon;

class MatchingService{



    private function assignMatchScore(int $student_id, int $position_id): int
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

        if($position->letter_of_reccomendation_req && !$student->has_letter_of_req){
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

        return $score;
    }

    public function matchOnStudentUpdate(int $student_id){
        ResidencyPositionMatch::query()
            ->where('student_id', '=', $student_id)
            ->delete();

        $query = ResidencyPosition::query()
            ->where('status', '=', ResidencyPosition::STATUS_OPEN);

        $cursorPaginator = $query->cursorPaginate(100);
        
        do{
            foreach($cursorPaginator->items() as $position){
                /** @var ResidencyPosition $position */
                $this->createMatch($student_id, $position->id);
            }

            $cursorPaginator = $query->cursorPaginate(perPage: 100, cursor: $cursorPaginator->nextCursor());
        }while($cursorPaginator->hasPages());

        return;
    }

    public function matchOnPositionUpdate(int $position_id){
        ResidencyPositionMatch::query()
            ->where('residency_position_id', '=', $position_id)
            ->delete();

        $query = Student::query();

        $cursorPaginator = $query->cursorPaginate(100);
        
        do{
            foreach($cursorPaginator->items() as $student){
                /** @var Student $student */
                $this->createMatch($student->id, $position_id);
            }

            $cursorPaginator = $query->cursorPaginate(perPage: 100, cursor: $cursorPaginator->nextCursor());
        }while($cursorPaginator->hasPages());

        return;
    }

    private function createMatch(int $student_id, int $position_id){
        $score = $this->assignMatchScore($student_id, $position_id);
        if($score !== -1){
            ResidencyPositionMatch::create([
                'student_id' => $student_id,
                'residency_position_id' => $position_id,
                'match_score' => $score
                ]);
        }
        return;
    }
}