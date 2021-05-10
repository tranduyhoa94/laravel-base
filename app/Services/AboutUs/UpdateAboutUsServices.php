<?php

namespace App\Services\AboutUs;

use App\Repositories\AboutUsRepository;
use Ky\Core\Services\BaseService;

class UpdateAboutUsServices extends BaseService
{
    /**
     * @var AboutUsRepository
     */
    protected $repository;

    public function __construct(AboutUsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->model->fill($this->data);
        $this->model->save();

        return $this->model;
    }
}
