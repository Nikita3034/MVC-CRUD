<?php

/*
    Главная страница
*/
class Main extends Site {

    function __construct(){

        self::$html_path = HTML_PATH .'/main.html';
    }

    public function read(){

        $this->readFormate();
    }

    private function readFormate(){

        $params['{{title}}'] = 'Главная страница';

        $this->setParams($params);
    }
}