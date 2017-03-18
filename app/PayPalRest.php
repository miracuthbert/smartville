<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPalRest extends Model
{

    /**
     * @var ApiContext
     */
    protected $apiContext;

    /**
     * PayPalRest constructor.
     */
    public function __construct()
    {
        //get paypal config settings
        $paypal_conf = config('paypal');

        // setup PayPal api context
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );

        //set config settings
        $this->apiContext->setConfig($paypal_conf);
    }

    /**
     * PayPalRest getApi.
     */
    public function getApi()
    {
        return $this->apiContext;
    }
}
