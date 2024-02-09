<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\CreateEducationalInstitutionRequest;
use App\Http\Requests\CreateResidencyPositionGradeRequest;
use App\Http\Requests\CreateResidencyPositionRequest;
use App\Http\Requests\IdRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Requests\UpdateResidencyPositionRequest;
use App\Models\ResidencyPosition;
use App\Models\ResidencyPositionApplication;
use App\Models\ResidencyPositionGrade;
use App\Services\DoctorService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    use HttpResponses;

    private DoctorService $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function getDoctor(IdRequest $request){
        return $this->success([
            'doctor' => $this->doctorService->getDoctor($request)
        ]);
    }

    public function createDoctor(CreateDoctorRequest $request){
        $status = $this->doctorService->createDoctor($request);
        if($status){
            return $this->success('Created');
        }

        return $this->error('Could not create', 'Request failed', 400);
    }

    public function getMedicalInstitutions(){
        return $this->success([
            'institutions' => $this->doctorService->getMedicalInstitutions()
        ]);
    }

    public function createMedicalInstitution(CreateEducationalInstitutionRequest $request){
        return $this->success([
            'insitution' => $this->doctorService->createMedicalInstitution($request)
        ]);
    }

    public function updateDoctor(UpdateDoctorRequest $request){

        if($request->id !== auth()->user()->doctor?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        $status = $this->doctorService->updateDoctor($request);
        if($status){
            return $this->success('Updated');
        }

        return $this->error('Could not update', 'Request failed', 400);
    }

    public function viewResidencyPositions(IdRequest $request){
        if($request->id !== auth()->user()->doctor?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        return $this->success([
            'positions' => $this->doctorService->viewResidencyPositions($request)
        ]);
    }

    public function viewApplicationsForPosition(IdRequest $request)
    {
        /** @var ResidencyPosition $position */
        $position = ResidencyPosition::query()
            ->where('id', '=', $request->id)
            ->firstOrFail();

        if($position->doctor->id !== auth()->user()->doctor?->id){
            return $this->error('', 'Unauthorized', 403);
        }
        return $this->success([
            'applications' => $this->doctorService->viewApplicationsForPosition($request)
        ]);
    }

    public function viewAllApplications(IdRequest $request)
    {
        if($request->id !== auth()->user()->doctor?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        return $this->success([
            'applications' => $this->doctorService->viewAllApplications($request)
        ]);
    }

    public function createResidencyPosition(CreateResidencyPositionRequest $request)
    {
        if($request->doctor_id != auth()->user()->doctor?->id){
            return $this->error('', 'Unauthorized', 403);
        }
 
        return $this->success([
            'position' => $this->doctorService->createResidencyPosition($request)
        ]);
    }

    public function viewPositionGrades(IdRequest $request)
    {
        /** @var ResidencyPosition $position */
        $position = ResidencyPosition::query()
            ->where('id', '=', $request->id)
            ->firstOrFail();

        if($position->doctor->id !== auth()->user()->doctor?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        return $this->success([
            'position_grades' => $this->doctorService->viewPositionGrades($request)
        ]);
    }

    public function createResidencyPositionGrade(CreateResidencyPositionGradeRequest $request)
    {
         /** @var ResidencyPosition $position */
         $position = ResidencyPosition::query()
         ->where('id', '=', $request->residency_position_id)
         ->firstOrFail();

        if($position->doctor->id !== auth()->user()->doctor?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        return $this->success([
            'position_grade' => $this->doctorService->createResidencyPositionGrade($request)
        ]);
    }

    public function deletePositionGrade(IdRequest $request)
    {
        /** @var ResidencyPositionGrade $grade */
        $grade = ResidencyPositionGrade::query()
            ->where('id', '=', $request->id)
            ->firstOrFail();
        
        if($grade->residencyPosition->doctor->id !== auth()->user()->doctor?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        $this->doctorService->deletePositionGrade($request);
        return $this->success('deleted');
    }

    public function updateResidencyPosition(UpdateResidencyPositionRequest $request)
    {
        /** @var ResidencyPosition $position */
        $position = ResidencyPosition::query()
            ->where('id', '=', $request->id)
            ->firstOrFail();

        if($position->doctor->id !== auth()->user()->doctor?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        $update = $this->doctorService->updateResidencyPosition($request);
        if(!$update){
            return $this->error('', 'Update failed', 400);
        }

        return $this->success($update);
    }

    public function closePosition(IdRequest $request)
    {
        /** @var ResidencyPosition $position */
        $position = ResidencyPosition::query()
            ->where('id', '=', $request->id)
            ->firstOrFail();
            
        if($position->doctor->id !== auth()->user()->doctor?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        $position = $this->doctorService->closePosition($request);
        if(!$position){
            return $this->error('', 'No position found', 404);
        }

        return $this->success([
            'position' => $position,
        ], 'Status closed');
    }

    public function openPosition(IdRequest $request){
        /** @var ResidencyPosition $position */
        $position = ResidencyPosition::query()
            ->where('id', '=', $request->id)
            ->firstOrFail();
            
        if($position->doctor->id !== auth()->user()->doctor?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        $position = $this->doctorService->openPosition($request);
        if(!$position){
            return $this->error('', 'No position found', 404);
        }

        return $this->success([
            'position' => $position,
        ], 'Status opened');
    }

    public function rejectApplicant(IdRequest $request)
    {
        /** @var ResidencyPositionApplication $application */
        $application = ResidencyPositionApplication::query()
            ->where('id', '=', $request->id)
            ->firstOrFail();

        if($application->residencyPosition->doctor->id !== auth()->user()->doctor?->id){
            return $this->error('', 'Unauthorized', 403);
        }

        $application = $this->doctorService->rejectApplicant($request);
        if(!$application){
            return $this->error('', 'No application found', 404);
        }

        return $this->success([
            'position' => $application,
        ], 'Applicant rejected');
    }

    public function acceptApplicant(IdRequest $request)
    {
        $application = $this->doctorService->acceptApplicant($request);
        if(!$application){
            return $this->error('', 'No application found', 404);
        }

        return $this->success([
            'position' => $application,
        ], 'Applicant accepted');
    }
}
