<?php

namespace App\Services\Admin;

use App\Jobs\SendPassMail;
use App\Services\HelperServiceTrait;
use Ky\Core\Services\BaseService;
use App\Repositories\AdminRepository;

class CreateAdminService extends BaseService
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
        $password = $this->generatePassword();
        $this->data->put('password', $password);
        $item = $this->repository->create($this->data->toArray());
        dispatch(new SendPassMail($this->data->get('email'), $password));

        return $item;
    }
}
