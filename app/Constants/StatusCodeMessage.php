<?php

namespace App\Constants;

class StatusCodeMessage
{
    /**
     * Get success code
     *
     * @return int[]
     */
    public static function codeSuccess(): array
    {
        return [
            self::LOGOUT_SUCCESS,
            self::DELETE_SUCCESS,
            self::IMPORT_SUCCESS,
            self::UPDATE_RECORD_SUCCESS,
            self::CREATE_RECORD_SUCCESS,
            self::CODE_OK
        ];
    }

    # Define success code
    const CODE_OK = 200;
    const LOGOUT_SUCCESS = 601;
    const DELETE_SUCCESS = 602;
    const IMPORT_SUCCESS = 603;
    const CREATE_RECORD_SUCCESS = 604;
    const UPDATE_RECORD_SUCCESS = 605;

    # Define fail code
    const CODE_FAIL = 400;
    const CODE_SYSTEM_ERROR = 402;
    const LIST_DATA_EMPTY = 403;
    const ACCOUNT_PASSWORD_INCORRECT = 404;
    const CREATE_DATA_FAIL = 405;
    const UPDATE_DATA_FAIL = 406;
    const DATA_ALREADY_EXISTS = 408;
    const DELETE_FAIL = 409;
    const DATA_NOT_EXISTS = 410;
    const BOOKING_CAR_FAIL = 411;
    const APPROVE_CAR_FAIL = 412;
    const CUSTOMER_NOT_FOUND = 413;
    const DRIVER_NOT_FOUND = 414;
    const CODE_ERROR = 500;
    const NO_NOTIFICATION = 415;

    const API_CODE_NO_CONTENT = 204;
    # Status code for transaction ride
    const CANCEL_TRANSACTION_RIDE_SUCCESS = 301;

    const NOT_FOUND_DRIVER = 330;
    const CANCEL_TRANSACTION_RIDE_FAIL = 331;
    /**
     * Code and message error
     *
     * @var string[]
     */
    public static array $message = [
        self::CODE_OK => 'Success',
        self::CODE_FAIL => 'Fail',
        self::CODE_SYSTEM_ERROR  => 'System Error !!!',
        self::LIST_DATA_EMPTY  => 'List data empty',
        self::ACCOUNT_PASSWORD_INCORRECT  => 'Password is incorrect',
        self::LOGOUT_SUCCESS  => 'Logout success',
        self::CREATE_DATA_FAIL  => 'Create data fail',
        self::UPDATE_DATA_FAIL  => 'Update data fail',
        self::DATA_ALREADY_EXISTS => 'Data already exists',
        self::DELETE_FAIL => 'Delete fail',
        self::DATA_NOT_EXISTS => 'Data not exits',
        self::DELETE_SUCCESS => 'Delete success',
        self::IMPORT_SUCCESS => 'Import success',
        self::API_CODE_NO_CONTENT => 'No content',
        self::NOT_FOUND_DRIVER => 'Not found driver',
        self::BOOKING_CAR_FAIL => 'Booking car is fail',
        self::APPROVE_CAR_FAIL => 'Transaction is fail',
        self::CANCEL_TRANSACTION_RIDE_FAIL => 'Cancel transaction ride is fail',
        self::CANCEL_TRANSACTION_RIDE_SUCCESS => 'Cancel transaction ride is success',
        self::CUSTOMER_NOT_FOUND => 'Not found customer',
        self::DRIVER_NOT_FOUND => 'Not found driver',
        self::NO_NOTIFICATION => 'No notification',
    ];

    /**
     * Get message with code error
     *
     * @param $code
     * @return string
     */
    public static function getMessage($code): string
    {
        if (!empty(self::$message[$code])) {
            return self::$message[$code];
        }

        return self::$message[self::CODE_FAIL];
    }
}
