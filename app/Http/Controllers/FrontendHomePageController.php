<?php

namespace App\Http\Controllers;

use App\Models\HeroBanner;
use App\Models\Banner;
use App\Models\MenuItem;
use App\Models\Popup;
use App\Models\Blog;
use App\Models\LandingSetting;
use App\Models\Testimonial;
use App\Models\LearningPartner;


class FrontendHomePageController extends Controller
{
    public function index()
    {
        $banners = HeroBanner::latest()->get();
        $explorebanners = Banner::all();
        $menuItems = MenuItem::all();
        $popups = Popup::where('status', 'active')->get();
        $blogs = Blog::where('status', 'published')->orderBy('created_at', 'desc')->take(4)->get();
        $lp = LandingSetting::allCached();
        $homeTestimonials = Testimonial::active()->orderBy('sort_order')->latest()->take(8)->get();
        $learningPartners = LearningPartner::where('status', 'active')->orderBy('display_order')->take(6)->get();

        // Get dynamic URLs from settings
        $enquiryUrl = config('site.enquiry_url');
        $registrationUrl = config('site.registration_url');

        return view('index', compact('banners', 'explorebanners', 'menuItems', 'popups', 'blogs', 'lp', 'homeTestimonials', 'learningPartners', 'enquiryUrl', 'registrationUrl'));
    }
}
