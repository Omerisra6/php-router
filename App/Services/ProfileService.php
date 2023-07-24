<?php
namespace App\Services;

class ProfileService
{
    public static function get( $id )
    {
        $profileURL = 'https://json.flashy.dev/profile-';
        $user       = file_get_contents($profileURL.$id);
        return json_decode( $user );
    }
}