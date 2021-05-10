<?php

namespace App\Concerns;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Auth;

/**
 * @method self tokenById($id)
 * @method self attempt($data)
 * @method self fromUser($user)
 */
class Token implements Arrayable
{
    /**
     * Default TTL is 7 days
     */
    const DEFAULT_TTL = '7 days';

    const LOGIN_SUPER_ADMIN_ID = 'login_super_admin_id';

    const USE_IN_MAINTENANCE = 'use_in_maintenance';

    /**
     * @var string
     */
    protected $guard;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $type = 'bearer';

    /**
     * @var \Carbon\CarbonInterface
     */
    protected $expiry;

    /**
     * @var array
     */
    protected $claims = [];

    /**
     * @var mixed
     */
    protected $metadata = [
        // self::USE_IN_MAINTENANCE => false
    ];

    public function __construct(string $guard)
    {
        $this->guard = $guard;
        $this->expiry = $this->guessExpiryByGuard($guard);
    }

    /**
     * Make new token
     *
     * @param string $guard
     * @param string $method
     * @param mixed $data
     * @return \App\Concerns\Token
     */
    public static function make(string $guard, string $method, $data = null)
    {
        $instance = new static($guard);
        $instance->token = Auth::guard($guard)->claims([
            'exp' => $instance->expiry
        ])->$method($data);

        return $instance;
    }

    /**
     * Set additional data
     *
     * @param array $metadata
     * @return self
     */
    public function setMetadata($metadata)
    {
        $this->metadata = array_merge($this->metadata, $metadata);

        return $this;
    }

    /**
     * Get generated token
     *
     * @return string|bool|null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Check that token is exits
     *
     * @return bool
     */
    public function notExists()
    {
        return !$this->token;
    }

    /**
     * Guess expiry by guard
     *
     * @param string $guard
     * @return \Carbon\CarbonInterface
     */
    public function guessExpiryByGuard(string $guard)
    {
        return now()->add(config('auth.guards.' . $guard .  '.ttl') ?? self::DEFAULT_TTL);
    }

    /**
     * Return data as array
     *
     * @return array
     */
    public function toArray()
    {
        return array_merge([
            'access_token' => $this->token,
            'token_type'   => $this->type,
            'expires_at'   => $this->expiry->toIso8601String()
        ], $this->metadata);
    }

    /**
     * Generate token
     *
     * @param string $method
     * @param mixed $data
     * @return self
     */
    public function generateToken(string $method, $data = null)
    {
        $this->token = Auth::guard($this->guard)
            ->claims(array_merge($this->claims, ['exp' => $this->expiry]))
            ->$method(...$data);

        return $this;
    }

    public function __call($name, $arguments)
    {
        if (!in_array($name, ['tokenById', 'attempt', 'refresh', 'fromUser'])) {
            throw new \BadMethodCallException($name . ' is not defined in ' . get_class($this));
        }

        return $this->generateToken($name, $arguments);
    }
}
