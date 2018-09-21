<?php
namespace App\BaseApp\JWT;

/*
 * Decodifica JWT recebido do cliente
 */
class DecodeJwt
{        
    private $token;
    private $secret;
    private $payload;
    private $header;
    
    /**
     * 
     * @param String $token recebido do cliente
     * @param String $secret utilizado para gerar a assinatura válida. Deve ser
     * o mesmo com o qual o token foi criado caso contrário a checagem irá falhar
     * (e deve mesmo falhar)
     */
    public function __construct($token, $secret)
    {
        $this->token = $token;
        $this->secret = $secret;
        $this->decodeHeader();
        $this->decodePayload();
    }
    
    /*
     * Decodifica o header do JWT
     */
    private function decodeHeader()
    {
        $encodedArray = explode(".", $this->token);
        $header = $encodedArray[0];
        
        $header = base64_decode($header);
        $header = json_decode($header, true);
        $this->header = $header;
    }
    
    /*
     * Decodifica o payload do JWT
     */
    private function decodePayload()
    {
        $encodedArray = explode(".", $this->token);
        $payload = $encodedArray[1];
        
        $payload = base64_decode($payload);
        $payload = json_decode($payload, true);
        $this->payload = $payload;
    }
    
    /**
     * Decodifica o header do token recebido
     * @return Array header decodificado.
     */
    public function getHeader()
    {
        return $this->header;
    }
    
    /**
     * Decodifica o payload do token recebido
     * @return Array payload decodificado
     */
    public function getPayload()
    {
        return $this->payload;
    }
    
    /**
     * Checa se o token está expirado e se a assinatura do token é válida, caso
     * o token seja inválido retorna FALSE e TRUE caso seja válido
     * @return Boolean
     */
    public function tokenIsValid()
    {
        $validSignature = false;
        $tokenExpired = true;
        
        //verifica se a assinatura do token é válida
        $validSignature = $this->validSignature();
        
        //Verifica se o token está expirado
        $tokenExpired = $this->tokenExpired();
        
        return ($validSignature && !$tokenExpired);
    }
    
    /**
     * Checa se o tempo de validade do token ainda é válido
     * @return boolean
     */
    public function tokenExpired()
    {
        if(!array_key_exists("exp", $this->payload)){
            return false;
        }
        
        if($this->payload['exp'] < time()){
            return true;
        } else{
            return false;
        }
    }
    
    /**
     * Checa se a assinatura do token é válida
     * @return Boolean
     */
    public function validSignature()
    {
        $jwt = new JWT($this->secret);
        $jwt->setHeader($this->header);
        $jwt->setPayload($this->payload);
        $jwt->createToken();
        
        return ($this->token === $jwt->getToken());
    }
    
}

