<?php

namespace App\Services\Admin;

use App\Repositories\AdminRepository;
use App\Services\HelperServiceTrait;
use Ky\Core\Services\BaseService;
use App\Exceptions\AdminsException;

class DeleteAdminService extends BaseService
{
    use HelperServiceTrait;

    protected $collectsData = false;

    /**
     * @var AdminRepository
     */
    protected $repository;

    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        if (!$this->isSuperAdmin()) {
            return $this->model->delete();
        }
        throw AdminsException::notDeleteAdmin();
    }
}
