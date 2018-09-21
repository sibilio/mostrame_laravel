<?php
namespace App\BaseApp\JWT;

/**
 * A classe JWT é utilizada para criar um token jwt, para decodificar e checar o token usamos
 * a classe DecodeJwt.
 */
class JWT
{
    private $secureKey;
    private $header;
    private $payload;
    private $signature;
    private $token;

    public function __construct($secureKey)
    {
        $this->secureKey = $secureKey;
    }
    
    /**
     * Passa o header para a criação do token, caso não seja passado valor utiiza
     * como padrão o formato do exemplo.
     * Exemplo: 
     * $array = ['alg'=>'HS256', 'typ'=>'JWT'];
     * @param Array $array Array com o header.
     */
    public function setHeader($array=null)
    {
        if(is_null($array)){
            $array = [
                'alg' => 'HS256',
                'typ' => 'JWT'
            ];
        }
        
        $this->header = $array;
    }
    
    /**
     * Passa o payload para a criação do token
     * Exemplo: 
     * $array = ['iss'=>'seu.dominio', 'exp'=>time()+3600, 'user'=>'user@gmail.com, 'name'=>'Nome'];
     * @param Array $array Array com o payload.
     */
    public function setPayload($array)
    {
        $this->payload = $array;
    }
    
    /**
     * Cria o token JWT com o header e o payload que devem ser setados antes, e
     * utiliza $secret que é passado através do construtor na inicialização do
     * objeto.
     * @return String token JWT criado
     */
    public function createToken()
    {
        $encodeString = base64_encode(json_encode($this->header));
        $encodeString .= ".".base64_encode(json_encode($this->payload));
        $encodeString = hash_hmac('sha256', $encodeString, $this->secureKey, true);
        
        $this->token = $this->getEncodedHeader().".".$this->getEncodedPayload().".".base64_encode($encodeString);
        
        return $this->token;
    }
    
    /**
     * Retorna o token criado
     * @return String
     */
    public function getToken()
    {
        return $this->token;
    }
    
    /**
     * Codifica o array $this->header para a criação da primeira parte do
     * token JWT
     * @param String $header pode ser usado para codificar um header qualquer diferente
     * do header original.
     * @return String
     */
    protected function getEncodedHeader($header=null)
    {
        if(is_null($header)){
            $header = $this->header;
        }
        return base64_encode(json_encode($header));
    }
    
     /**
     * Codifica o array $this->payload para a criação da segunda parte do
     * token JWT
     * @param String $payload pode ser usado para codificar um payload qualquer diferente
     * do payload original.
     * @return String
     */
    protected function getEncodedPayload($payload=null)
    {
        if(is_null($payload)){
            $payload = $this->payload;
        }
        return base64_encode(json_encode($payload));
    }     
}