<?php

namespace App\Services\QuizSesstion;

use App\Repositories\QuizSessionRepository;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;

class FindQuizSessionService extends BaseService
{
    protected $collectsData = true;

    /** @var \App\Models\Teacher */
    protected $handler;

    /**
     * @var QuizSessionRepository
     */
    protected $repository;

    public function __construct(QuizSessionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
//        $this->addScopeForTeacher();

        $this->repository->pushCriteria(new WithRelationsCriteria(
            $this->data->get('with'),
            $this->repository->getAllowRelations()
        ));

        return $this->repository->find($this->model);
    }

//    /**
//     * Add query if handler = teacher
//     * @return null|mixed
//     */
//    public function addScopeForTeacher()
//    {
//        if (!$this->handler->isTeacher()) {
//            return null;
//        }
//
//        $this->repository->applyScope();
//        $this->repository->scopeQuery(function ($query) {
//            return $query->where('teacher_id', $this->handler->id);
//        });
//    }
}
