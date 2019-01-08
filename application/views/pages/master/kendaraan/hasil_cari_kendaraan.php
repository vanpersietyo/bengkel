<?php
/**
 * Created by PhpStorm.
 * User: tipk
 * Date: 08/01/2019
 * Time: 17:10
 */
//var_dump($jenis);
?>

<div class="form-group">
    <div class="col-sm-12">
        <label>Tipe</label>
        <select autofocus="autofocus" class="form-control" name="tipe">
            <?php
            foreach ($jenis->result() as $item => $value){?>
                <option value="<?=$value->tipe?>"><?=strtoupper($value->tipe);?></option>
            <?php }
            ?>
        </select>
    </div>
</div>
