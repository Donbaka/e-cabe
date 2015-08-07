<script type="text/javascript">
    $(document).ready(function () {
        $("#inputProvinsi").change(function () {
            /*dropdown post *///
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/InputHarga/getKabKota",
                data: {id_prov: $(this).val()},
                type: "POST",
                success: function (data) {
                    $("#inputKotaKab").html(data);
                }
            });
        });
        $("#inputKotaKab").change(function () {
            /*dropdown post *///
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/InputHarga/getKec",
                data: {id_kabkota: $(this).val()},
                type: "POST",
                success: function (data) {
                    $("#inputKecamatan").html(data);
                }
            });
        });

        $("#inputKecamatan").change(function () {
            /*dropdown post *///
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/InputHarga/getTitik",
                data: {id_kecamatan: $(this).val()},
                type: "POST",
                success: function (data) {
                    $("#inputTitik").html(data);
                }
            });
        });
    });
</script>
<?php if(isset($alert))
{
    echo $alert;
}else{

}

?>


<div class="page-content">
    <div class="flex-grid no-responsive-future" style="height: 100%;">
        <div class="row" style="height: 100%">
            <div class="cell size-x200" id="cell-sidebar" style="background-color: #71b1d1; height: 100%">
                <ul class="sidebar">

                    <li class="active"><a href="#">
                            <span class="mif-drive-eta icon"></span>
                            <span class="title">Input Data Harga</span>

                        </a></li>

                </ul>
            </div>
            <div class="cell auto-size padding20 bg-white" id="cell-content">
                <h1 class="text-light">Input Data Harga Cabe <span class="mif-drive-eta place-right"></span></h1>
                <hr class="thin bg-grayLighter">
                <div class="grid">
                    <form method="post" action="/ecabe/index.php/inputHarga/insertHarga">
                        <div class="cell">
                            <label>Provinsi :</label>

                            <div class="input-control select full-size">
                                <select name="inputProvinsi" id="inputProvinsi" class="form-control">
                                    <?php foreach ($provinsi as $prov): ?>
                                        <option
                                            value="<?php echo $prov->ID_PROVINSI; ?>"><?php echo $prov->NAMA; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label>Kabupaten :</label>

                            <div class="input-control select full-size">
                                <select name="inputKotaKab" id="inputKotaKab" class="form-control">
                                    <option value="">Pilih Kota/Kabupaten</option>
                                </select>
                            </div>
                            <label>Kecamatan :</label>

                            <div class="input-control select full-size">
                                <select name="inputKecamatan" id="inputKecamatan" class="form-control">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                            <label>Titik Distribusi :</label>

                            <div class="input-control select full-size">
                                <select name="inputTitik" id="inputTitik">

                                        <option value="">Pilih Titik Distribusi</option>

                                </select>
                            </div>

                            <label>Komoditas</label>

                            <div class="input-control select full-size">
                                <select name="inputKomoditas" id="inputKomoditas">
                                    <?php foreach ($komoditas as $row): ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->komoditas; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label>Harga</label>

                            <div class="input-control text full-size ">
                                <input name="harga" id="harga" type="text" number="yes" required="">
                            </div>
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>