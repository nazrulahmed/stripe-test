<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{
		require_once('application/libraries/stripe-php/init.php');
		\Stripe\Stripe::setApiKey('PUT YOUR STRIPE SECRET KEY HERE');

		if ($this->input->post('total_order') != '') {

			
			$connected_account_id = 'acct_1OubY2GaG50hxLxn';
			$order_id = rand(10,100);
			$email = $this->input->post('email');
			$order_total = $this->input->post('total_order');
			$amountPanny = $order_total * 100;
			$toTransfer = ($amountPanny * 0.71)-0.2;
			
			$data['intent'] = \Stripe\PaymentIntent::create([
				'amount' => $amountPanny,
				'currency' => 'GBP',
				'transfer_data' => [
					'amount' => round($toTransfer),
					'destination' => $connected_account_id,
				],
				'metadata' => [
					'order_id' => $order_id,
				],
				'receipt_email' => $email,
			]);
			$data['order_id'] = $order_id;
			$this->load->view('index', $data);
		} else {
			$this->load->view('product');
		}
	}

	public function success(){
		$this->load->view('success');
	}
}
