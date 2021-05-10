<?php

namespace Mi\L5Swagger\Schemas;

use Mi\L5Swagger\AbstractSchema;
use Mi\L5Swagger\Parameters\AbstractParameter;

class Operation extends AbstractSchema
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string|null
     */
    protected $operationId;

    /**
     * @var Mi\L5Swagger\Schemas\Reponse[]
     */
    protected $responses;

    /**
     * @var Mi\L5Swagger\Schemas\Parameter[]
     */
    protected $parameters;

    /**
     * @var Mi\L5Swagger\Schemas\RequestBody[]
     */
    protected $requestBody;

    /**
     * @var array
     */
    protected $tags = [];

    /**
     * @var array
     */
    protected $security = [];

    public function toArray()
    {
        $result = $this->only('operationId', 'security', 'tags', 'responses', 'parameters');

        if (null !== ($r = $this->getAttribute('requestBody'))) {
            $result['requestBody'] = [
                'content' => $r
            ];
        }

        return $result;
    }

    /**
     * Add new response
     *
     * @param string|int $statusCode
     * @param \Mi\L5Swagger\Schemas\Response|\Mi\L5Swagger\Schemas\Reference $response
     * @return self
     */
    public function addResponse($statusCode, $response)
    {
        $this->responses[$statusCode] = $response;

        return $this;
    }

    /**
     * Add new parameter
     *
     * @param \Mi\L5Swagger\Parameters\AbstractParameter
     * @return self
     */
    public function addParameter(AbstractParameter $parameter)
    {
        $this->parameters[] = $parameter;

        return $this;
    }

    public function addRequestBody(RequestBody $requestBody)
    {
        $this->requestBody[$requestBody->accept] = $requestBody;

        return $this;
    }

    public function isGetRequest()
    {
        return in_array($this->method, ['get', 'GET']);
    }

    public function addTag($name)
    {
        $this->tags[] = $name;

        return $this;
    }

    public function addTags(array $tags)
    {
        $this->tags = array_merge($this->tags, $tags);

        return $this;
    }

    public function addSecurity(string $name)
    {
        $this->security[] = [
            $name => []
        ];

        return $this;
    }
}
