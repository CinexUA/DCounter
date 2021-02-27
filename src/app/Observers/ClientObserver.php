<?php

namespace App\Observers;

use App\Models\Client;

class ClientObserver
{
    public function deleting(Client $client){
        //transactions will be removed automatically
        $client->wallet->delete();
    }
}
