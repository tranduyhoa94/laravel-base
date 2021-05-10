<?php

namespace App\Services\Auth;

use App\Repositories\AdminRepository;
use Ky\Core\Services\BaseService;
use App\Exceptions\LoginException;
use App\Concerns\Token;

class AdminLoginService extends BaseService
{
    const IS_ACTIVE = '1';

    /**
     * @var \App\Repositories\AdminRepository
     */
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->data['is_active'] = self::IS_ACTIVE;

        $token = Token::make('admin', 'attempt', $this->data);

        if (!$token->getToken()) {
            throw LoginException::invalidCredentials();
        }

        return $token;
    }
}
