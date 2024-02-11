<?php

namespace App\Models;

use App\Core\Application;
use App\Core\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    #[\Override] public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addErrorForRule('email', 'Email not found');
            return false;
        }

        if (! password_verify($this->password, $user->password)) {
            $this->addError('password', 'Invalid password');
            return false;
        }

        return Application::$app->login($user);

    }




}