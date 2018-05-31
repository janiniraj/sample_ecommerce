<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Page\PageRepository;
use App\Repositories\Backend\HomeSlider\HomeSliderRepository;
use Illuminate\Http\Request;
use View, Mail;
use App\Mail\contactEmail;

/**
 * Class PageController.
 */
class PageController extends Controller
{

    public function __construct()
    {
        $this->page     = new PageRepository();
        $this->slider   = new HomeSliderRepository(); 
    }

    /**
     * Get Slider COntent
     *
     * @param $slug
     * @param $pageData
     * @return mixed
     */
    public function getSliderContent($slug, $pageData)
    {
        $slider = $this->slider->query()->where('page_type', $slug)->get();

        if(!empty($slider))
        {

            $sliderHtml = '<div class="row page-slider">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                    <section class="slider page-slider-setup">';

            foreach($slider as $singleSlider)
            {
                $sliderHtml .= '<div>
                                    <img src="'.url('/').'/img/sliders/'.$singleSlider->image.'">
                                </div>';
            }
            $sliderHtml .='        </section>
                                </div>
                            </div>';

            $content = str_replace("[[slider]]", $sliderHtml, $pageData->content);
        }
        else
        {
            $content = $pageData->content;
        }

        return $content;
    }

    public function aboutUs()
    {
        $pageData = $this->page->getPageBySlug('about-us');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('about-us', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'about-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function press()
    {
        $pageData = $this->page->getPageBySlug('press');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('press', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'press-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function store()
    {
        $pageData = $this->page->getPageBySlug('stores');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('stores', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'stores-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function contactUs()
    {
        $pageData = $this->page->getPageBySlug('contact-us');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('contact-us', $pageData);

        $contactformView = View::make('frontend.page.contactform');

        $contactform = (string) $contactformView;
        
        $content = str_replace("[[contactform]]", $contactform, $content);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'contact-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function contactSubmit(Request $request)
    {
        $data = $request->all();

        Mail::to(env('MAIL_FROM_ADDRESS'))
           ->send(new contactEmail($data));

        return redirect()->route('frontend.page.contact-us')->withFlashWarning('Thank you for contacting us. We will contact you soon.');
    }

    public function history()
    {
        $pageData = $this->page->getPageBySlug('history');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('history', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'history-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function awardsCertifications()
    {
        $pageData = $this->page->getPageBySlug('awards-certifications');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('awards-certifications', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'awards-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function termsConditions()
    {
        $pageData = $this->page->getPageBySlug('terms-conditions');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('terms-conditions', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'tnc-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function privacyPolicy()
    {
        $pageData = $this->page->getPageBySlug('privacy-policy');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('privacy-policy', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'privacy-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function returnPolicy()
    {
        $pageData = $this->page->getPageBySlug('return-policy');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('return-policy', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'return-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function showRoom()
    {
        $pageData = $this->page->getPageBySlug('showroom');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('showroom', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'showroom-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function cleaningRestoration()
    {
        $pageData = $this->page->getPageBySlug('cleaning-restoration');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('cleaning-restoration', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'cleaning-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function rugSchool()
    {
        $pageData = $this->page->getPageBySlug('rug-school');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('rug-school', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'rug-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function hospitality()
    {
        $pageData = $this->page->getPageBySlug('hospitality');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('hospitality', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'hospitality-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function becomeDealer()
    {
        $pageData = $this->page->getPageBySlug('become-dealer');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('become-dealer', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'dealers-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function careers()
    {
        $pageData = $this->page->getPageBySlug('careers');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('careers', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'careers-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function siteMap()
    {
        $pageData = $this->page->getPageBySlug('site-map');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('site-map', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'site-map-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

    public function faq()
    {
        $pageData = $this->page->getPageBySlug('faq');

        if(empty($pageData))
        {
            return redirect()->route('frontend.index')->withFlashWarning('Page Not Found');
        }

        $content = $this->getSliderContent('faq', $pageData);

        return view('frontend.page.main')->with([
            'pageData'  => $pageData,
            'styleName' => 'faq-style.css',
            'slider'    => isset($slider) ? $slider :[],
            'content'   => isset($content) ? $content : ""
            ]);
    }

}
