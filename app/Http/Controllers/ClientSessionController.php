<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use PharIo\Version\Exception;
use Illuminate\Support\Facades\Validator;

class ClientSessionController extends Controller
{
    private $client;
    private $clientName;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->client =  new Client();
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function acessSessionToken()
    {
        try{
            $response = $this->client->request('POST', 'https://bank.qesh.ai/client/session', [
                'body' => '{
	                    "client_key":"'.env('CLIENT_ID').'",
	                    "client_secret":"'.env('SECRET_ID').'"
                       }',
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);
            
            return json_decode($response->getBody(),true);
            
        } catch (ClientException $e) {
            return $responseBody = $e->getResponse()->getBody(true);
        }
    }

    public function accountLogin(Request $request)
    {
        $cpfCnpj = str_replace(['.','-','/'],'',$request->cpfCnpj);

        try {
            $response = $this->client->request('POST', 'https://bank.qesh.ai/login', [
                'body' => '{
                        "client_name":"'.env('CLIENT_NAME').'",
                        "origin":"api",
                        "document":"'.$cpfCnpj.'",
                        "password":"' . $request->password . '"
                       }',
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);
          
            $data =  json_decode($response->getBody(),true);
            return  response()->json([
                'session_token' =>$data['token'],
                'accounts'=>$data['accounts'],
                "user"=>$data['user']
            ]);
        }catch (ClientException $e) {
             return $responseBody = $e->getResponse()->getBody(true);
        }
    }
    
}
