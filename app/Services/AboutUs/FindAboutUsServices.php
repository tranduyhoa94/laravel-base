<?php

namespace App\Services\AboutUs;

use App\Repositories\AboutUsRepository;
use Ky\Core\Services\BaseService;

class FindAboutUsServices extends BaseService
{
    protected $collectsData = true;

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
        return $this->repository->first();
    }
}
