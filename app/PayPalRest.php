<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPalRest extends Model
{

    protected $api;

    /**
     * PayPalRest constructor.
     */
    public function __construct()
    {
        $paypal_conf = config('paypal');

//        dd($paypal_conf);

        // setup PayPal api context
        $this->api = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );

        $this->api->setConfig($paypal_conf);
    }

    /**
     * PayPalRest getApi.
     */
    public function getApi()
    {
        return $this->api;
    }
}
