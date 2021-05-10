<?php

namespace App\Services\Admin;

use App\Repositories\AdminRepository;
use App\Services\HelperServiceTrait;
use Ky\Core\Services\BaseService;
use App\Exceptions\AdminsException;

class UpdateAdminService extends BaseService
{
    use HelperServiceTrait;

    protected $collectsData = true;

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
        $this->model->fill($this->data->toArray());
        if ($this->isSuperAdmin() && $this->model->isDirty('email')) {
            throw AdminsException::notUpdateAdmin();
        }
        $this->model->save();

        return $this->model;
    }
}
