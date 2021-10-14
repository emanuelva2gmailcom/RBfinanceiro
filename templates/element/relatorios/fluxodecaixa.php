<style>
tr > td{
    min-width: 100px;
}

.text-nw{
    padding: 0px;
    margin: 0px;
    white-space: nowrap;
    overflow: auto;
}

.mwtd{
    min-width: 150px;
}
</style>
<div class="container table-responsive">
    <table class="table table-sm table-bordered table-white rounded">
        <thead class="bg-info">
            <tr>
                <th scope="col"><a href= "/relatorios/exportRelatorioFluxoCx/" style="font-size: 30px;color: white;"><i class="fas fa-file-excel"></i></a></th>
                <?php foreach($obj['header'] as $data):?>
                    <th scope="col"><?= $data ?></th>
                <?php endforeach; ?>
                <th scope="col">Total</th>
            </tr>

        </thead>
        <tbody class="text-success">
        <?php
            foreach($obj['rows']['td'] as $valor):
                if(in_array($valor[0], $obj['rows']['th']['entradas'])){
                ?>
                    <tr>
                        <th scope="row" class="bg-info"><p class="text-nw"><?= $valor[0] ?></p></th>
                        <?php for($i = 1; $i < count($valor); $i++): ?>
                            <td><?= $valor[$i] ?></td>
                        <?php endfor; ?>
                    </tr>
                <?php
                }
            endforeach;
        ?>
        </tbody>
        <thead>
            <tr>
                <th scope="row" class="bg-info"><p class="text-nw">Entradas</p></th>
                <?php foreach($obj['total']['entradas'] as $t):
                    if($t<0){?>
                      <td class="text-danger"><?= $t ?></td>
                <?php }else if($t>0){?>
                    <td class="text-success"><?= $t ?></td>
                <?php }else{ ?>
                    <td class="text-info"><?= $t ?></td>
                <?php } endforeach; ?>
            </tr>
        </thead>
        <tbody class="text-danger">
        <?php
            foreach($obj['rows']['td'] as $valor):
                if(in_array($valor[0], $obj['rows']['th']['saidas'])){
                ?>
                    <tr>
                        <th scope="row" class="bg-info"><p class="text-nw"><?= $valor[0] ?></p></th>
                        <?php for($i = 1; $i < count($valor); $i++): ?>
                            <td><?= $valor[$i] ?></td>
                        <?php endfor; ?>
                    </tr>
                <?php
                }
            endforeach;
        ?>
        </tbody>
        <thead>
            <tr>
                <th scope="row" class="bg-info">Saídas</th>
                <?php foreach($obj['total']['saidas'] as $t):
                    if($t<0){?>
                      <td class="text-danger"><?= $t ?></td>
                <?php }else if($t>0){?>
                    <td class="text-success"><?= $t ?></td>
                <?php }else{ ?>
                    <td class="text-info"><?= $t ?></td>
                <?php } endforeach; ?>
            </tr>
        </thead>
        <thead class="thead-light">
            <tr>
                <th style="color: #17a2b8;" scope="row">Entradas-Saídas</th>
                <?php foreach($obj['total']['entradas-saidas'] as $t):
                    if($t<0){?>
                      <td class="text-danger"><?= $t ?></td>
                <?php }else if($t>0){?>
                    <td class="text-success"><?= $t ?></td>
                <?php }else{ ?>
                    <td class="text-info"><?= $t ?></td>
                <?php } endforeach; ?>
            </tr>
            <tr>
                <th style="color: #17a2b8;" scope="row">Inicial</th>
                <?php foreach($obj['total']['inicial'] as $t):
                    if($t<0){?>
                      <td class="text-danger"><?= $t ?></td>
                <?php }else if($t>0){?>
                    <td class="text-success"><?= $t ?></td>
                <?php }else{ ?>
                    <td class="text-info"><?= $t ?></td>
                <?php } endforeach; ?>
            </tr>
            <tr>
                <th style="color: #17a2b8;" scope="row">Final</th>
                <?php foreach($obj['total']['final'] as $t):
                    if($t<0){?>
                      <td class="text-danger"><?= $t ?></td>
                <?php }else if($t>0){?>
                    <td class="text-success"><?= $t ?></td>
                <?php }else{ ?>
                    <td class="text-info"><?= $t ?></td>
                <?php } endforeach; ?>
            </tr>
        </thead>
    </table>
</div>
