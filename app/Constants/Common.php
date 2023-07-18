<?php

namespace App\Constants;

class Common
{
   const ADMIN_ROLE = "admin";
   const USER_ROLE = "user";

   const MAX_REQUEST_PER_MINUTE = 120;

    # Http methods
    const GET_METHOD = 'get';
    const POST_METHOD = 'post';
    const PATCH_METHOD = 'patch';
    const DELETE_METHOD = 'delete';

    const STATUS_REQUEST_CAR = 1;
    const STATUS_APPROVE_CAR = 2;
    const STATUS_PENDING_CAR = 4;

    const MAX_LENGTH_RIDE_NO = 30;

    # Unit calculate distance
    const STATUTE_MILES_UNIT = 'M';
    const KILOMETERS_UNIT = 'K';
    const NAUTICAL_MILES_UNIT = 'N';

    const RADIUS = 3; //(km)

    const API_CODE_OK = 200;

    # Role name
    const DRIVER_ROLE = 'driver';
    const CUSTOMER_ROLE = 'customer';

    # Status driver
    const DRIVER_ONLINE = 1;
    const DRIVER_OFFLINE = 0;
    const DRIVER_BUSY = 2;

    const PER_PAGE_DEFAULT = 10;

    # Url account service
    const DRIVER_ONLINE_URL = 'api/v1/driver/online';
    const DRIVER_DETAIL_URL = 'api/v1/driver/detail/';
    const CUSTOMER_DETAIL_URL = 'api/v1/customer/detail/';
    const CONFIRM_DRIVER_TOKEN_URL = 'api/v1/driver/confirm-token';
    const CONFIRM_CUSTOMER_TOKEN_URL = 'api/v1/customer/confirm-token';

    # Url payment service
    const PAYMENT_URL = 'api/v1/payments/handle';
    const REFUND_URL = 'api/v1/payments/refund';

    # Url notification service
    const CREATE_DRIVER_NOTIFICATION = 'api/v1/notify/notification-driver';
    const CREATE_CUSTOMER_NOTIFICATION = 'api/v1/notify/notification-customer';
}