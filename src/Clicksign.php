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
            $this->accessToken = config('config.accessToken');
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
     * @throws \Throwable
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

    /**
     * @param String $document_key
     * @param null $signer_key
     * @param null $message
     * @param string $sign_as
     * @return Response
     * @throws \Throwable
     */
    public function signerToDocument(String $document_key, $signer_key, $sign_as = 'approve', $message = null)
    {
        //Verify if parameters were passed
        throw_if(!isset($document_key) or !isset($signer_key), 'Some parameters are unset');
//        $message = $message ?? "Prezado ,\nPor favor assine o documento.\n\nQualquer dúvida estou à disposição.\n\nAtenciosamente.";
        //Mount body
        $body = [
            "list" => [
                "document_key" => $document_key,
                "signer_key" => $signer_key,
                "sign_as" => $sign_as,
//                "message" => $message
            ]
        ];
        return Http::post("$this->urlBase/api/v1/lists?access_token=$this->accessToken", $body);
    }

    /**
     * @param String $document_key
     * @return Response
     * @throws \Throwable
     */
    public function visualizaDocumento(String $document_key)
    {
        //Verify if parameters were passed
        throw_if(!isset($document_key), 'Some parameters are unset');
        return Http::get("$this->urlBase/api/v1/documents/$document_key?access_token=$this->accessToken");
    }
}
