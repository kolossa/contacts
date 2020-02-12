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
        $this->get = $get;
        $this->post = $post;
        $this->cookies = $cookies;
        $this->files = $files;
        $this->server = $server;
    }

    public function isPutRequest()
    {
        return (isset($this->server['REQUEST_METHOD']) && !strcasecmp($this->server['REQUEST_METHOD'], 'PUT'));
    }

    public function isGetRequest()
    {

        if (isset($this->server['REQUEST_METHOD'])) {
            if ($this->server['REQUEST_METHOD'] == 'GET') {
                return true;
            }
            return false;
        } else {
            return 'GET';
        }
    }

    public function getContentType()
    {
        if (isset($this->server["CONTENT_TYPE"])) {
            return $this->server["CONTENT_TYPE"];
        } elseif (isset($this->server["HTTP_CONTENT_TYPE"])) {
            return $this->server["HTTP_CONTENT_TYPE"];
        }
        return null;
    }

    public function getPut($name)
    {
        if ($this->isPutRequest()) {

            $result = array();
            $rawBody = file_get_contents('php://input');

            if (strncmp($this->getContentType(), 'application/json', 16) === 0) {
                $result = json_decode($rawBody);
                $result = (array)$result;
            } else {
                mb_parse_str($rawBody, $result);
            }

            if (isset($result[$name])) {
                return $result[$name];
            }
        }
    }
}