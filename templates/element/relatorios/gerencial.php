    <style>
tr > td{
    max-width: 100px;
}

.text-nw{
    padding: 0px;
    margin: 0px;
    white-space: nowrap;
    overflow: auto;
}

.mwtd{
    max-width: 150px;
}

</style>
<div class="container table-responsive">
    <table class="table table-sm table-bordered table-white rounded">
        <thead class="bg-info">
            <tr>
                <th scope="col" class="mwtd"></th>
                <?php foreach($obj['header'] as $data): ?>
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
                        <th scope="row" class="bg-lightblue"><p class="text-nw"><?= $valor[0] ?></p></th>
                        <?php for($i = 1; $i < count($valor); $i++): ?>
                            <td><?= $valor[$i] ?></td>
                        <?php endfor; ?>
                    </tr>
                <?php
                }
            endforeach;
        ?>
        </tbody>
        <thead class="bg-info">
            <tr>
                <th scope="row" class="mwtd"><p class="text-nw">Entradas</p></th>
                <?php foreach($obj['total']['entradas'] as $t): ?>
                    <td><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody class="text-danger">
        <?php
            foreach($obj['rows']['td'] as $valor):
                if(in_array($valor[0], $obj['rows']['th']['saidas'])){
                ?>
                    <tr>
                        <th scope="row" class="bg-lightblue"><p class="text-nw"><?= $valor[0] ?></p></th>
                        <?php for($i = 1; $i < count($valor); $i++): ?>
                            <td><?= $valor[$i] ?></td>
                        <?php endfor; ?>
                    </tr>
                <?php
                }
            endforeach;
        ?>
        </tbody>
        <thead class="bg-info">
            <tr>
                <th scope="row" class="mwtd">Saídas</th>
                <?php foreach($obj['total']['entradas'] as $t): ?>
                    <td><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
        </thead>
        <thead class="thead-light">
            <tr>
                <th style="color: #17a2b8;" scope="row">ENTRADAS - SAIDAS</th>
                <?php foreach($obj['total']['entradas-saidas'] as $t): ?>
                    <td class="bg-info"><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
        </thead>
    </table>
</div>
