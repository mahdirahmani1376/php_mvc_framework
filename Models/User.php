<?php

namespace App\Models;

use App\Core\DbModel;
use App\Core\Model;

class User extends DbModel
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';
    public int $status = self::STATUS_INACTIVE;


    public static function tableName()
    {
        return 'users';
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_EMAIL, self::RULE_REQUIRED, [
                self::RULE_UNIQUE ,'class' => self::class, 'attribute' => 'email'
            ]
            ],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN => '2'], [self::RULE_MAX => '8']],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH => 'password']],
        ];
    }

    public static function attributes()
    {
        return [
            'firstName',
            'lastName',
            'email',
            'password',
            'status'
        ];
    }

    public function labels()
    {
        return [
            'firstName' => 'First name',
            'lastName' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'passwordConfirm' => 'Confirm password',
        ];
    }
}