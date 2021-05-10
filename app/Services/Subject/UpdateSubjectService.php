<?php

namespace App\Services\Subject;

use Ky\Core\Services\BaseService;
use App\Repositories\SubjectRepository;
use App\Services\PrepareDataTrait;

class UpdateSubjectService extends BaseService
{
    use PrepareDataTrait;

    protected $collectsData = true;

    /**
     * @var SubjectRepository
     */
    protected $repository;

    public function __construct(SubjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->prepareCreatedBy();

        $this->model->fill($this->data->toArray());
        $this->model->save();

        return $this->model;
    }
}
