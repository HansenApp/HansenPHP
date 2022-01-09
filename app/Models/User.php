<?php 
 
namespace App\Models; 

use Hansen\system\Core\ValidationModel;

class User extends ValidationModel
{
    public $name;
    public $email;
    public $password;
    public $confirmPassword;

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }
}
