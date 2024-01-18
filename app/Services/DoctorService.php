<?php
use App\Models\Doctor;

class DoctorService {

    public function getDoctor(int $doctorId): Doctor|null
    {
        /** */
        $doctor = Doctor::query()
            ->where('id', '=', $doctorId)
            ->first();

        return $doctor;
    }

    public function createDoctor(CreateDoctorRequest $request): bool
    {
        return Doctor::query()
            ->insert([
                'name' => $request->name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'medical_institution_id' => $request->medical_institution_id,
                'medical_discipline' => $request->medical_discipline,
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
}