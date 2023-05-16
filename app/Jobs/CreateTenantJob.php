<?php

namespace App\Jobs;

use App\Domains\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $request;
    public $tenant;

    public function __construct($request,$tenant)
    {
        $this->request = $request;
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->tenant->run(function () {
            User::create([
                'name' => $this->request['name'],
                'email' => $this->request['email'],
                'password' => bcrypt($this->request['password']??123456),
            ]);
        });
    }
}
