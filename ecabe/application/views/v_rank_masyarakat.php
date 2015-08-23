<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 bg-white">
        <div class="dashboard_graph">

            <div class="row x_title">
                <div class="col-md-6">
                    <h3>Rank Masyarakat</h3>
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>NO HP</th>
                        <th>JUMLAH KONTRIBUSI</th>
                        <th>JUMLAH KELUHAN</th>
                        <th>STATUS</th>
                    </thead>
                    <tbody>
                        <?php foreach($masyarakat as $m): ?>
                        <tr>
                            <td>
                                <?=$m->id;?>
                            </td>
                            <td>
                                <a href="<?=site_url('dapur/masyarakat/detail/'.$m->id)?>"><?=$m->nomor_hp?></a>
                            </td>
                            <td>
                                <?=$m->jumlah_kontribusi?>
                            </td>
                            <td>
                                <?=$m->jumlah_keluhan?>
                            </td>
                            <td>
                                <?=($m->status == 1) ? 'active' : 'banned'?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>