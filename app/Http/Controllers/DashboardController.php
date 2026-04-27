<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use App\Models\Don;
use App\Models\HistoriqueAction;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        $users = User::with('role')
            ->whereKeyNot(request()->user()->id)
            ->latest()
            ->get();

        $roles = Role::whereIn('name', ['donateur', 'beneficiaire', 'admin'])->get();

        return view('admin.users', compact('users', 'roles'));
    }

    public function updateUserRole(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        if ($request->user()->id === $user->id) {
            return redirect()->route('admin.users')
                ->with('error', 'Vous ne pouvez pas modifier votre propre role.');
        }

        $user->update([
            'role_id' => $request->integer('role_id'),
        ]);

        HistoriqueAction::create([
            'action' => 'Role modifie pour user: ' . $user->email,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'Role mis a jour avec succes.');
    }
}
