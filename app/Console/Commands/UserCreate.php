<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\User;

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
    protected $description = 'Create new user';

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
        $userData = [
            'name' => $this->ask('Name:'),
            'email' => $this->ask('E-Mail Address:'),
            'password' => $this->secret('Password:'),
            'password_confirmation' => $this->secret('Confirm Password:')
        ];

        $validate = $this->validator($userData);

        if ($validate->fails()) {
            $this->printErrors($validate->errors()->all());

            exit(1);
        }


        if ($this->confirm('Do you wish to create user? [y|N]')) {
            $this->create($userData);

            $this->info('User was successfully created');
        }
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function printErrors(array $errors)
    {
        foreach ($errors as $error) {
            $this->error($error);
        }
    }
}
