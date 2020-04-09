<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @return Client[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Client::all();
    }
}
