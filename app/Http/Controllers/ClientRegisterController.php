<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class ClientRegisterController extends Controller
{
    private $client;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->client =  new Client();
    }

    public function accountPersonRegisterUser(Request $request)
    {
        $document = str_replace(['.','-','/'],'',$request->cpfCnpj);
        $birthday = date('y-m-d',strtotime($request->birthday));
        try {
            $response = $this->client->request('POST', 'https://bank.qesh.ai/users', [
                'body' => '{
                "document":"'.$document.'",
                "birth_date":"'.$birthday.'",
                "name":"'.$request->name.'",
                "email":"'.$request->email.'",
                "phone":"'.$request->phone.'",
                "password":"'.$request->password.'",
                "mother_name":"'.$request->mother_name.'"
                }',

                'headers' => [

                    'Accept' => 'application/json',

                    'Content-Type' => 'application/json',

                    'api-token' => "$request->access_token",

                ],

            ]);
            if($response->getStatusCode() == 201 || $response->getStatusCode() == 200){
                $zip_code = str_replace("-","",$request->zip_code);
                $response = $this->client->request('POST', 'https://bank.qesh.ai/users/address', [
                    'body' => '{
                    "country":"Brasil",
                    "zip_code":"'.$zip_code.'",
                    "street":"'.$request->street.'",
                    "number":"'.$request->number.'",
                    "complement":"'.$request->complement.'",
                    "neighborhood":"'.$request->neighborhood.'",
                    "city":"'.$request->city.'",
                    "state":"'.$request->state.'"
                }',

                    'headers' => [

                        'Accept' => 'application/json',

                        'Content-Type' => 'application/json',

                        'api-token' => "$request->access_token",

                        'user' => "$request->user_id",

                    ],

                ]);
            }
            return json_decode($response->getBody(),true);

        }catch (ClientException $e) {
            return $responseBody = $e->getResponse()->getBody(true);
        }

    }


    public function accountPersonRegisterAddress(Request $request)
    {
        try {
            $response = $this->client->request('POST', 'https://bank.qesh.ai/users/address', [

                'body' => '{
                "country":"Brasil",
                "zip_code":"'.$request->zip_code.'",
                "street":"'.$request->street.'",
                "number":"'.$request->number.'",
                "complement":"'.$request->complement.'",
                "neighborhood":"'.$request->neighborhood.'",
                "city":"'.$request->city.'",
                "state":"'.$request->state.'"
                }',

                'headers' => [

                    'Accept' => 'application/json',

                    'Content-Type' => 'application/json',

                    'api-token' => "$request->access_token",

                    'user' => "$request->user_id",

                ],

            ]);
            return json_decode($response->getBody(),true);
        }catch (ClientException $e) {
            return $responseBody = $e->getResponse()->getBody(true);
        }

    }


    public function accountPersonRegisterDocSelfie(Request $request)
    {
        try {
            $response = $this->client->request('POST', 'https://bank.qesh.ai/users/documents?type=SELFIE', [

                'body' => '{"file":"'.$request->file_selfie.'"}',

                'headers' => [

                    'Accept' => 'application/json',

                    'Content-Type' => 'application/json',

                    'api-token' => "$request->access_token",

                    'user' => "$request->user_id",

                ],

            ]);
            return json_decode($response->getBody(),true);
        }catch (ClientException $e) {
            return $responseBody = $e->getResponse()->getBody(true);
        }

    }


    public function accountPersonRegisterDocIdFront(Request $request)
    {
        try {
            $response = $this->client->request('POST', 'https://bank.qesh.ai/users/documents?type=IDENTITY_CARD_FRONT', [

                'body' => '{"file":"'.$request->file_id_front.'"}',

                'headers' => [

                    'Accept' => 'application/json',

                    'Content-Type' => 'application/json',

                    'api-token' => "$request->access_token",

                    'user' => "$request->user_id",

                ],

            ]);
            return json_decode($response->getBody(),true);
        }catch (ClientException $e) {
            return $responseBody = $e->getResponse()->getBody(true);
        }

    }


    public function accountPersonRegisterDocIdVerse(Request $request)
    {
        try {
            $response = $this->client->request('POST', 'https://bank.qesh.ai/users/documents?type=IDENTITY_CARD_VERSE', [

                'body' => '{"file":"'.$request->file_id_verse.'"}',

                'headers' => [

                    'Accept' => 'application/json',

                    'Content-Type' => 'application/json',

                    'api-token' => "$request->access_token",

                    'user' => "$request->user_id",

                ],

            ]);
            return json_decode($response->getBody(),true);
        }catch (ClientException $e) {
            return $responseBody = $e->getResponse()->getBody(true);
        }

    }


    public function accountPersonRegisterDocDriverFront(Request $request)
    {
        try {
            $response = $this->client->request('POST', 'https://bank.qesh.ai/users/documents?type=DRIVER_LICENSE_FRONT', [

                'body' => '{"file":"'.$request->file_driver_front.'"}',

                'headers' => [

                    'Accept' => 'application/json',

                    'Content-Type' => 'application/json',

                    'api-token' => "$request->access_token",

                    'user' => "$request->user_id",

                ],

            ]);
            return json_decode($response->getBody(),true);
        }catch (ClientException $e) {
            return $responseBody = $e->getResponse()->getBody(true);
        }

    }


    public function accountPersonRegisterDocDriverVerse(Request $request)
    {
        try {
            $response = $this->client->request('POST', 'https://bank.qesh.ai/users/documents?type=DRIVER_LICENSE_VERSE', [

                'body' => '{"file":"'.$request->file_driver_verse.'"}',

                'headers' => [

                    'Accept' => 'application/json',

                    'Content-Type' => 'application/json',

                    'api-token' => "$request->access_token",

                    'user' => "$request->user_id",

                ],

            ]);
            return json_decode($response->getBody(),true);
        }catch (ClientException $e) {
            return $responseBody = $e->getResponse()->getBody(true);
        }

    }

    public function accountPersonRegisterDocCompany(Request $request)
    {
        try {
            $response = $this->client->request('POST', 'https://bank.qesh.ai/users/documents?type=COMPANY', [

                'body' => '{"file":"'.$request->file_company.'"}',

                'headers' => [

                    'Accept' => 'application/json',

                    'Content-Type' => 'application/json',

                    'api-token' => "$request->access_token",

                    'user' => "$request->user_id",

                ],

            ]);
            return json_decode($response->getBody(),true);
        }catch (ClientException $e) {
            return $responseBody = $e->getResponse()->getBody(true);
        }

    }
}
