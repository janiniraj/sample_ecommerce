<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Page\PageRepository;

/**
 * Class PageController.
 */
class PageController extends Controller
{

    public function __construct()
    {
        $this->page = new PageRepository();
    }

    public function aboutUs()
    {
        $pageData = $this->page->getPageBySlug('about-us');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'about-style.css'
            ]);
    }

    public function press()
    {
        $pageData = $this->page->getPageBySlug('press');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'press-style.css'
            ]);
    }

    public function store()
    {
        $pageData = $this->page->getPageBySlug('stores');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'stores-style.css'
            ]);
    }

    public function contactUs()
    {
        $pageData = $this->page->getPageBySlug('contact-us');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'contact-style.css'
            ]);
    }

    public function history()
    {
        $pageData = $this->page->getPageBySlug('history');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'history-style.css'
            ]);
    }

    public function awardsCertifications()
    {
        $pageData = $this->page->getPageBySlug('awards-certifications');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'awards-style.css'
            ]);
    }

    public function termsConditions()
    {
        $pageData = $this->page->getPageBySlug('terms-conditions');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'tnc-style.css'
            ]);
    }

    public function privacyPolicy()
    {
        $pageData = $this->page->getPageBySlug('privacy-policy');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'privacy-style.css'
            ]);
    }

    public function returnPolicy()
    {
        $pageData = $this->page->getPageBySlug('return-policy');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'return-style.css'
            ]);
    }

    public function showRoom()
    {
        $pageData = $this->page->getPageBySlug('showroom');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'showroom-style.css'
            ]);
    }

    public function cleaningRestoration()
    {
        $pageData = $this->page->getPageBySlug('cleaning-restoration');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'cleaning-style.css'
            ]);
    }

    public function rugSchool()
    {
        $pageData = $this->page->getPageBySlug('rug-school');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'rug-style.css'
            ]);
    }

    public function hospitality()
    {
        $pageData = $this->page->getPageBySlug('hospitality');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'hospitality-style.css'
            ]);
    }

    public function becomeDealer()
    {
        $pageData = $this->page->getPageBySlug('become-dealer');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'dealers-style.css'
            ]);
    }

    public function careers()
    {
        $pageData = $this->page->getPageBySlug('careers');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'careers-style.css'
            ]);
    }

    public function siteMap()
    {
        $pageData = $this->page->getPageBySlug('site-map');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'site-map-style.css'
            ]);
    }

    public function faq()
    {
        $pageData = $this->page->getPageBySlug('faq');

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'faq-style.css'
            ]);
    }

}
