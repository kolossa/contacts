<?php


namespace delocal\Contacts\App;


class Request
{
    protected $get;
    protected $post;
    protected $cookies;
    protected $files;
    protected $server;

    public function __construct(array $get = [], array $post = [], array $cookies = [], array $files = [], array $server = [])
    {
        $this->get=$get;
        $this->post=$post;
        $this->cookies=$cookies;
        $this->files=$files;
        $this->server=$server;
    }

    public function isPutRequest()
    {
        return (isset($this->server['REQUEST_METHOD']) && !strcasecmp($this->server['REQUEST_METHOD'],'PUT'));
    }
}