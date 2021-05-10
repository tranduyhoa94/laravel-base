<?php

namespace App\Services\Appointment;

use App\Criteria\TeacherScopeCriteria;
use App\Repositories\AppointmentRepository;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;
use Ky\Core\Criteria\FilterCriteria;
use App\Criteria\StudentScopeCriteria;
use Ky\Core\Criteria\OrderCriteria;

class ListAppointmentServices extends BaseService
{
    protected $collectsData = true;

    /**
     * @var AppointmentRepository
     */
    protected $repository;

    public function __construct(AppointmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->data->put(
            'with',
            $this->data->has('with') ?  $this->data->get('with') . ',slots'
            : 'slots'
        );

        $this->repository
            ->pushCriteria(new TeacherScopeCriteria($this->handler))
            ->pushCriteria(new StudentScopeCriteria($this->handler))
            ->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()))
            ->pushCriteria(new OrderCriteria($this->data->get('order')))
            ->pushCriteria(new WithRelationsCriteria(
                $this->data->get('with'),
                $this->repository->getAllowRelations()
            ))
        ;

        if ($this->data->has('teacher_id') && $this->data->get('teacher_id') === null) {
            $this->repository->scopeQuery(function ($query) {
                return $query->where('teacher_id', null);
            });
        }

        return $this->data->has('per_page') ?
            $this->repository->paginate($this->getPerPage()) :
            $this->repository->all();
    }

    public function getAllowFilters()
    {
        return [
            'teacher_id',
            'status'
        ];
    }
}
