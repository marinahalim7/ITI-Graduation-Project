<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;

class PayPalController extends Controller
{
    protected $apiContext;

    public function __construct(ApiContext $apiContext)
    {
        $this->apiContext = $apiContext;
    }

    public function createPayment(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($request->input('amount'));
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl('http://example.com/execute-payment')
            ->setCancelUrl('http://example.com/cancel-payment');

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            $approvalUrl = $payment->getApprovalLink();
            return response()->json(['approval_url' => $approvalUrl]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function executePayment(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new \PayPal\Api\PaymentExecution();
        $execution->setPayerId($request->input('payerId'));

        try {
            $payment->execute($execution, $this->apiContext);
            return response()->json(['message' => 'Payment executed successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
