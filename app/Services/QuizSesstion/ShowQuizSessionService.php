<?php

namespace App\Services\QuizSesstion;

use App\Repositories\QuizSessionRepository;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;

class ShowQuizSessionService extends BaseService
{
    protected $collectsData = true;

    /** @var \App\Models\Student */
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
        $this->addScopeForStudent();

        $this->repository->pushCriteria(new WithRelationsCriteria(
            $this->data->get('with'),
            $this->repository->getAllowRelations()
        ));

        return $this->repository->find($this->model);
    }

    /**
     * Add query if handler = student
     * @return null|mixed
     */
    public function addScopeForStudent()
    {
        if (!$this->handler->isStudent()) {
            return null;
        }

        $this->repository->applyScope();
        $this->repository->scopeQuery(function ($query) {
            return $query->where('student_id', $this->handler->id);
                // ->where('is_completed', true);
        });
    }
}
