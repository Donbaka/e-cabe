<?php echo $map['js']; ?>

<div class="page-content">
    <div class="flex-grid no-responsive-future" style="height: 100%;">
        <div class="row" style="height: 100%">
            <div class="cell auto-size padding10 bg-white">
                <h1 class="text-light">Peta Lokasi Pasar di Indonesia <span class="mif-drive-eta place-right"></span></h1>
                <div name="tes2">
                    <hr class="thin bg-grayLighter">
                    <button class="button primary" onclick="pushMessage('info')"><span class="mif-plus"></span> Create...</button>
                    <button class="button success" onclick="pushMessage('success')"><span class="mif-play"></span> Start</button>
                    <button class="button warning" onclick="pushMessage('warning')"><span class="mif-loop2"></span> Restart</button>
                    <button class="button alert" onclick="pushMessage('alert')">Stop all machines</button>
                    <hr class="thin bg-grayLighter">
                </div>
                <div>
                	<?php echo $map['html']; ?>
                </div>
            </div>
        </div>
    </div>
</div>
            