<?=form_open($form_url, array("method"=>"get"))?>
<div class="form-group">
    <select name="t" id="input-tahun" class="form-control">
        <option value="">Tahun</option>
        <?php foreach($tahun as $t): ?>
        <option value="<?=$t?>"><?=$t?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <select name="k" id="input-komoditas" class="form-control">
        <option value="1">Jenis Komoditas</option>
        <?php foreach($komoditas as $k): ?>
        <option value="<?=$k->id?>"><?=$k->komoditas?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <button class="btn btn-primary btn-block" type="submit">Submit</button>
</div>
<?=form_close()?>