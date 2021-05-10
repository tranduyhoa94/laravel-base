<?php

namespace App\Services\Subject;

use App\Repositories\SubjectRepository;
use Ky\Core\Services\BaseService;

class ActiveSubjectServices extends BaseService
{
    protected $collectsData = true;

    /**
     * @var \App\Repositories\SubjectRepository
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
        return $this->model->fill([
            'is_active' => !$this->model->is_active
        ])->save();
    }
}
