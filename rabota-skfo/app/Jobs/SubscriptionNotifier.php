<?php

namespace App\Jobs;

use App\Http\Controllers\MailController;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SubscriptionNotifier implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $org;
    protected $vacancy;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($org_id, $vacancy_id)
    {
        $this->org = $org_id;
        $this->vacancy = $vacancy_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subscriptions = Subscription::where("target_type", 'org')->where("target_id", $this->org)->get();
        if($subscriptions != null){
            $to_list = array();
            foreach($subscriptions as $item){
                $user = User::find($item->user_id);
                if($user != null){
                    $to_list[] = $user->email;
                }
            }
            if(count($to_list) != 0){
                MailController::notifyNewVacancy($to_list, $this->vacancy);
            }
        }
    }
}
