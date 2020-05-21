<?php

namespace App\Services;

use Carbon\Carbon;

class ChaveApi
{
    public static function acesso_api()
    {
        $senha = "senha_api@".Carbon::today();
        $senha_enc = md5($senha);
        return $senha_enc;
    }
}
