<?php

namespace App\Console\Commands;

use App\Models\User; // Убедитесь, что модель User импортирована
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'user:create {email} {name}';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');
        $name = $this->argument('name') ?? $this->ask('Введіть імʼя користувача');

        if (User::where('email', $email)->exists()) {
            $this->error("Користувач з email '{$email}' вже існує.");
            return Command::FAILURE;
        }

        $password = $this->secret('Введіть пароль для нового користувача');

        if (strlen($password) < 8) {
            $this->error('Пароль має містити не менше ніж 8 символів.');
            return Command::FAILURE;
        }

        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

            $this->info("Користувач '{$user->name}' (ID: {$user->id}) успішно створено!");
            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('Не вдалося створити користувача, перевірте конфігурацію Бази даних');
            $this->line($e->getMessage());
            return Command::FAILURE;
        }
    }
}
