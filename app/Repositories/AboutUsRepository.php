<?php

namespace App\Repositories;

use Ky\Core\Repositories\BaseRepository;
use App\Models\AboutUs;

class AboutUsRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return AboutUs::class;
    }
}
