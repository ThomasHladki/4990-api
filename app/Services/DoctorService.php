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
}