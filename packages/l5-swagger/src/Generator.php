<?php

namespace Mi\L5Swagger;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;
use Mi\L5Swagger\Parameters\PathParameter;
use Mi\L5Swagger\Parameters\QueryParameter;
use Mi\L5Swagger\Processors\RequestProcessor;
use Mi\L5Swagger\Processors\SchemaProcessor;
use Mi\L5Swagger\Processors\TagProcessor;
use Mi\L5Swagger\Schemas\Info;
use Mi\L5Swagger\Schemas\OpenAPI;
use Mi\L5Swagger\Schemas\Operation;
use Mi\L5Swagger\Schemas\Path;
use Mi\L5Swagger\Schemas\RequestBody;
use Mi\L5Swagger\Schemas\Response;
use Mi\L5Swagger\Schemas\Server;
use ReflectionMethod;
use Mi\L5Swagger\Schemas\SecurityScheme;
use Illuminate\Support\Optional;
use Mi\L5Swagger\Types\ArrayType;

class Generator
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var \Illuminate\Support\Collection|null
     */
    protected $filters;

    /**
     * @var \Illuminate\Routing\RouteCollection
     */
    protected $routes;

    /**
     * @var \Mi\L5Swagger\Schemas\OpenAPI
     */
    protected $openapi;

    /**
     * @var array
     */
    protected $securities;

    public function __construct(
        Router $router,
        OpenAPI $openapi
    ) {
        $this->openapi    = $openapi;
        $this->config     = config('l5-swagger');
        $this->routes     = collect($router->getRoutes()->getRoutes());
        $this->securities = array_keys(config('l5-swagger')['securitySchemes']);
        // dd($this->config);
    }

    public function handle($prefix = null)
    {
        $this->addHeaderFromConfig($prefix);

        $filterred = $this->getRouteByPrefix($prefix);

        $this->parseRoutes($filterred);

        return $this->openapi->toArray();
    }

    /**
     * Get route by prefix
     *
     * @param string $prefix
     * @return \Illuminate\Support\Collection
     */
    protected function getRouteByPrefix($prefix = null)
    {
        if (! empty($prefix)) {
            return $this->routes->filter(function ($route) use ($prefix) {
                return preg_match('/' . preg_quote($prefix, '/') . '/', $route->uri());
            });
        }
        return $this->routes;
    }

    protected function addHeaderFromConfig(string $prefix = '')
    {
        $this->openapi->openapi = $this->config['openapi'];
        $this->openapi->info = new Info(
            $this->config['title'] . '.' . $prefix,
            $this->config['appVersion']
        );
        $this->openapi->addServer(new Server($this->config['url']));

        if (! empty($this->config['securitySchemes'])) {
            foreach ($this->config['securitySchemes'] as $k => $v) {
                $this->openapi->addSecurityScheme($k, new SecurityScheme($v));
            }
        }

        return $this;
    }

    /**
     * Parse routes to Swagger
     *
     * @param \Illuminate\Support\Collection $routes
     * @return void
     */
    protected function parseRoutes($routes)
    {
        $routes->groupBy(function ($route) {
            return $route->uri();
        })->each(function ($paths, $key) {
            $this->parsePaths($key, $paths);
        });
    }

    /**
     * Parse path on swagger
     *
     * @param string $pathName
     * @param \Illuminate\Support\Collection $paths
     * @return void
     */
    protected function parsePaths($pathName, $paths)
    {
        $path = new Path();

        $paths->each(function ($route) use (&$path) {
            $path->addOperation(strtolower($route->methods()[0]), $this->parseOperation($route));
        });

        $this->openapi->addPath($pathName, $path);
    }

    /**
     * Parse operation to Swagger
     *
     * @param \Illuminate\Routing\Route $route
     * @return \Mi\L5Swagger\Schemas\Operation
     */
    protected function parseOperation($route)
    {
        $operation              = new Operation();
        $operation->method      = $route->methods()[0];
        $operation->operationId = $route->getName();
        $operation->addResponse('default', new Response());
        $operation->addTag(TagProcessor::parseTag($route->getName()));

        $middlewares = $route->gatherMiddleware();
        foreach ($this->securities as $s) {
            if (in_array($s, $middlewares)) {
                $operation->addSecurity($s);
            }
        }

        $this->addPathParameters($operation, $route->parameterNames());

        $action = Str::parseCallback($route->getActionName());
        $parameters = (new ReflectionMethod($action[0], $action[1]))->getParameters();

        $this->addQueryParameters($operation, $parameters);

        return $operation;
    }

    protected function addPathParameters(&$operation, array $params)
    {
        foreach ($params as $p) {
            $operation->addParameter(new PathParameter(['name' => $p]));
        }
    }

    protected function addQueryParameters(&$operation, array $params)
    {
        Optional::macro('isSwagger', function () { return true; });
        Optional::macro('getName', function () { return 'mock'; });

        foreach ($params as $p) {
            $class = (string) $p->getType();

            if (is_subclass_of($class, FormRequest::class)) {
                $request = (new $class)->setUserResolver(function () {
                    return optional();
                })->setRouteResolver(function () {
                    return optional();
                });

                $rules = array_map(function ($v) {
                    return is_array($v) ? implode('|', $v) : $v;
                }, $request->rules());

                if ($operation->isGetRequest()) {
                    foreach ($rules as $k => $v) {
                        if (! is_null($schema = SchemaProcessor::ruleToSchema($k, $v, $rules))) {
                            // GET request need [] after array, eg: course_ids[]=1&course_ids[]=2
                            $appendix = $schema instanceof ArrayType ? '[]' : '';

                            $q = new QueryParameter(['name' => $k . $appendix]);
                            $q->required = $schema->required;
                            $q->schema   = $schema;

                            $operation->addParameter($q);
                        }
                    }
                } else {
                    $r = new RequestBody();
                    $r->accept = RequestProcessor::detectRequestAccept($rules);

                    foreach ($rules as $k => $v) {
                        $schema = SchemaProcessor::ruleToSchema($k, $v, $rules);

                        if (! is_null($schema)) {
                            if ($schema->required) {
                                $r->addRequired($k);
                            }

                            $appendix = $r->isFormDataRequest() && $schema instanceof ArrayType ? '[]' : '';
                            $r->addSchema($k . $appendix, $schema);
                        }
                    }

                    if ($r->hasSchema()) {
                        $operation->addRequestBody($r);
                    }
                }
            }
        }
    }
}
