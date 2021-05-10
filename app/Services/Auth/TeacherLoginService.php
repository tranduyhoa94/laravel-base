<?php

namespace App\Services\Auth;

use App\Repositories\TeacherRepository;
use Ky\Core\Services\BaseService;
use App\Exceptions\LoginException;
use App\Concerns\Token;

class TeacherLoginService extends BaseService
{
    const IS_ACTIVE = '1';

    /**
     * @var \App\Repositories\TeacherRepository
     */
    protected $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->data['is_active'] = self::IS_ACTIVE;

        $token = Token::make('teacher', 'attempt', $this->data);

        if (!$token->getToken()) {
            throw LoginException::invalidCredentials();
        }

        return $token;
    }
}
