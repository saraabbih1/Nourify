<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campagne;
use App\Models\Notification;
use App\Models\Don;
use Illuminate\Support\Facades\Auth;
use App\Models\HistoriqueAction;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $view = $request->query('view', 'campaigns');

        $campaigns = Campagne::with('dons')->latest()->get();

        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->get();

        $totalCampaigns = Campagne::count();
        $totalDons = Don::count();
        $donations = Don::all();
        $totalAmount = Don::sum('montant');
        $historiques = HistoriqueAction::latest()->get();
        return view('dashboard', compact(
            'view',
            'campaigns',
            'notifications',
            'totalCampaigns',
            'totalDons',
            'donations',
            'totalAmount',
            'historiques'

        ));
    }
}
