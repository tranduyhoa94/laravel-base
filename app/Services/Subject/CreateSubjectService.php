<?php

namespace App\Services\Subject;

use App\Services\PrepareDataTrait;
use Ky\Core\Services\BaseService;
use App\Repositories\SubjectRepository;
use Illuminate\Support\Facades\DB;

class CreateSubjectService extends BaseService
{
    use PrepareDataTrait;

    protected $collectsData = true;

    /**
     * @var SubjectRepository
     */
    protected $repository;

    public function __construct(SubjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->prepareCreatedBy();

        return DB::transaction(function () {
            /** @var \App\Models\Subject */
            $subject = $this->repository->create($this->data->toArray());

            if ($this->data->has('topics')) {
                $topics = $this->transformTopics($subject);
                $subject->topics()->insert($topics);
            }

            return $subject;
        });
    }

    private function transformTopics($subject)
    {
        $now = now();
        return array_map(function ($topic) use ($subject, $now) {
            return [
                'name' => $topic,
                'subject_id' => $subject->id,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }, $this->data->get('topics'));
    }
}
