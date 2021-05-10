<?php

namespace App\Services\QuizSesstion;

use App\Repositories\QuizSessionRepository;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Criteria\OrderCriteria;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;

class ListQuizSessionService extends BaseService
{
    protected $collectsData = true;

    /** @var \App\Models\Teacher
     * \App\Models\Admin
     * \App\Models\Student
     */
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
        // $this->addScopeForTeacher();
        // $this->addScopeForAdmin();
        $this->addScopeForStudent();

        $this->repository
            ->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()))
            ->pushCriteria(new OrderCriteria($this->data->get('order')))
            ->pushCriteria(new WithRelationsCriteria(
                $this->data->get('with'),
                $this->repository->getAllowRelations()
            ));

        return $this->data->has('per_page') ?
            $this->repository->paginate($this->getPerPage()) :
            $this->repository->all();
    }

    // /**
    //  * Add query if handler = teacher
    //  * @return null|mixed
    //  */
    // public function addScopeForTeacher()
    // {
    //     if (!$this->handler->isTeacher()) {
    //         return null;
    //     }

    //     $this->repository->applyScope();
    //     $this->repository->scopeQuery(function ($query) {
    //         return $query->where('teacher_id', $this->handler->id);
    //     });
    // }

    // /**
    //  * Add query if handler = admin
    //  * @return null|mixed
    //  */
    // private function addScopeForAdmin()
    // {
    //     if (!$this->handler->isAdmin()) {
    //         return null;
    //     }

    //     $this->repository->applyScope();
    //     $this->repository->scopeQuery(function ($query) {
    //         return $query->whereNotNull('submited_at');
    //     });
    // }

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

    public function getAllowFilters()
    {
        return [
            'teacher_id',
            'student_id'
        ];
    }
}
