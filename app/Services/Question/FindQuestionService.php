<?php

namespace App\Services\Question;

use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;
use App\Repositories\QuestionRepository;

class FindQuestionService extends BaseService
{
    protected $collectsData = true;

    /**
     * @var QuestionRepository
     */
    protected $repository;

    public function __construct(QuestionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->repository->pushCriteria(new WithRelationsCriteria(
            'answers',
            $this->repository->getAllowRelations()
        ));

        return $this->repository->find($this->model);
    }
}
