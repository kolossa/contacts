<?php


namespace delocal\Contacts\App;


abstract class BaseController
{
    /**
     * @var Request $request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request=$request;
    }

}