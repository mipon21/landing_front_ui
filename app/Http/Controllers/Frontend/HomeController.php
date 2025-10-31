<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Dish;
use App\Models\DownloadSection;
use App\Models\HeroSection;
use App\Models\HowItWork;
use App\Models\RestaurantLogo;
use App\Models\Service;
use App\Models\Statistic;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $hero = HeroSection::getActive();
        $statistics = Statistic::active()->get();
        $restaurantLogos = RestaurantLogo::active()->get();
        $whyChooseUs = WhyChooseUs::active()->get();
        $dishes = Dish::active()->get();
        $services = Service::active()->get();
        $howItWorks = HowItWork::active()->get();
        $testimonials = Testimonial::active()->get();
        $blogPosts = BlogPost::published()->take(2)->get();
        $downloadSection = DownloadSection::active()->download()->first();
        $registerSection = DownloadSection::active()->register()->first();

        return view('frontend.index', compact(
            'hero',
            'statistics',
            'restaurantLogos',
            'whyChooseUs',
            'dishes',
            'services',
            'howItWorks',
            'testimonials',
            'blogPosts',
            'downloadSection',
            'registerSection'
        ));
    }
}

