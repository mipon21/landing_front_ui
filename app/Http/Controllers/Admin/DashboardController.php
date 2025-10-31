<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Dish;
use App\Models\Statistic;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'blog_posts' => BlogPost::count(),
            'testimonials' => Testimonial::count(),
            'dishes' => Dish::count(),
            'statistics' => Statistic::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}

