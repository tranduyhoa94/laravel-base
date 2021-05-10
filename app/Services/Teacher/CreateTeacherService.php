<?php

namespace App\Services\Teacher;

use App\Jobs\SendPassMail;
use App\Repositories\TeacherRepository;
use App\Services\HelperServiceTrait;
use Ky\Core\Services\BaseService;

class CreateTeacherService extends BaseService
{
    use HelperServiceTrait;

    protected $collectsData = true;

    /**
     * @var TeacherRepository
     */
    protected $repository;

    public function __construct(TeacherRepository $repository)
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
