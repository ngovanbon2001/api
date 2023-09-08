<?php

namespace App\Console\Commands;

use App\Constants\StatusCodeMessage;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CrondSignIn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:signIn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $response = Http::withHeaders([
                'X-CSRF-TOKEN' => csrf_token(),
            ])->post('https://ecohappygo.com/account/do-register', [
                'ismember' => 'individual',
                'FullName' => 'thanh thaam11112222',
                'UserName' => 'tsstttt1112222',
                'Password' => '12345678',
                'txtConfirmPassword' => '12345678',
                'Phone' => '088766090',
                'ref' => 'quantuyen111',
            ]);
    
            return [
                'code' => StatusCodeMessage::CODE_OK,
                'message' => StatusCodeMessage::getMessage(StatusCodeMessage::CODE_OK),
                'data' => [
                    'create' => $response
                ]
            ];
        } catch (Exception $e) {
            dd($e);
            return [
                'code'    => StatusCodeMessage::CODE_FAIL,
                'message' => $e->getMessage(),
                'data'    => [
                    'create' => $response
                ]
            ];
        }
    }
}
