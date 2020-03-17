<?php

class Site {

    protected static $model_name = null;
    protected static $method_name = null;

    protected static $db = null;

    protected static $tpl = null;

   /**
    * __construct
    *
    * @return void
    */
    function __construct()
    {
        $model_name = 'main';

        $action = substr($_SERVER['REQUEST_URI'], 1);

        if( $action ) {
            if( stripos($action, '/') )
                $model_name = explode('/', $action)[0];
            else
                $model_name = $action;
        }

        self::$model_name = $model_name;

        $this->init();

        $this->print();

        exit;
    }

    /**
     * init
     *
     * @return void
     */
    private function init()
    {
        if( file_exists(MODEL_PATH .'/'. self::$model_name . '.model.php') )
            require_once MODEL_PATH .'/'. self::$model_name . '.model.php';
        else
            die('ничего не найдено');

        if( $this->isAjax() )
            $this->loadModel();
        else{

            $model = $this->getModel();
            self::$tpl = $model->read();
        }
    }

    /**
     * loadModel
     *
     * @return void
     */
    private function loadModel()
    {
        if( empty($_POST['action']) )
            die('action not found');

        $action = explode('/', $_POST['action']);

        self::$model_name = $action[0];
        self::$method_name = $action[1];

        if( !method_exists(self::$model_name, self::$method_name ) )
            die('method not exists');

        if( $this->isAjax() ){

            $return = $this->getModel()->{self::$method_name}();
            
            echo json_encode($return);

            die();
            
        } else
            $this->getModel()->{self::$method_name}();
    }

    /**
     * getModel
     *
     * @return void
     */
    private function getModel()
    {
        return new self::$model_name;
    }

    /**
     * dbConnect
     *
     * @return void
     */
    private function dbConnect()
    {
        require_once CORE_PATH.'/db.params.php';
        require_once CORE_PATH.'/db.class.php';

        $db_params = [
            'user' => DB_USER,
            'pass' => DB_PASS,
            'db' => DB_NAME,
        ];

        self::$db = new SafeMySQL($db_params);
    }

    /**
     * getDB
     *
     * @return void
     */
    public function getDB()
    {
        $this->dbConnect();

        return self::$db;
    }

    /**
     * getHeader
     *
     * @return void
     */
    private function getHeader()
    {
        ob_start();

        require_once HTML_PATH .'/header.html';

        $content = ob_get_contents();

        ob_end_clean();
        
        return $content;
    }

    /**
     * getFooter
     *
     * @return void
     */
    private function getFooter()
    {
        ob_start();

        require_once HTML_PATH .'/footer.html';

        $content = ob_get_contents();

        ob_end_clean();
        
        return $content;
    }

    /**
     * getMenu
     *
     * @return void
     */
    private function getMenu()
    {
        ob_start();

        require_once HTML_PATH .'/menu.html';

        $content = ob_get_contents();

        ob_end_clean();
        
        return $content;
    }

    /**
     * getBody
     *
     * @return void
     */
    protected function getBody()
    {
        $this->getModel()->read();

        return self::$tpl;
    }

    /**
     * print
     *
     * @return void
     */
    protected function print()
    {
        $html = $this->getHeader();
        $html = $this->getMenu();
        $html .= $this->getBody();
        $html .= $this->getFooter();
            
        print $html;
    }

    /**
     * isAjax
     *
     * @return void
     */
    protected function isAjax()
    {
        if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
            return true;

        return false;
    }
}