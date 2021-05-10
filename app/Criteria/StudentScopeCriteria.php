<?php

namespace App\Criteria;

use Ky\Core\Contracts\CriteriaInterface;
use Ky\Core\Contracts\RepositoryInterface;
use App\Models\Student;

class StudentScopeCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $handler;

    /**
     * Instance of ClientScopeCriteria
     *
     * @param \Illuminate\Database\Eloquent\Model $handler
     */
    public function __construct($handler)
    {
        $this->handler = $handler;
    }

    /**
     * Apply criteria in query repository
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param RepositoryInterface $repository
     * @return mixed
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->handler instanceof Student) {
            $model = $model->where(function ($query) use ($model) {
                return $query->where($model->qualifyColumn('student_id'), $this->handler->id);
            });
        }

        return $model;
    }
}
