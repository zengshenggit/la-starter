<?php

namespace App\Console\Commands;

use App\Models\User as ModelsUser;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class User extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = ModelsUser::factory()->definition()['email'];
        if (ModelsUser::where('email', $email)->exists()) {
            return $this->warn(sprintf('The user %s aready exists !', $email));
        }
        if (($user = ModelsUser::factory()->create())) {
            Role::create(['name' => 'Super Admin']);
            $user->assignRole('Super Admin');
            return $this->info(sprintf('The user %s created successfully !', $user->name));
        }

        return 0;
    }
}
