<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Httpcat extends Model
{

    public function fetchCat($code)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://http.cat/$code");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);

        return $server_output;
    }
}
