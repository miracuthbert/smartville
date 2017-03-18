<?php
return array(
    // set your paypal credential
    'client_id' => 'AV1n6EiE8Rgo0PJ0niYcKVuxWSU3tPgZAf0m0tGYcOxIKU6Jb_mj6K6aZMhFLQ0ILUs0ifl8DjZfYXss',
    
    'secret' => 'EH5-Au6MJ4Qewql8eIxabrn8SxYZRCJO5H-r74MP1PbdAIyuL4-eXWEKYZP4oFY7mdM4b9OSsBys7mDS',

    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE',
    )
);