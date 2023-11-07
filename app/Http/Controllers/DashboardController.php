<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Utils\Utility;
use Illuminate\Http\Response;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {

        $readyElection = Election::where('status', Utility::ELECTION_STATUS['start'])
            ->orWhere('status', Utility::ELECTION_STATUS['on'])
            ->orderBy('date', 'desc')
            ->first();

        return response()->view('dashboard.dashboard', ['info' => [
            'ready' => $readyElection->status ?? 'NEW'
        ]]);
    }

}
