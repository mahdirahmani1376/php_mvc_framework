<?php
namespace App\Models;

use App\Core\Model;
class RegisterModel extends Model
{
    public string $firstName='';
    public string $lastName='';
    public string $email='';
    public string $password='';
    public string $confirmPassword='';

    public function register()
    {

    }

    public function rules(): array
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_EMAIL, self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED,[self::RULE_MIN => '2'],[self::RULE_MAX =>'8']],
            'confirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH => 'password']]
        ];
    }
}