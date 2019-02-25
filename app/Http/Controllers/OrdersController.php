<?php

namespace App\Http\Controllers;

use App\Order;
use Http\Client\Exception;
use Illuminate\Http\Request;;

class OrdersController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $orders = Order::all();

        $order_average = Order::all()->avg('subtotal_price');

        return view('order.index')->with(array(
                'orders' => $orders,
                'order_average' => $order_average
            )
        );
    }

    public function fetchOrders()
    {
        $url = $this->end_point . 'orders.json';

        try {

            //it's hammer time(make request)
            $request = $this->client->get($url)
                ->getBody()
                ->getContents();

            $response = json_decode($request);

            foreach ($response->orders as $order) {

                $orderModel = new Order();
                $orderModel->order_id = $order->id;
                $orderModel->created_at = date('Y-m-d H:i:s', strtotime($order->created_at));
                $orderModel->updated_at = date('Y-m-d H:i:s', strtotime($order->updated_at));
                $orderModel->number = $order->number;
                $orderModel->token = $order->token;
                $orderModel->gateway = $order->gateway;
                $orderModel->test = $order->test;
                $orderModel->total_price = $order->total_price;
                $orderModel->subtotal_price = $order->subtotal_price;
                $orderModel->total_line_items_price = $order->total_line_items_price;
                $orderModel->total_weight = $order->total_weight;
                $orderModel->total_tax = $order->total_tax;
                $orderModel->total_discounts = $order->total_discounts;
                $orderModel->taxes_included = $order->taxes_included;
                $orderModel->currency = $order->currency;
                $orderModel->financial_status = $order->financial_status;
                $orderModel->total_price_usd = $order->total_price_usd;
                $orderModel->order_number = $order->order_number;
                $orderModel->confirmed = $order->confirmed;
                $orderModel->name = $order->name;
                $orderModel->save();
            }

            return redirect('orders')->with('success', 'You have successfully retrieved orders records');

        } catch(ClientException $e) {
            $response = $e->getResponse();
            $result =  json_decode($response->getBody()->getContents());
            return redirect('/order')->with('error', $e->getMessage());
        }
    }
}
