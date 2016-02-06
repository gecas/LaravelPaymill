<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paymill;
use Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymillController extends Controller
{
	public function index()
	{
		return view('welcome');
	}

    public function paymill($token)
    {

     	$apiKey = Config::get('paymill.test.private_key');
		$request = new \Paymill\Request($apiKey);

		// var_dump($request);

     	$transaction = Paymill::Transaction();

    	//return Paymill::Client('client_8127a65bf3c84676c918')->details();
    	//return Paymill::Payment()->create('098f6bcd4621d373cade4e832627b4f6');

		$preAuth = new \Paymill\Models\Request\Preauthorization();
		$preAuth->setToken($token)
		        ->setAmount(4200)
		        ->setCurrency('EUR')
		        ->setDescription('description example');

		$response = $request->create($preAuth);

	

 //    	try {

 //    Paymill::Transaction()
 //        ->setAmount(4200)
 //        ->setCurrency('EUR')
 //        ->setPayment('pay_9266f049d59767f3175cc17a')
 //        ->setDescription('Test Transaction')
 //        ->create();

	// } catch(PaymillException $e) {

	//     $e->getResponseCode();
	//     $e->getStatusCode();
	//     $e->getErrorMessage();

	// }

	

	

	}
}
