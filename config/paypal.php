<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => 'janiniraj1992-facilitator_api1.gmail.com',
        'password'    => 'NABQA2S8RGSD7PL3',
        'secret'      => 'EJuc8WRI2XViAdNymorPl-sBHaP91y7kR-6TYpgaKpqnuq9fpCjM-dw1PzHeRMRSmgno4pos9D506vmJ',
        'certificate' => 'AStZL5ICQYi8KjUzrBlzaHsppm4_XpCQg3lH6Oc9GNspI59X1ZTqXVCd1jEsy2-E9vE1Hshnc1hSYHK8',
        'app_id'      => 'APP-13T51814SM408674A', // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username'    => env('PAYPAL_LIVE_API_USERNAME', ''),
        'password'    => env('PAYPAL_LIVE_API_PASSWORD', ''),
        'secret'      => env('PAYPAL_LIVE_API_SECRET', ''),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
        'app_id'      => '', // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => 'USD',
    'billing_type'   => 'MerchantInitiatedBilling',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => true, // Validate SSL when creating api client.
];
