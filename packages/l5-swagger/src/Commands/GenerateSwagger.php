<?php

namespace Mi\L5Swagger\Commands;

use Illuminate\Console\Command;
use Mi\L5Swagger\Generator;

class GenerateSwagger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger:gen {--prefix=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Swagger docs for the application';

    /**
     * @var \Mi\L5Swagger\Generator
     */
    protected $generator;

    public function __construct(Generator $generator)
    {
        parent::__construct();

        $this->generator = $generator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $swagger = $this->generator->handle($this->option('prefix'));

        $this->line(json_encode($swagger));
    }
}
