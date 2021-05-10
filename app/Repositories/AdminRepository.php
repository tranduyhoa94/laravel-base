<?php

namespace App\Repositories;

use Ky\Core\Repositories\BaseRepository;
use App\Models\Admin;

class AdminRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Admin::class;
    }
}
