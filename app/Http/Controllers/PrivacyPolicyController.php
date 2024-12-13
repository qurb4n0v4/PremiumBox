<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $privacyPolicies = PrivacyPolicy::all();
        return view('front.about_us.privacy_policy', [
            'privacyPolicies' => $privacyPolicies
        ]);
    }



}
