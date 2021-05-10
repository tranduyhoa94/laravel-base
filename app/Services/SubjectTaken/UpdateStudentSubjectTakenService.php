<?php

namespace App\Services\SubjectTaken;

use App\Repositories\SubjectTakenRepository;
use Ky\Core\Services\BaseService;

class UpdateStudentSubjectTakenService extends BaseService
{
    /**
     * @var SubjectTakenRepository
     */
    protected $repository;

    /**
     * @var \App\Models\Student
     */
    protected $model;

    protected $collectsData = true;

    public function __construct(SubjectTakenRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $subjects = $this->model->subjectsTaken();

        $oldSubjects = $subjects->pluck('id')->toArray();
        sort($oldSubjects);

        $data = $this->data->get('ids');
        sort($data);

        if ($oldSubjects == $data) {
            return ;
        }

        $subjects->delete();

        $newSubjectsTaken = $this->transformSubjectTaken();

        $this->repository->insert($newSubjectsTaken);

        return;
    }

    public function transformSubjectTaken()
    {
        return array_map(function ($value) {
            return [
                'subject_id' => $value,
                'student_id' => $this->model->id
            ];
        }, $this->data->get('ids'));
    }
}
