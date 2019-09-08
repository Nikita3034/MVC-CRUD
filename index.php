<?php
include_once 'core/settings.php';

try {
    $Site = new Site();
} catch( Exception $e ){
    print $e->getMessage();
}