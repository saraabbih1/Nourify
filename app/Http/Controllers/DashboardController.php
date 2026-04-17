<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use App\Models\Don;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCampaigns = Campagne::count();
        $totalDons = Don::count();
        $totalAmount = Don::sum('montant');
        $totalUsers = User::count();

        return view('dashboard.index', compact(
            'totalCampaigns',
            'totalDons',
            'totalAmount',
            'totalUsers'
        ));
    }
}
