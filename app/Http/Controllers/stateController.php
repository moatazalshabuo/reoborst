<?php
namespace App\Http\Controllers;

use App\Models\Reports;
use App\Models\ServiceRequests;


use App\Models\Teams;
use App\Models\Users;

class stateController extends Controller
{
    /**
     * Get all statistics.
     */
    public function index()
    {
        // إحصائيات البلاغات
        $totalReports = Reports::count();
        $pendingReports = Reports::where('status', 'pending')->count();
        $inProgressReports = Reports::where('status', 'in_progress')->count();
        $finishedReports = Reports::where('status', 'finished')->count();

        // إحصائيات الخدمات
        $totalServiceRequests = ServiceRequests::count();
        $totalCost =ServiceRequests::sum('cost'); // إجمالي التكلفة
        $pendingServiceRequests = ServiceRequests::where('status', 'pending')->count();
        $finishedServiceRequests = ServiceRequests::where('status', 'finished')->count();

        // إحصائيات المستخدمين
        $totalUsers = Users::count();

        // إحصائيات الفرق
        $totalTeams = Teams::count();

        return response()->json([
            'reports' => [
                'total' => $totalReports,
                'pending' => $pendingReports,
                'in_progress' => $inProgressReports,
                'finished' => $finishedReports,
            ],
            'ServiceRequests' => [
                'total' => $totalServiceRequests,
                'total_cost' => $totalCost,
                'pending' => $pendingServiceRequests,
                'finished' => $finishedServiceRequests,
            ],
            'users' => [
                'total' => $totalUsers,
            ],
            'teams' => [
                'total' => $totalTeams,
            ],
        ]);
    }
}
