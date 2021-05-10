<?php

namespace App\Services;

trait HelperServiceTrait
{
    public function generatePassword()
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');

        return substr($random, 0, 10);
    }

    public function isSuperAdmin()
    {
        return $this->model->is_super_admin;
    }
}
