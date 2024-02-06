<?php

namespace App\Services;

use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\CreateEducationalInstitutionRequest;
use App\Http\Requests\CreateResidencyPositionGradeRequest;
use App\Http\Requests\CreateResidencyPositionRequest;
use App\Http\Requests\IdRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Requests\UpdateResidencyPositionRequest;
use App\Models\Doctor;
use App\Models\EducationalInstitution;
use App\Models\MedicalInstitution;
use App\Models\ResidencyPosition;
use App\Models\ResidencyPositionApplication;
use App\Models\ResidencyPositionGrade;

class DoctorService {

    private MatchingService $matchingService;

    public function __construct(MatchingService $matchingService)
    {
        $this->matchingService = $matchingService;
    }

    public function getDoctor(IdRequest $request): Doctor|null
    {
        /** @var Doctor|null $doctor */
        $doctor = Doctor::query()
            ->where('id', '=', $request->id)
            ->first();

        return $doctor;
    }

    public function createDoctor(CreateDoctorRequest $request): Doctor
    {
        return Doctor::create([
                'name' => $request->name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'medical_institution_id' => $request->medical_institution_id,
                'medical_discipline' => $request->medical_discipline,
                'user_id' =>$request->user_id
            ]);
    }

    public function getMedicalInstitutions(){
        return MedicalInstitution::query()
            ->get();
    }

    public function createMedicalInstitution(CreateEducationalInstitutionRequest $request){
        return EducationalInstitution::create([
            'name' => $request->name,
            'medical_school_name' => $request->medical_school_name,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'email_domain' => $request->email_domain
        ]);
    }

    public function updateDoctor(UpdateDoctorRequest $request): bool
    {
        /** @var Doctor|null $doctor */
        $doctor = Doctor::query()
            ->where('id', '=', $request->id)
            ->first();

        if(!$doctor){
            return false;
        }

        if($request->name){
            $doctor->name = $request->name;
        }
        if($request->dob){
            $doctor->dob = $request->dob;
        }
        if($request->gender){
            $doctor->gender = $request->gender;
        }
        if($request->medical_institution_id){
            $doctor->medical_institution_id = $request->medical_institution_id;
        }
        if($request->medical_discipline){
            $doctor->medical_discipline = $request->medical_discipline;
        }

        return $doctor->save();
    }

    public function viewResidencyPositions(IdRequest $request): array
    {
        return ResidencyPosition::query()
            ->where('doctor_id', '=', $request->id)
            ->get();
    }

    public function viewApplicationsForPosition(IdRequest $request)
    {
        //$request->id for position id in this case
        return ResidencyPositionApplication::query()
            ->where('residency_position_id', '=', $request->id)
            ->get();
    }

    public function viewAllApplications(IdRequest $request)
    {
        //$request->id for doctor id in this case
        return ResidencyPositionApplication::query()
            ->whereHas('residencyPosition', function($query) use ($request){
                $query->where('doctor_id', '=', $request->id);
            });
    }

    public function createResidencyPosition(CreateResidencyPositionRequest $request)
    {
        $position = ResidencyPosition::create([
                'name' => $request->name, 
                'status' => ResidencyPosition::STATUS_OPEN, 
                'description' => $request->description, 
                'medical_discipline' => $request->medical_discipline, 
                'doctor_id' => $request->doctor_id, 
                'medical_institution_id' => $request->medical_institution_id, 
                'grade_avg_requirement' => $request->grade_avg_requirement, 
                'letter_of_reccomendation_req' => $request->letter_of_reccomendation_req, 
                'research_focused' => $request->research_focused, 
                'prefers_new_grads' => $request->prefers_new_grads, 
            ]);
        $this->matchingService->matchOnPositionUpdate($position->id);
        return $position;
    }

    public function viewPositionGrades(IdRequest $request)
    {
        return ResidencyPositionGrade::query()
            ->where('residency_position_id', '=', $request->id)
            ->get();
    }

    public function createResidencyPositionGrade(CreateResidencyPositionGradeRequest $request)
    {
        $grade = ResidencyPositionGrade::create([
            'residency_position_id' => $request->residency_position_id,
            'course_code' => $request->course_code,
        ]);

        $this->matchingService->matchOnPositionUpdate($request->residency_position_id);
        return $grade;
    }

    public function deletePositionGrade(IdRequest $request)
    {
        $query = ResidencyPositionGrade::query()
            ->where('id', '=', $request->id);

        /** @var ResidencyPositionGrade $grade */
        $grade = $query->first();
        $this->matchingService->matchOnPositionUpdate($grade->residency_position_id);
        
        return $query->delete();
    }

    public function updateResidencyPosition(UpdateResidencyPositionRequest $request)
    {
        /** @var ResidencyPosition|null $position */
        $position = ResidencyPosition::query()
            ->where('id', '=', $request->id)
            ->first();

        if(!$position){
            return null;
        }

        if($request->name){
            $position->name = $request->name;
        }

        if($request->description){
            $position->description = $request->description;
        }

        if($request->medical_discipline){
            $position->medical_discipline = $request->medical_discipline;
        }

        if($request->medical_institution_id){
            $position->medical_institution_id = $request->medical_institution_id;
        }

        if($request->grade_avg_requirement){
            $position->grade_avg_requirement = $request->grade_avg_requirement;
        }

        if($request->letter_of_reccomendation_req){
            $position->letter_of_reccomendation_req = $request->letter_of_reccomendation_req;
        }
        
        if($request->research_focused){
            $position->research_focused = $request->research_focused;
        }

        if($request->prefers_new_grads){
            $position->prefers_new_grads = $request->prefers_new_grads;
        }

        $position->save();
        $this->matchingService->matchOnPositionUpdate($position->id);
        return $position;
    }

    public function closePosition(IdRequest $request)
    {
        $position = ResidencyPosition::query()
            ->where('id', '=', $request->id)
            ->first();

        if(!$position){
            return null;
        }

        $position->status = ResidencyPosition::STATUS_CLOSED;
        $position->save();
        return $position;
    }

    public function openPosition(IdRequest $request)
    {
        $position = ResidencyPosition::query()
            ->where('id', '=', $request->id)
            ->first();

        if(!$position){
            return null;
        }

        $position->status = ResidencyPosition::STATUS_OPEN;
        $position->save();
        return $position;
    }

    public function rejectApplicant(IdRequest $request)
    {
        $application = ResidencyPositionApplication::query()
            ->where('id', '=', $request->id)
            ->first();

        if(!$application){
            return null;
        }

        $application->status = ResidencyPositionApplication::STATUS_REJECTED;
        $application->save();
        return $application;
    }

    public function acceptApplicant(IdRequest $request)
    {
        $application = ResidencyPositionApplication::query()
            ->where('id', '=', $request->id)
            ->first();

        if(!$application){
            return null;
        }

        $application->status = ResidencyPositionApplication::STATUS_ACCEPTED;
        $application->save();
        return $application;
    }

    
}