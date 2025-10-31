<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\HowItWork;
use App\Models\RestaurantLogo;
use App\Models\Service;
use App\Models\Statistic;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'testimonials' => Testimonial::count(),
            'dishes' => Dish::count(),
            'statistics' => Statistic::count(),
            'restaurant_logos' => RestaurantLogo::count(),
            'why_choose_us' => WhyChooseUs::count(),
            'services' => Service::count(),
            'how_it_works' => HowItWork::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}

