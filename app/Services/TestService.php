<?php

use App\Models\User;

class TestService
{
    public function aa()
    {/*{{{*/
        dd(User::get()->all());
    }/*}}}*/
}
