<?php

namespace Modules\Client\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Modules\Client\Transformers\AuthResource;
use Modules\Client\Transformers\ClientResource;

class AuthController extends BaseController
{
    public function getToken(Request $request)
    {
        $validated = $this->validate($request, [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        $clients = Client::with('company')->whereEmail($validated['email'])->get();
        $clients = $clients->filter(function ($client) use ($validated){
            return password_verify($validated['password'], $client->password);
        });

        return AuthResource::collection($clients);
    }

    public function getClients(Request $request)
    {
        $clients = Client::with('company')
            ->whereIn('remember_token', $request->get('tokens'))
            ->get();
        return ClientResource::collection($clients);
    }
}
