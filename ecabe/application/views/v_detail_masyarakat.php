<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 bg-white">
        <div class="dashboard_graph">
            <div class="row x_title">
                <div class="col-md-6">
                    <h3>Detail Masyarakat</h3>
                </div>
                <div class="col-md-6">

                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <table class="table" border="0">
                    <tbody>
                        <tr>
                            <td>ID</td>
                            <td><?=$detail->id?></td>
                        </tr>
                        <tr>
                            <td>Nomor HP</td>
                            <td><?=$detail->nomor_hp?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Kontribusi</td>
                            <td><?=$detail->jumlah_kontribusi?> kontribusi</td>
                        </tr>
                        <tr>
                            <td>Jumlah Keluhan</td>
                            <td><?=$detail->jumlah_keluhan?> keluhan</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?=($detail->status == 1) ? 'active' : 'banned'?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row bg-white" style="margin-top: 10px">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="dashboard_graph">
            <div class="row x_title">
                <div class="col-md-12">
                    <h3>Daftar Kontribusi Harga</h3>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table table-responsive">
                    <thead>
                        <th>ID</th>
                        <th>Komoditas</th>
                        <th>Sentra Pasar</th>
                        <th>Harga</th>
                        <th>Timestamp</th>
                    </thead>
                    <tbody>
                    <?php foreach($kontribusi as $k): ?>
                        <tr>
                            <td><?=$k->id;?></td>
                            <td><?=$k->komoditas;?></td>
                            <td><?=$k->nama;?></td>
                            <td><?=$k->harga;?></td>
                            <td><?=$k->tanggal;?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="dashboard_graph">
            <div class="row x_title">
                <div class="col-md-12">
                    <h3>Daftar Keluhan</h3>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php 
                    if(empty($keluhan)):
                        echo 'Tidak ada keluhan.' ;
                    else: ?>
                <table class="table table-responsive">
                    <thead>
                        <th>ID</th>
                        <th>Lokasi</th>
                        <th>Subjek</th>
                        <th>Keluhan</th>
                        <th>Timestamp</th>
                    </thead>
                    <tbody>
                    <?php foreach($keluhan as $k): ?>
                        <tr>
                            <td><?=$k->id;?></td>
                            <td><?=$k->kabkota;?></td>
                            <td><?=$k->subject;?></td>
                            <td><?=$k->keluhan;?></td>
                            <td><?=$k->tanggal;?></td>                            
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 10px">
    <div class="col-md-12 col-sm-12 col-xs-12 bg-white">
        <div class="dashboard_graph">
            <div class="row x_title">
                <div class="col-md-6">
                    <h3>Peta Titik Kontribusi Masyarakat</h3>
                </div>
                <div class="col-md-6">

                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php echo $map['js']; ?>
                <?php echo $map['html']; ?>
            </div>
        </div>
    </div>
</div>