<?php

namespace App\Services\Account\Student;

use App\Repositories\AboutUsRepository;
use App\Repositories\StudentRepository;
use App\Services\HelperServiceTrait;
use Ky\Core\Services\BaseService;
use App\Jobs\SendMailWelcome;

class RegisterStudentService extends BaseService
{
    use HelperServiceTrait;

    protected $collectsData = true;

    /**
     * @var StudentRepository
     */
    protected $repository;

    /**
     * @var AboutUsRepository
     */
    protected $aboutUsrepository;

    public function __construct(StudentRepository $repository, AboutUsRepository $aboutUsrepository)
    {
        $this->repository = $repository;
        $this->aboutUsrepository = $aboutUsrepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->data->put('password', \Hash::make($this->data->get('password')));
        $this->repository->create($this->data->toArray());
        dispatch(new SendMailWelcome($this->data->get('email'), $this->aboutUsrepository->first()));
    }
}
