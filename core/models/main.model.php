<?php

/*
    Main page
*/
class Main extends Site 
{
   /**
    * __construct
    *
    * @return void
    */
    function __construct()
    {
        // return the necessary
        return true;
    }

    /**
     * read
     *
     * @return void
     */
    public function read()
    {
        return $this->readFormate();
    }

    /**
     * readFormate
     *
     * @return void
     */
    private function readFormate()
    {
        ob_start();

        require_once TPL_PATH .'/main.tpl.php';

        $content = ob_get_contents();
        
        ob_end_clean();

        return $content;
    }
}