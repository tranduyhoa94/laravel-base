<?php

namespace App\Services\Auth;

use App\Repositories\StudentRepository;
use Ky\Core\Services\BaseService;
use App\Exceptions\LoginException;
use App\Concerns\Token;

class StudentLoginService extends BaseService
{

    /**
     * @var \App\Repositories\StudentRepository
     */
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $token = Token::make('student', 'attempt', $this->data);

        if (!$token->getToken()) {
            throw LoginException::invalidCredentials();
        }

        return $token;
    }
}
