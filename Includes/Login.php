<?php

namespace Includes;

use Models\User;

class Login
{
    //make login function using id_user and password
    public static function make($id_user, $password)
    {
        //check if user exists
        $user = new User();
        $user = $user->getById($id_user);
        if ($user) {
            //check if password is correct
            if (password_verify($password, $user->getPassword())) {
                //set session
                $_SESSION['user'] = $user;
                return true;
            }
        }
        return false;
    }


}
