<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Carbon\Carbon;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::query()->get();
        return response($sessions, 200);
    }

    public function show(Session $session)
    {
        return response($session->toArray(), 200);
    }
}
