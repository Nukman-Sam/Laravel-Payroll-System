<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Note;
use App\Models\Reminder;
use App\Models\Routine;
use App\Models\File;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        

        

        return view('dashboard');
    }

    /**
     * Get productivity data for charts (AJAX endpoint).
     */
    public function getProductivityData(Request $request)
    {
        $user = Auth::user();
        $period = $request->get('period', 'week');

        $data = [];
        $labels = [];

        switch ($period) {
            case 'week':
                $startDate = now()->startOfWeek();
                for ($i = 0; $i < 7; $i++) {
                    $date = $startDate->copy()->addDays($i);
                    $labels[] = $date->format('M j');
                    $data[] = $user->tasks()
                        ->where('status', 'completed')
                        ->whereDate('updated_at', $date)
                        ->count();
                }
                break;

            case 'month':
                $startDate = now()->startOfMonth();
                $daysInMonth = now()->daysInMonth;
                for ($i = 0; $i < $daysInMonth; $i++) {
                    $date = $startDate->copy()->addDays($i);
                    $labels[] = $date->format('j');
                    $data[] = $user->tasks()
                        ->where('status', 'completed')
                        ->whereDate('updated_at', $date)
                        ->count();
                }
                break;

            case 'year':
                for ($i = 0; $i < 12; $i++) {
                    $date = now()->startOfYear()->addMonths($i);
                    $labels[] = $date->format('M');
                    $data[] = $user->tasks()
                        ->where('status', 'completed')
                        ->whereYear('updated_at', now()->year)
                        ->whereMonth('updated_at', $date->month)
                        ->count();
                }
                break;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
