<?php

namespace App\Services\Admin;

use App\Exceptions\AdminsException;
use App\Services\HelperServiceTrait;
use Ky\Core\Services\BaseService;
use App\Repositories\AdminRepository;

class ActiveAdminServices extends BaseService
{
    protected $collectsData = true;

    use HelperServiceTrait;

    /**
     * @var \App\Repositories\AdminRepository
     */
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        if (!$this->isSuperAdmin()) {
            return $this->model->fill([
                'is_active' => !$this->model->is_active
            ])->save();
        }

        throw AdminsException::notUpdateAdmin();
    }
}
