<?php

namespace App\Http\Controllers\Frontend;

use App\Events\CreateOrder;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{


    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }

    public function paymentCancel()
    {
        return view('frontend.pages.payment-cancel');
    }


    public function paypalAmount(): int
    {
        $packageId = Session::get('selected_package_id');
        $package = Package::findOrFail($packageId);
        return $package->price;
    }

    public function setPaypalConfig(): array
    {
        return [
            'mode' => config('payment.paypal_mode'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id' => config('payment.paypal_client_id'),
                'client_secret' => config('payment.paypal_secret_key'),
                'app_id' => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id' => config('payment.paypal_client_id'),
                'client_secret' => config('payment.paypal_secret_key'),
                'app_id' => config('payment.paypal_app_key'),
            ],

            'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
            'currency' => config('payment.paypal_currency'),
            'notify_url' => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
            'locale' => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl' => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
        ];
    }

    public function payWithPaypal()
    {
        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        // get price
        $totalAmount = $this->paypalAmount() * config('payment.paypal_currency_rate');

        $response = $provider->createOrder([
            'intent' => 'CAPTURE', //"AUTHORIZE"
            'application_context' => [
                "return_url" => route('paypal.payment.success'), // https://موقعك.com/success
                "cancel_url" => route('paypal.payment.cancel') // https://موقعك.com/cancel
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('payment.paypal_currency'),
                        'value' => $totalAmount
                    ]
                ],
            ],
        ]);

        if (isset($response['id']) && $response['status'] === 'CREATED') {
            //            $orderId = $response['id'];
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    $approvalUrl = $link['href'];
                    return redirect()->away($approvalUrl); // away means this link is out the site, not inside the site
                }
            }
        } else {
            logger($response);
            return to_route('payment.cancel')->withErrors(['error' => $response['error']['message']]);
        }

    }

    public function paypalSuccess(Request $request)
    {
        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            $capture = $response['purchase_units'][0]['payments']['captures'][0];
            $paymentInfo = [
                'transaction_id' => $capture['id'],
                'payment_method' => 'PayPal',
                'paid_amount' => $capture['amount']['value'],
                'paid_currency' => $capture['amount']['currency_code'],
                'payment_status' => $capture['status'],
            ];

            CreateOrder::dispatch($paymentInfo);
            return to_route('payment.success');
        }
        return to_route('payment.cancel')->withErrors(['error' => $response['error']['message']]);
    }

    public function paypalCancel()
    {
        return to_route('payment.cancel')->withErrors(['error' => 'You have canceled the payment.']);
    }
}
