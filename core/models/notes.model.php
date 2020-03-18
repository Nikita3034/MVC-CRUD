<?php

/*
    Notes page
*/
class Notes extends Site 
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
     * create
     *
     * @return void
     */
    public function create()
    {
        return $this->createFormate();
    }

    /**
     * createFormate
     *
     * @return void
     */
    private function createFormate()
    {
        $input_data = $_POST;

        $insert_data = [
            'Text' => $input_data['text'],
            'DateUpdate' => time()
        ];

        $db = $this->getDB();

        $sql = "INSERT INTO ?n SET ?u";

        $db->query($sql, 'notes', $insert_data);

        return ['status' => true];
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
        $db = $this->getDB();

        $sql = "SELECT * FROM ?n";

        $result = $db->getAll($sql, 'notes');

        if( $result ) {

            ob_start();
            
            require_once TPL_PATH . '/notes.tpl.php';

            $content = ob_get_contents();

            ob_end_clean();

        } else
            $content = 'Notes not found';

        return $content;
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        return $this->updateFormate();
    }

    /**
     * updateFormate
     *
     * @return void
     */
    private function updateFormate()
    {
        $input_data = $_POST;

        $note_id = (int) $input_data['note_id'];

        $update_data = [
            'Text' => $input_data['text'],
            'DateUpdate' => time()
        ];

        $db = $this->getDB();

        $sql = "UPDATE ?n SET ?u WHERE `ID` = ?i";

        $db->query($sql, 'notes', $update_data, $note_id);

        return  ['status' => true];
    }

    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        return $this->deleteFormate();
    }

    /**
     * deleteFormate
     *
     * @return void
     */
    private function deleteFormate()
    {
        $input_data = $_POST;

        $note_id = (int) $input_data['note_id'];

        $db = $this->getDB();

        $sql = "DELETE FROM ?n WHERE `ID` = ?i";

        $db->query($sql, 'notes', $note_id);

        return ['status' => true];
    }
}