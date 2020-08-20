<?php

namespace Stonkeep\Clicksign;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Clicksign
{
    private $accessToken;
    private $url = '/api/v1/documents?access_token=';
    private $urlBase;
    /**
     * @var string
     */
    private $fullUrl;

    public function __construct()
    {
        try {
            $this->accessToken = env('CLICKSIGN_ACCESS_TOKEN');
            throw_if(is_null($this->accessToken), 'Não possui chave de acesso. Favor verificar');
        } catch (\Exception $e) {
            return;
        }
        //Mount base URL
        $this->urlBase = env('CLICKSIGN_DEV_MODE', true) ? env('CLICKSIGN_DEV_URL', 'https://sandbox.clicksign.com') : env('CLICKSIGN_PROD_URL', 'https://app.clicksign.com');
        //mount full url
        $this->fullUrl = $this->urlBase . $this->url . $this->accessToken;
    }

    /**
     * @param String $path
     * @param null $deadline
     * @param bool $autoClose
     * @param string $locale
     * @param bool $sequence_enabled
     * @return Response
     * @throws FileNotFoundException
     */
    public function createDocument(String $path, $deadline = null, $autoClose = true, $locale = 'pt-BR', $sequence_enabled = false)
    {
        //Verify if parameters were passed
        throw_if(!isset($path), 'Some parameters are unset');
        //Mount body
        $body = [
            "document" => [
                "path" => "/$path",
                "content_base64" => "data:application/pdf;base64," . base64_encode(Storage::get($path)),
                "deadline_at" => $deadline,
                "auto_close" => $autoClose,
                "locale" => $locale,
                "sequence_enabled" => $sequence_enabled
            ]
        ];
        return Http::post("$this->urlBase/api/v1/documents?access_token=$this->accessToken", $body);
    }

    /**
     * @param String $email
     * @param String $name
     * @param null $phoneNumber
     * @param bool $documentation
     * @param null $birthday
     * @param bool $has_documentation
     * @return Response
     * @throws \Throwable
     */
    public function createSigner(String $email, String $name, $phoneNumber = null, $documentation = false, $birthday = null, $has_documentation = false)
    {
        //Verify if parameters were passed
        throw_if(!isset($email) or !isset($name), 'Some parameters are unset');
        //Mount body
        $body = [
            "signer" => [
                "email" => $email,
                "phone_number" => $phoneNumber,
                "auths" => [
                    "email"
                ],
                "name" => $name,
                "documentation" => $documentation,
                "birthday" => $birthday,
                "has_documentation" => $has_documentation
            ]
        ];
        return Http::post("$this->urlBase/api/v1/signers?access_token=$this->accessToken", $body);
    }
}
