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
}