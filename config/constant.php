<?php

if (!defined('CONSTANT')) {
    define('CONSTANT', 1);

    define('DOMAIN_BOOKING', config('api_domain.domain_booking'));
    define('DOMAIN_NOTIFICATION', config('api_domain.domain_notification'));

    //Guards
    define('GUARD_CUSTOMER', 'customer');
    define('GUARD_DRIVER', 'driver');

    // Method
    define('METHOD_GET', 'get');
    define('METHOD_POST', 'post');
    define('METHOD_PATCH', 'patch');
    define('METHOD_DELETE', 'delete');
    define('METHOD_SHOW', 'show');
    define('METHOD_SEARCH', 'search');

    define('IS_DELETE_AT', null);
}
