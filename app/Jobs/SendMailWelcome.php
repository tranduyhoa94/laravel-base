<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailWelcome;

class SendMailWelcome implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $aboutUs;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $about_us)
    {
        $this->email = $email;
        $this->aboutUs = $about_us;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email, env('MAIL_FROM_NAME'))->send(new MailWelcome($this->aboutUs));
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function failed(Exception $exception)
    {
        // some thing error
    }
}
