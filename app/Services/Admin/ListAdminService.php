<?php

namespace App\Services\Admin;

use App\Repositories\AdminRepository;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Services\BaseService;

class ListAdminService extends BaseService
{
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
        $this->data->put('is_super_admin', 0);
        $this->repository->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()));
        return $this->repository->paginate($this->getPerPage());
    }

    public function getAllowFilters()
    {
        return [
            'name',
            'email',
            'is_active',
            'is_super_admin',
        ];
    }
}
