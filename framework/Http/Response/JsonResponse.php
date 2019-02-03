<?php
namespace Framework\Http\Response;

class JsonResponse extends Response
{
    public function __construct($data = [])
    {
        parent::__construct();
        $this->data = $data;
    }

    public function getBody():string
    {
        return (string)json_encode($this->data);
    }

}