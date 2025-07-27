<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Counselor;
use App\Models\Appointment;
use App\Models\Blog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $counselorCount = Counselor::count();
        $appointmentCount = Appointment::count();
        $blogCount = Blog::count();

        return view('admin.dashboard', [
            'userCount' => $userCount,
            'counselorCount' => $counselorCount,
            'appointmentCount' => $appointmentCount,
            'blogCount' => $blogCount
        ]);
    }
}
