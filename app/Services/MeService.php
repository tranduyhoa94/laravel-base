<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Ky\Core\Services\BaseService;

class MeService extends BaseService
{
    /**
     * Logic to handle the data
     */
    public function handle()
    {
        return Auth::user()->toArray();
    }
}
