<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\Topic\ListTopicRequest;
use App\Services\Topic\ListTopicService;
use App\Http\Resources\Topic\TopicCollection;
use App\Http\Resources\Topic\TopicResource;

class TopicController extends Controller
{
    /**
     * @var ListTopicService
     */
    protected $listService;

    public function __construct(
        ListTopicService $listService
    ) {
        $this->listService = $listService;
    }

    public function index(ListTopicRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new TopicCollection($items));
    }
}
