<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class PageController.
 */
class PageController extends Controller
{

    public function __construct()
    {

    }

    public function aboutUs()
    {
        return view('frontend.page.about-us');
    }

    public function press()
    {
        return view('frontend.page.press');
    }

    public function store()
    {
        return view('frontend.page.store');
    }

    public function contactUs()
    {
        return view('frontend.page.contact-us');
    }

    public function history()
    {
        return view('frontend.page.history');
    }

    public function awardsCertifications()
    {
        return view('frontend.page.awards-certifications');
    }

    public function termsConditions()
    {
        return view('frontend.page.terms-conditions');
    }

    public function privacyPolicy()
    {
        return view('frontend.page.privacy-policy');
    }

    public function returnPolicy()
    {
        return view('frontend.page.return-policy');
    }

    public function showRoom()
    {
        return view('frontend.page.show-room');
    }

    public function cleaningRestoration()
    {
        return view('frontend.page.cleaning-restoration');
    }

    public function rugSchool()
    {
        return view('frontend.page.rug-school');
    }

    public function hospitality()
    {
        return view('frontend.page.hospitality');
    }

    public function becomeDealer()
    {
        return view('frontend.page.become-dealer');
    }

    public function careers()
    {
        return view('frontend.page.careers');
    }

    public function siteMap()
    {
        return view('frontend.page.site-map');
    }

    public function faq()
    {
        return view('frontend.page.faq');
    }

}
