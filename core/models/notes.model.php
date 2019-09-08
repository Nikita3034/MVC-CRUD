<?php

/*
    CRUD записей
*/
class Notes extends Site {

    function __construct(){

        self::$html_path = HTML_PATH .'/notes.html';
    }

    public function create(){

        $this->createFormate();
    }

    public function read(){

        $this->readFormate();
    }

    public function update(){

        $this->updateFormate();
    }

    public function delete(){

        $this->deleteFormate();
    }

    private function createFormate(){

        $input_data = $_POST;

        $insert_data = [
            'Text' => $input_data['text'],
            'DateUpdate' => time()
        ];

        $db = $this->getDB();

        $sql = "INSERT INTO ?n SET ?u";

        $db->query($sql, 'notes', $insert_data);
    }

    private function readFormate(){

        $db = $this->getDB();

        $sql = "SELECT * FROM ?n";

        $result = $db->getAll($sql, 'notes');

        if( $result ) {
            ob_start();
            ?>
            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Текст</th>
                        <th>Дата последнего обновления</th>
                        <th>Действия</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach( $result as $key => $value ){ ?>
                    <tr>
                        <td><?=$value['ID']?></td>
                        <td><?=$value['Text']?></td>
                        <td><?=date("d.m.Y H:i", $value['DateUpdate'])?></td>
                        <td><a class="delete-one-note" href="#" data-action="notes/delete" data-id="<?=$value['ID']?>">удалить</a></td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
            <?php
            $content = ob_get_contents();

            ob_end_clean();

        } else
            $content = 'Записей не найдено';

        $params['{{notes}}'] = $content;

        $this->setParams($params);
    }

    private function updateFormate(){

    }

    private function deleteFormate(){

        $input_data = $_POST;

        $note_id = (int) $input_data['note_id'];

        $db = $this->getDB();

        $sql = "DELETE FROM ?n WHERE `ID` = ?i";

        $db->query($sql, 'notes', $note_id);
    }
}