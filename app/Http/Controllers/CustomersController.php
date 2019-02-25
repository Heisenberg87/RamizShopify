<?php

namespace App\Http\Controllers;


use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use League\Flysystem\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Customer;

class CustomersController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $customers = Customer::orderBy('first_name', 'asc')->get();

        return view('customer.index')->with('customers', $customers);
    }

    public function fetchCustomers()
    {
        $url = $this->end_point . 'customers.json';

        try {

            //it's hammer time(make request)
            $request = $this->client->get($url)
                ->getBody()
                ->getContents();

            $response = json_decode($request);

            //save all retrived customer records to local db
            foreach($response->customers as $customer) {

                $customerModel = new Customer();
                $customerModel->customer_id = $customer->id;
                $customerModel->email = $customer->email;
                $customerModel->first_name = $customer->first_name;
                $customerModel->last_name = $customer->last_name;
                $customerModel->accepts_marketing = $customer->accepts_marketing;
                $customerModel->created_at = date('Y-m-d H:i:s', strtotime($customer->created_at));
                $customerModel->updated_at = date('Y-m-d H:i:s', strtotime($customer->updated_at));
                $customerModel->note = $customer->note;
                $customerModel->orders_count = $customer->orders_count;
                $customerModel->state = $customer->state;
                $customerModel->total_spent = $customer->total_spent;
                $customerModel->last_order_id = $customer->last_order_id;
                $customerModel->verified_email = $customer->verified_email;
                $customerModel->multipass_identifier = $customer->multipass_identifier;
                $customerModel->tax_exempt = $customer->tax_exempt;
                $customerModel->phone = $customer->phone;
                $customerModel->tags = $customer->tags;
                $customerModel->last_order_name = $customer->last_order_name;
                $customerModel->currency = $customer->currency;

                $customerModel->save();
            }

            return redirect('customers')->with('success', 'You have successfully retrieved customer records');

        } catch (ClientException $e) {
            $response = $e->getResponse();
            $result =  json_decode($response->getBody()->getContents());
            return redirect('/customers')->with('error', $result->errors);
        }
    }

    public function calcuateCustomerOrderAverage($customer_id)
    {
        $customer = Customer::find($customer_id);

        $url = $this->end_point . 'customers/' . $customer_id . '/orders.json';

        try {

            $request = $this->client->get($url)
                ->getBody()
                ->getContents();

            $response = json_decode($request);

            $total = 0;
            $average = 0;

            foreach ($response->orders as $customer_order) {
                $total += $customer_order->total_line_items_price;
            }

            $average = number_format($total / $orders, 2);

            return view('customer.show')->with(array(
                    'customer' => $customer,
                    'average' => $average
                )
            );

        } catch (ClientException $e) {

            $response = $e->getResponse();
            $result =  json_decode($response->getBody()->getContents());
            return redirect('/customers')->with('error', $result->errors);
        }

    }
}
