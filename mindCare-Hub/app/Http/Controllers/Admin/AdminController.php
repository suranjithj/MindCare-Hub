<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Counselor;
use App\Models\Appointment;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Return JSON data for realtime chart updates
    public function data()
    {
        $appointmentsByMonth = Appointment::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $labels = [];
        $data = [];

        // Prepare last 6 months labels and data
        $currentMonth = date('n');
        for ($i = $currentMonth - 5; $i <= $currentMonth; $i++) {
            $monthNum = $i <= 0 ? 12 + $i : $i;
            $labels[] = date('M', mktime(0, 0, 0, $monthNum, 10));

            $monthData = $appointmentsByMonth->firstWhere('month', $monthNum);
            $data[] = $monthData ? $monthData->count : 0;
        }

        return response()->json([
            'labels' => $labels,
            'appointments' => $data,
        ]);
    }

    public function salesData()
    {
        $currentYear = date('Y');
        $currentMonth = date('n');

        $appointments = Appointment::with('counselor')
            ->whereYear('created_at', $currentYear)
            ->get();

        $monthlySales = [];

        for ($i = $currentMonth - 5; $i <= $currentMonth; $i++) {
            $monthNum = $i <= 0 ? 12 + $i : $i;
            $monthlySales[$monthNum] = 0.0;
        }

        foreach ($appointments as $appointment) {
            $month = $appointment->created_at->format('n');
            if (array_key_exists($month, $monthlySales)) {
                $monthlySales[$month] += $appointment->counselor->fee ?? 0;
            }
        }

        $labels = [];
        $salesData = [];

        for ($i = $currentMonth - 5; $i <= $currentMonth; $i++) {
            $monthNum = $i <= 0 ? 12 + $i : $i;
            $labels[] = date('M', mktime(0, 0, 0, $monthNum, 10));
            $salesData[] = round($monthlySales[$monthNum], 2);
        }

        return response()->json([
            'labels' => $labels,
            'sales' => $salesData,
        ]);
    }

}
