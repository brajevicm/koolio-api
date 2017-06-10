<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 10/06/17
 * Time: 1:44 PM
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');

require '../posts_functions.php';

echo getTopCommented();
