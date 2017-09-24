<div id="order-form-inventory" style="display:none;">
    <!-- inventories number -->
    <table class="margin-top-15">
        <tr>
            <th width="30">
                <input type="radio" disabled="disabled" />
            </th>
            <th width="115">Инвент. номер</th>
            <th>Наименование</th>
            <th width="200">Примечание</th>
            <th>Рейтинг</th>
        </tr>
            <? foreach ($inventories as $inventory): ?>
                <tr>
                    <td>
                        <input type="radio" name="inventory" inv_num="<?=$inventory->number?>" category="<?=$inventory->category?>" />
                    </td>
                    <td class="text-center">
                       <?=$inventory->number?> 
                    </td>
                    <td class="text-center">
                       <?=$inventory->name?> 
                    </td>
                    <td class="text-center">
                       <?=$inventory->id?> 
                    </td>
                    <td class="text-center">
                       <?=$inventory->rating?> 
                    </td>
                </tr>
            <? endforeach; ?>  
    </table>        
</div>

