<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/25/2015
 * Time: 11:37 AM
 */
define ('MESSAGES_PER_PAGE',10);
define ('PAGINATION_INDENT',5);

require_once('Controller.php');
require_once('Model.php');
require_once('View.php');

$controller = new Controller();
$controller->run();
