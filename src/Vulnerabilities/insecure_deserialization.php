<?php

$user_data = unserialize($_COOKIE['data']);

if ($user_data->isAdmin === true) {
// allow access to admin interface
}
