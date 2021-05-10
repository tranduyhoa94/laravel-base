<?php

namespace App\Services\SubjectTaken;

use App\Criteria\StudentScopeCriteria;
use App\Repositories\SubjectRepository;
use App\Repositories\SubjectTakenRepository;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Services\BaseService;

class ListSubjectTakenService extends BaseService
{
    /**
     * @var SubjectTakenRepository
     */
    protected $repository;

    /**
     * @var SubjectRepository
     */
    protected $subjectRepository;

    protected $collectsData = true;

    public function __construct(SubjectTakenRepository $repository, SubjectRepository $subjectRepository)
    {
        $this->repository = $repository;
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->repository->pushCriteria(new StudentScopeCriteria($this->handler));
        
        $subjectTaken = $this->repository->all()->pluck('subject_id')->toArray();

        return $this->subjectRepository->scopeQuery(function ($query) use ($subjectTaken) {
            return $query->whereIn('id', $subjectTaken)
                ->where('is_active', 1)
                ->has('topics');
        })->all();
    }

    public function getAllowFilters()
    {
        return [
            'student_id'
        ];
    }
}
