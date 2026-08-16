<?php

namespace App\Http\Controllers;

use App\Models\LearningPartner;

class FrontendLearningPartnerController extends Controller
{
    public function index()
    {
        $partners = LearningPartner::where('status', 'active')
            ->orderBy('display_order')
            ->get();
        return view('learning-partners', compact('partners'));
    }
}
