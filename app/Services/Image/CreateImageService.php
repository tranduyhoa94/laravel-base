<?php

namespace App\Services\Image;

use Ky\Core\Services\BaseService;
use App\Repositories\ImageRepository;
use App\Services\UploadS3Trait;
use Image;

class CreateImageService extends BaseService
{
    use UploadS3Trait;

    protected $collectsData = true;

    /**
     * @var ImageRepository
     */
    protected $repository;

    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $avatar = $this->data->get('file');
        $extension = $this->data->get('file')->getClientOriginalExtension();

        $filename = time();

        $normal = Image::make($avatar)->resize(320, 320)->encode($extension);
        $medium = Image::make($avatar)->resize(160, 160)->encode($extension);
        $fullSize = Image::make($avatar)->encode($extension);

        $this->uploadImageS3('images/normal/'.$filename, (string)$normal);
        $this->uploadImageS3('images/medium/'.$filename, (string)$medium);
        $this->uploadImageS3('images/full/'.$filename, (string)$fullSize);

        $this->data->put('path', $filename);

        return $this->repository->create($this->data->toArray());
    }
}
