<form class="ajax-form-submit" action="/notes/create" method="POST">
    <input type="hidden" name="action" value="notes/create">
    <input type="text" name="text" placeholder="Текст">
    <input type="submit" value="Добавить">
</form>

<div>
    
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
            <tr data-entity="notes">
                <td>
                    <?=$value['ID']?>
                </td>
                <td>
                    <form>
                        <input type="text" name="text" value="<?=$value['Text']?>">
                    </form>
                </td>
                <td>
                    <?=date("d.m.Y H:i", $value['DateUpdate'])?>
                </td>
                <td>
                    <a href="#" class="actions-one-note" data-action="update" data-id="<?=$value['ID']?>">изменить</a>
                    <a href="#" class="actions-one-note" data-action="delete" data-id="<?=$value['ID']?>">удалить</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </table>

</div>