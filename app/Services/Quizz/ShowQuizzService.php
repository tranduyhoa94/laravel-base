<?php

namespace App\Services\Quizz;

use App\Repositories\QuizzRepository;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;

class ShowQuizzService extends BaseService
{
    /** @var QuizzRepository */
    protected $repository;

    /**
     * @var boolean
     */
    protected $collectsData = true;

    public function __construct(QuizzRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->repository->pushCriteria(new WithRelationsCriteria(
            $this->data->get('with'),
            $this->repository->getAllowRelations()
        ));

        return $this->repository->find($this->model);
    }
}
