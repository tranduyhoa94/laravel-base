<?php

namespace App\Services\Slot;

use App\Filters\StudentIdSlots;
use App\Filters\TeacherIdSlots;
use App\Repositories\SlotRepository;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;

class ListSlotsService extends BaseService
{
    protected $collectsData = true;

    /** @var \App\Models\Teacher */
    protected $handler;

    public function __construct(SlotRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        if ($this->handler->isTeacher()) {
            $this->data->put('teacher_id', $this->handler->id);
            $this->data->put('with', 'appointment');
        }

        if ($this->handler->isStudent()) {
            $this->data->put('student_id', $this->handler->id);
            $this->data->put('with', 'appointment');
        }

        $this->repository->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()));
        $this->repository->pushCriteria(new WithRelationsCriteria(
            $this->data->get('with'),
            $this->repository->getAllowRelations()
        ));

        return $this->repository->all();
    }

    public function getAllowFilters()
    {
        return [
            'teacher_id' => TeacherIdSlots::class,
            'start_time_gte',
            'start_time_lte',
            'end_time_gte',
            'end_time_lte',
            'student_id' => StudentIdSlots::class
        ];
    }
}
