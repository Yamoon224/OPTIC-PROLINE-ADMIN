<?php

    /**
     * @param string : user's name | app_name default value
     * @return string : url of resource from https://ui-avatars.com
     */
    if (!function_exists('userphoto')) 
    {     
        function userphoto($user) 
        {
            return $user->photo ? asset($user->photo) : 'https://ui-avatars.com/api/?name='.str_replace(' ', '+', auth()->user()->name);
        }
    }  
