<?php

namespace App\Services\Quizz;

use App\Filters\StatusQuiz;
use App\Filters\TypeQuizzes;
use App\Repositories\QuizzRepository;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;
use App\Models\Quizz;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Criteria\OrderCriteria;

class ListQuizzService extends BaseService
{
    /** @var QuizzRepository */
    protected $repository;

    /** @var \App\Models\Teacher */
    protected $handler;

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
        $this->addScopeForTeacher();
        $this->addScopeForAdmin();
        $this->addScopeForStudent();

        $this->repository->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()));

        $this->repository->pushCriteria(new WithRelationsCriteria(
            $this->data->get('with'),
            $this->repository->getAllowRelations()
        ));

        $this->repository->pushCriteria(new OrderCriteria($this->data->get('order')));

        return $this->data->has('per_page') ?
            $this->repository->paginate($this->getPerPage()) :
            $this->repository->all();
    }

    /**
     * Add query if handler = teacher
     * @return null|mixed
     */
    private function addScopeForTeacher()
    {
        if (!$this->handler->isTeacher()) {
            return null;
        }

        $this->repository->applyScope();
        $this->repository->scopeQuery(function ($query) {
            return $query->where(function ($q) {
                return $q->where('createdable_id', $this->handler->id)
                            ->where('createdable_type', get_class($this->handler));
            });
        });
    }

    /**
     * Add query if handler = admin
     * @return null|mixed
     */
    private function addScopeForAdmin()
    {
        if (!$this->handler->isAdmin()) {
            return null;
        }

        $this->repository->applyScope();
        $this->repository->scopeQuery(function ($query) {
            return $query->where(function ($q) {
                return $q->whereIn('status', [Quizz::STATUS_SUBMITED, Quizz::STATUS_APPROVED])
                            ->orWhere(function ($q) {
                                return $q->where('createdable_id', $this->handler->id)
                                            ->where('createdable_type', get_class($this->handler));
                            });
            });
        });
    }

    /**
     * Add query if handler = student
     * @return null|mixed
     */
    private function addScopeForStudent()
    {
        if (!$this->handler->isStudent()) {
            return null;
        }

        $this->repository->applyScope();
        return $this->repository->scopeQuery(function ($query) {
            return $query->where('status', Quizz::STATUS_APPROVED);
        });
    }

    private function getAllowFilters()
    {
        return [
            'status' => StatusQuiz::class,
            'topic_id',
            'type' => TypeQuizzes::class
        ];
    }
}
