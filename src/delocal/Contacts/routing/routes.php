<?php

/**
 * routing array
 *
 * The key of this associative array is the route itself.
 * In the route you can set parameters inside braces.
 * The value of a route is an associative array with a keyword 'controller' key which contains the
 * controller class name with full namespace and a keyword 'action' key which is the action method name of
 * a controller class.
 */
return [
    'test/{id}' => ['controller' => 'delocal\Contacts\Controllers\TestController', 'action' => 'actionIndex'],
    'contacts/create' => ['controller' => 'delocal\Contacts\Controllers\CreateContactController', 'action' => 'actionIndex'],
    'contacts/modify' => ['controller' => 'delocal\Contacts\Controllers\ModifyContactController', 'action' => 'actionIndex'],
    'contact{id}' => ['controller' => 'delocal\Contacts\Controllers\ContactController', 'action' => 'actionIndex'],
];