<?php

namespace App\Services;

trait HelperStudentTrait
{
    public function getInfoStudent($email)
    {
        return $this->studentRepository->scopeQuery(function ($query) use ($email) {
            return $query->where('email', $email)
                ->where('is_active', 1);
        })->first();
    }
}
