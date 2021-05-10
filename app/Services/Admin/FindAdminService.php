<?php

namespace App\Services\Admin;

use App\Repositories\AdminRepository;
use Ky\Core\Services\BaseService;

class FindAdminService extends BaseService
{
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
        return $this->repository->find($this->model);
    }
}
