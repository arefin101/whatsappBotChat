<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/message', function() {
    // show a form
    return view('message');
});

Route::post('/message', function(Request $request) {
    // TODO: validate incoming params first!

    $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
    $params = ["to" => ["type" => "whatsapp", "number" => $request->input('number')],
        "from" => ["type" => "whatsapp", "number" => "14157386170"],
        "message" => [
            "content" => [
                "type" => "text",
                "text" => "Say 'Hi' to know further procces
                            Or 
                            write 'Info' to know more information"
            ]
        ]
    ];
    //Hello from Vonage and Laravel :) Please reply to this message with a number between 1 and 100
    $headers = ["Authorization" => "Basic " . base64_encode("0b07d6ec:wkvfJQvUiONTz0bh")];

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
    $data = $response->getBody();
    Log::Info($data);

    return view('thanks');
});

Route::post('/webhooks/status', function(Request $request) {
    $data = $request->all();
    Log::Info($data);
});

Route::post('/webhooks/inbound', function(Request $request) {
    $data = $request->all();

    $text = $data['message']['content']['text'];
    $number = intval($text);
    Log::Info($number);
    if($number > 0) {
        $number2 = 5;
        Log::Info($number);
        $respond_number = $number * $number2;
        Log::Info($respond_number);
        $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
        $params = ["to" => ["type" => "whatsapp", "number" => $data['from']['number']],
            "from" => ["type" => "whatsapp", "number" => "14157386170"],
            "message" => [
                "content" => [
                    "type" => "text",
                    "text" => "The answer is " . $respond_number . ", we multiplied by 5"
                ]
            ]
        ];
        $headers = ["Authorization" => "Basic " . base64_encode("0b07d6ec:wkvfJQvUiONTz0bh")];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
        $data = $response->getBody();
    }else if($text == 'Hi' || $text == 'hi'){
        $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
        $params = ["to" => ["type" => "whatsapp", "number" => $data['from']['number']],
            "from" => ["type" => "whatsapp", "number" => "14157386170"],
            "message" => [
                "content" => [
                    "type" => "text",
                    "text" => "Please reply to this message with a number and see magic"
                ]
            ]
        ];
        $headers = ["Authorization" => "Basic " . base64_encode("0b07d6ec:wkvfJQvUiONTz0bh")];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
        $data = $response->getBody();
    }else if($text == 'info' || $text == 'Info'){
        $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
        $params = ["to" => ["type" => "whatsapp", "number" => $data['from']['number']],
            "from" => ["type" => "whatsapp", "number" => "14157386170"],
            "message" => [
                "content" => [
                    "type" => "text",
                    "text" => "Info:
                               # How is it working?
                               # Do You have any server for testing message?
                               # Who are the Developers?
                               #  Who is your honorable faculty?
                            *** Just copy and paste if you have any query"
                ]
            ]
        ];
        $headers = ["Authorization" => "Basic " . base64_encode("0b07d6ec:wkvfJQvUiONTz0bh")];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
        $data = $response->getBody();
    }else if($text == 'Do You have any server for testing message?'){
        $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
        $params = ["to" => ["type" => "whatsapp", "number" => $data['from']['number']],
            "from" => ["type" => "whatsapp", "number" => "14157386170"],
            "message" => [
                "content" => [
                    "type" => "text",
                    "text" => "YES, This is the link:
                    http://127.0.0.1:4040/inspect/http"
                ]
            ]
        ];
        $headers = ["Authorization" => "Basic " . base64_encode("0b07d6ec:wkvfJQvUiONTz0bh")];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
        $data = $response->getBody();
    }else if($text == 'Who are the Developers?'){
        $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
        $params = ["to" => ["type" => "whatsapp", "number" => $data['from']['number']],
            "from" => ["type" => "whatsapp", "number" => "14157386170"],
            "message" => [
                "content" => [
                    "type" => "text",
                    "text" => "Developers:
                               1. Md. Shamsul Arefin Khan
                               2. Shampa Rani Sarker"
                ]
            ]
        ];
        $headers = ["Authorization" => "Basic " . base64_encode("0b07d6ec:wkvfJQvUiONTz0bh")];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
        $data = $response->getBody();
    }else if($text == 'Who is your honorable faculty?'){
        $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
        $params = ["to" => ["type" => "whatsapp", "number" => $data['from']['number']],
            "from" => ["type" => "whatsapp", "number" => "14157386170"],
            "message" => [
                "content" => [
                    "type" => "text",
                    "text" => "Faculty:
                                Dr. Kamruddin NUR"
                ]
            ]
        ];
        $headers = ["Authorization" => "Basic " . base64_encode("0b07d6ec:wkvfJQvUiONTz0bh")];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
        $data = $response->getBody();
    }else if($text == 'How is it working?'){
        $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
        $params = ["to" => ["type" => "whatsapp", "number" => $data['from']['number']],
            "from" => ["type" => "whatsapp", "number" => "14157386170"],
            "message" => [
                "content" => [
                    "type" => "text",
                    "text" => "This system receives incoming webhooks for two-way messaging communication. We usually use Ngrok for this; it's an excellent tool."
                ]
            ]
        ];
        $headers = ["Authorization" => "Basic " . base64_encode("0b07d6ec:wkvfJQvUiONTz0bh")];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
        $data = $response->getBody();
    }else{
        $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
        $params = ["to" => ["type" => "whatsapp", "number" => $data['from']['number']],
            "from" => ["type" => "whatsapp", "number" => "14157386170"],
            "message" => [
                "content" => [
                    "type" => "text",
                    "text" => "Invalid Message"
                ]
            ]
        ];
        $headers = ["Authorization" => "Basic " . base64_encode("0b07d6ec:wkvfJQvUiONTz0bh")];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
        $data = $response->getBody();
    }
    Log::Info($data);
});
