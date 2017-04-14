<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UserCreate extends Command
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
     * @return mixed
     */
    public function handle()
    {

        $this->warn('Keep in mind there is no input validation');

        $user = new \App\User;
        $user->name = $this->ask('Name:');
        $user->email = $this->ask('E-Mail Address:');

        $user->password = bcrypt(
            $this->secret('Password:')
        );

        // Confirm registration

        if ($this->confirm('Do you wish to create user? [y|N]')) {
            $user->save();

            $this->info('I hope user was successfully created');

        }
    }
}
