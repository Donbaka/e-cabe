<?=form_open($form_url, array("method"=>"get"))?>
    <div class="grid">
        <div class="row cells4">
            <div class="cell">
                <div class="input-control text full-size">
                    <h5>Filter:</h5>
                </div>
            </div>
            <div class="cell">
                <div class="input-control select full-size">
                    <select name="t" id="input-tahun" class="form-control">
                        <option value="">Tahun</option>
                        <?php foreach($tahun as $t): ?>
                            <option value="<?=$t?>"><?=$t?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="cell colspan2">
                <div class="input-control select full-size">
                    <select name="k" id="input-komoditas" class="form-control">
                        <option value="1">Jenis</option>
                         <?php foreach($komoditas as $k): ?>
                            <option value="<?=$k->id?>"><?=$k->komoditas?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="cell colspan2">
                <div class="input-control select full-size">
                    <select name="p" id="input-provinsi" class="form-control">
                        <option value="11">Provinsi</option>
                         <?php foreach($provinsi as $p): ?>
                            <option value="<?=$p->ID_PROVINSI?>"><?=$p->NAMA?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="cell">
                <div class="input-control full-size">
                    <button class="button primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
<?=form_close()?>