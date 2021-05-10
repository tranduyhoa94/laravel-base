<?php

namespace App\Services\Me;

use App\Exceptions\AdminsException;
use Ky\Core\Services\BaseService;

class UpdateProfileService extends BaseService
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
            return $class::where('email', $this->handler->email)
                ->update([
                    'name' => $this->data->get('name')
                ]);
        }

        return $class::where('email', $this->handler->email)
            ->update([
                'name' => $this->data->get('name'),
                'phone' => $this->data->get('phone'),
                'gender' => $this->data->get('gender'),
                'address' => $this->data->get('address')
            ]);
    }
}
