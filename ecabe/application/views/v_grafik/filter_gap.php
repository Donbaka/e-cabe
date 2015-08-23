<script type="text/javascript">
$(document).ready(function () {
    $("#input-provinsi").change(function () {
        /*dropdown post *///
        $.ajax({
            url: "<?php echo site_url('lokasi/getKabKota'); ?>",
            data: {id_prov: $(this).val()},
            type: "POST",
            success: function (data) {
                $("#input-kota").html(data);
            }
        });
    });
});
</script>

<?=form_open($form_url, array("method"=>"get"))?>
<div class="form-group">
    <select id="input-provinsi" class="form-control">
        <option value="31">Provinsi</option>
         <?php foreach($provinsi as $p): ?>
            <option value="<?=$p->ID_PROVINSI?>"><?=$p->NAMA?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <select name="kota" id="input-kota" class="form-control">
        <option value="3174">Kabupaten/Kota</option>
    </select>
</div>

<div class="form-group">
    <select name="t" id="input-tahun" class="form-control">
        <option value="">Tahun</option>
        <?php foreach($tahun as $t): ?>
            <option value="<?=$t?>"><?=$t?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <select name="t" id="input-tahun" class="form-control">
        <option value="1">Bulan</option>
        <option value="1">Januari</option>
        <option value="2">Februari</option>
        <option value="3">Maret</option>
        <option value="4">April</option>
        <option value="5">Mei</option>
        <option value="6">Juni</option>
        <option value="7">Juli</option>
        <option value="8">Agustus</option>
        <option value="9">September</option>
        <option value="10">Oktober</option>
        <option value="11">Nopember</option>
        <option value="12">Desember</option>
    </select>
</div>
<div class="form-group">
    <select name="k" id="input-komoditas" class="form-control">
        <option value="1">Jenis</option>
         <?php foreach($komoditas as $k): ?>
            <option value="<?=$k->id?>"><?=$k->komoditas?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <button class="btn btn-primary btn-block" type="submit">Submit</button>
</div>
<?=form_close()?>