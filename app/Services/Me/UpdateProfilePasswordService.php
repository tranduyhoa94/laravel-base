<?php

namespace App\Services\Me;

use App\Exceptions\AdminsException;
use Ky\Core\Services\BaseService;

class UpdateProfilePasswordService extends BaseService
{
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
        $class = app($this->model);
        if (optional($this->handler)->isAdmin()) {
            if ($this->handler->is_super_admin) {
                throw AdminsException::notUpdateAdmin();
            }
        }

        return $class::where('email', $this->handler->email)
            ->update([
                'password' => \Hash::make($this->data->get('new_password'))
            ]);
    }
}
