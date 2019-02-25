<?php

namespace App\Http\Controllers;

use App\Product;
use App\Variant;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class ProductsController extends ApiController
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $products = Product::orderBy('title', 'asc')->with('variants')->get();
        return view('product.index')->with('products', $products);
    }


    public function fetchProducts()
    {
        $url = $this->end_point . 'products.json';

        try {

            $request = $this->client->get($url)->getBody()
                ->getContents();

            $response = json_decode($request);

            //add new products along with the variants for each product to the db.
            foreach ($response->products as $product) {

                $productModel = new Product();
                $productModel->id = $product->id;
                $productModel->title = $product->title;
                $productModel->body_html = $product->body_html;
                $productModel->vendor = $product->vendor;
                $productModel->product_type = $product->product_type;
                $productModel->created_at = date('Y-m-d H:i:s', strtotime($product->created_at));
                $productModel->handle = $product->handle;
                $productModel->updated_at = date('Y-m-d H:i:s', strtotime($product->updated_at));
                $productModel->published_at = date('Y-m-d H:i:s', strtotime($product->published_at));
                $productModel->template_suffix = $product->template_suffix;
                $productModel->tags = $product->tags;
                $productModel->published_scope = $product->published_scope;
                $productModel->admin_graphql_api_id = $product->admin_graphql_api_id;

                $productModel->save();

                foreach ($product->variants as $variant) {
                    $variantModel = new Variant();
                    $variantModel->id = $variant->id;
                    $variantModel->product_id = $product->id;
                    $variantModel->title = $variant->title;
                    $variantModel->price = $variant->price;
                    $variantModel->sku = $variant->sku;
                    $variantModel->position = $variant->position;
                    $variantModel->option1 = $variant->option1;
                    $variantModel->inventory_policy = $variant->inventory_policy;
                    $variantModel->fulfillment_service = $variant->fulfillment_service;
                    $variantModel->weight_unit = $variant->weight_unit;
                    $variantModel->inventory_item_id = $variant->inventory_item_id;
                    $variantModel->taxable = $variant->taxable;
                    $variantModel->weight = $variant->weight;
                    $variantModel->requires_shipping = $variant->requires_shipping;
                    $variantModel->save();
                }
            }

            return redirect('products')->with('success', 'You have successfully retrieved product records');

        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }

    public function calcuateVariantAverage($product_id)
    {
        $product = Product::find($product_id);

        $url = $this->end_point . 'products/' . $product_id . '/variants.json';

        try {

            $request = $this->client->get($url)
                ->getBody()
                ->getContents();

            $response = json_decode($request);

            $total = 0;
            $average = 0;

            if ($variants = count($response->variants)) {

                foreach ($response->variants as $variant) {
                    $total += $variant->price;
                }

                $average = number_format($total / $variants, 2);
            }

            return view('product.show')->with(array(
                'product' => $product,
                'average' => $average
               )
            );

        } catch (ClientException $e) {

            $response = $e->getResponse();
            $result =  json_decode($response->getBody()->getContents());
            return redirect('/products')->with('error', $result->errors);
        }
    }
}
