<?php

namespace App\Http\Controllers;

use App\Models\Voters;
use Illuminate\Http\Request;

class MailSendController extends Controller
{
    public function sendVinToVoters() {
        $voters = Voters::all(['email', 'name']);

    }
}
