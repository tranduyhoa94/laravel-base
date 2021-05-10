<?php

namespace Mi\L5Swagger\Schemas;

use Mi\L5Swagger\AbstractSchema;

class OpenAPI extends AbstractSchema
{
    /**
     * @var string
     */
    protected $openapi;

    /**
     * @var \Mi\L5Swagger\Schemas\Info
     */
    protected $info;

    /**
     * @var \Mi\L5Swagger\Schemas\Server[]
     */
    protected $servers;

    /**
     * @var \Mi\L5Swagger\Schemas\Path[]
     */
    protected $paths;

    /**
     * @var \Mi\L5Swagger\Schemas\SecurityScheme[]
     */
    protected $securitySchemes;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $result = $this->only(
            'openapi',
            'info',
            'servers',
            'paths'
        );

        if (! empty($this->securitySchemes)) {
            $result['components']['securitySchemes'] = $this->getAttribute('securitySchemes');
        }

        return $result;
    }

    /**
     * Add new server
     *
     * @param \Mi\L5Swagger\Schemas\Server $server
     * @return self
     */
    public function addServer(Server $server)
    {
        $this->servers[] = $server;

        return $this;
    }

    /**
     * Add new path
     *
     * @param string $path
     * @param \Mi\L5Swagger\Schemas\Path $server
     * @return self
     */
    public function addPath(string $pathName, Path $path)
    {
        $this->paths['/' . $pathName] = $path;

        return $this;
    }

    public function addSecurityScheme(string $name, SecurityScheme $scheme)
    {
        $this->securitySchemes[$name] = $scheme;

        return $this;
    }
}
