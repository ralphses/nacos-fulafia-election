<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Utils\Utility;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function welcome(): Factory|View|Application
    {

        $readyElection = Election::where('status', Utility::ELECTION_STATUS['start'])
            ->orWhere('status', Utility::ELECTION_STATUS['on'])
            ->orderBy('date', 'desc')
            ->first();

        return view('welcome', ['ready' => $readyElection->status ?? false]);

    }

    public function guide(): Factory|View|Application
    {

        return view('guide');

    }
}
