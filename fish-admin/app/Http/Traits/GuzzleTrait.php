<?php
namespace App\Http\Traits;

use GuzzleHttp\Client;

trait GuzzleTrait
{
    public function getData($baseURL)
    {
        try{
            $client = new Client();
            $response = $client->request('GET', $baseURL);

            if ($body = $response->getBody()) {
                $body->seek(0);
                return json_decode($body->read(1024));
            }
            return json_decode(json_encode([
                "status" => "error",
                "message" => "Invalid response from API."
            ]));
        } catch (\Exception $exception){
            return json_decode(json_encode([
                "status" => "error",
                "message" => $exception->getMessage()
            ]));
        }
    }
}
