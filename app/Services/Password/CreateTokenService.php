<?php

namespace App\Services\Password;

use App\Services\HelperServiceTrait;
use Ky\Core\Services\BaseService;
use App\Jobs\SendPassMail;

class CreateTokenService extends BaseService
{
    use HelperServiceTrait;

    protected $collectsData = true;

    protected $model;


    public function __construct()
    {
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $password = $this->generatePassword();
        $class = app($this->model);
        $class::where('email', $this->data->get('email'))->update(['password' => \Hash::make($password)]);
        dispatch(new SendPassMail($this->data->get('email'), $password));
    }
}
