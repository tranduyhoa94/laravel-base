<?php

namespace App\Repositories;

use App\Models\DeviceToken;
use Ky\Core\Repositories\BaseRepository;

class DeviceTokenRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return DeviceToken::class;
    }
}
