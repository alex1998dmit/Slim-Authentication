<?php 

namespace App\Validation\Rules;
use Respect\Validation\Rules\AbstractRule;
use App\Models\User;

class EmailAvailable extends AbstractRule
{
    public function validate($input) 
    {
       if(User::where('email', $input)->exists()) {
           return false;
       }
       return true;
    }
}