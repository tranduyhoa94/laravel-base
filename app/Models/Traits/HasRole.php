<?php

namespace App\Models\Traits;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;

trait HasRole
{
    public function isAdmin():bool
    {
        return $this instanceof Admin;
    }

    public function isTeacher():bool
    {
        return $this instanceof Teacher;
    }

    public function isStudent():bool
    {
        return $this instanceof Student;
    }
}
