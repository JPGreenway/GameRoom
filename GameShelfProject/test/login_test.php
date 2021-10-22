<?php

require_once './includes/functions.inc.php';

assert(checkEmptyLoginFields('', 'password') === true, 'checkEmptyLoginFields returns true if username is empty');

assert(checkEmptyLoginFields('test','') === true, 'checkEmptyLoginFields returns true if password is empty');

assert(checkEmptyLoginFields('test', 'password') === false, 'checkEmptyLoginFields returns false if username and password are present');

assert(checkEmptyLoginFields('test', '0') === false, 'Bug#1: checkEmptyLoginFields returns false if password is 0');

?>
