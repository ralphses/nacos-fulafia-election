<?php

namespace App\Http\Controllers;

use App\Models\Voters;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class VerificationController extends Controller
{
    public function index(): Response
    {
        return response()->view('auth.voter.verify');
    }

    public function verify(Request $request): Response
    {
        $request->validate(["matric_number" => "required", Rule::exists("voters", "matric")]);
        $matricNumber = $request->input('matric_number');

        $voter = Voters::where("matric", $matricNumber)->first();
        $status = "failed";

        if ($voter) {
            if (!$voter->voted) {

                $voter->voted = true;
                $voter->save();

                $status = "Voter verified";
            } else {
                $status = "Voter already voted!";
            }
        } else {
            $status = "Voter with matric number " . $request->get('matric_number') . " not found";
        }
        session()->flash("success", $status);

        return response()->view("auth.voter.status");
    }
}
