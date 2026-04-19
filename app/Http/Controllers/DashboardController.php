<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use App\Models\Don;
use App\Models\HistoriqueAction;
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

    public function historique()
    {
        $historiques = HistoriqueAction::latest()->get();
        return view('historique.index', compact('historiques'));
    }

    public function admin()
    {
        $usersCount = User::count();
        $campaignsCount = Campagne::count();
        $donsCount = Don::count();
        return view('admin.index', compact('usersCount', 'campaignsCount', 'donsCount'));
    }

    public function adminUsers()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }
}
