<?php

namespace App\Jobs;

use App\Http\Controllers\MailController;
use App\Models\Response;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ResponseNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $response;
    protected $auth;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($response_id, $user_id, $auth_user)
    {
        $this->response = Response::find($response_id);
        $this->user = User::find($user_id);
        $this->auth = $auth_user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        MailController::newResponse($this->response, $this->user, $this->auth);
    }
}
