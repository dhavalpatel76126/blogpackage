<?php

namespace  Cct\Blog\Helpers;

use Illuminate\Support\Facades\Auth;

class PermissionHelper
{
    /*
     * check user has permission to access that part or not
    */
    public static function __checkPermission($path = '')
    {
        if (auth()->user() != null) {
            if(auth()->user()->usertype == 'admin'){
                return true;
            }
        } else {
            return false;
        }
    }

}
