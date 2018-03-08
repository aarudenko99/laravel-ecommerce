<?php
namespace App\Http\Controllers;

use AvoRed\Ecommerce\Models\Database\Configuration;
use AvoRed\Ecommerce\Models\Database\Page;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pageModel = null;
        $pageId = Configuration::getConfiguration('general_home_page');


        if(null !== $pageId) {
            $pageModel = Page::find($pageId);
        }

        return view('home.index')->with('pageModel', $pageModel);

    }
}
