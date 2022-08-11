<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\RegisterMailNotify;

class RegisterMailler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $code;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data, $code)
    {
        $this->data = $data;
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->data['email'])->send(new RegisterMailNotify($this->data, $this->code));
    }
}