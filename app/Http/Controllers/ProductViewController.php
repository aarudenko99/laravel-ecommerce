<?php

namespace App\Http\Controllers;

use AvoRed\Ecommerce\Models\Database\Product;

class ProductViewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['product.viewed']);
    }

    public function view($slug)
    {
        $product = $this->_getProductBySlug($slug);

        $view = view('catalog.product.view')
            ->with('product', $product);

        $title = (!empty($product->meta_title)) ? $product->meta_title : $product->name;
        $description = (!empty($product->meta_description)) ? $product->meta_description : substr($product->description, 0, 255);

        $view->with('title', $title);
        $view->with('description', $description);

        return $view;
    }

    private function _getProductBySlug($slug)
    {
        $product = Product::where('slug', '=', $slug)->get()->first();

        return $product;
    }
}
