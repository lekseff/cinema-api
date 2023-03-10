<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Session\CeateSessionRequest;
use App\Models\Session;
use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SessionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $sessions = Session::query()->get();
        return response($sessions, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CeateSessionRequest $request
     * @param SessionService $service
     * @return Response
     */
    public function store(CeateSessionRequest $request, SessionService $service): Response
    {
        $validated = $request->validated();
        $session = $service->create($validated);
        return response($session, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Session $session
     * @return Response
     */
    public function show(Session $session): Response
    {
        return response($session->toArray(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Session $session
     * @return void
     */
    public function destroy(Session $session): void
    {
        $session->delete();
    }

    /**
     * Возвращает сеансы в формате для timeline админки
     * @param SessionService $service
     * @return Response
     */
    public function timetable(SessionService $service): Response
    {
        $response = $service->sessionsFromTimeline();
        return response($response, 200);
    }
}
