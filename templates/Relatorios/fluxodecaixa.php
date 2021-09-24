<?php if($show == true){ ?>
<div class="card-body table-responsive p-0">
    <table class="table table-bordered bg-light">
        <thead class="bg-primary">
            <!-- <?= $this->Html->tableHeaders($datas);?> -->
            <tr>
                <th scope="col">Data=====></th>
                <?php foreach($datas as $data): ?>
                    <th scope="col"><?= $data ?></th>
                <?php endforeach; ?>
                <th scope="col">Total</th>
            </tr>
        
        </thead>
        <tbody class="text-success">
        <?php 
            foreach($valores as $valor):
                if(in_array($valor[0], $entradas)){
                ?>
                    <tr>
                        <th scope="row"><?= $valor[0] ?></th>
                        <?php for($i = 1; $i < count($valor); $i++): ?>
                            <td><?= $valor[$i] ?></td>
                        <?php endfor; ?>
                    </tr>
                <?php 
                }
            endforeach;
        ?>
        </tbody>
        <thead class="bg-primary">
            <tr>
                <th scope="row">Entradas</th>
                <?php foreach($totale as $t): ?>
                    <td><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody class="text-danger">
        <?php 
            foreach($valores as $valor):
                if(in_array($valor[0], $saidas)){
                ?>
                    <tr>
                        <th scope="row"><?= $valor[0] ?></th>
                        <?php for($i = 1; $i < count($valor); $i++): ?>
                            <td><?= $valor[$i] ?></td>
                        <?php endfor; ?>
                    </tr>
                <?php 
                }
            endforeach;
        ?>
        </tbody>
        <thead class="bg-primary">
            <tr>
                <th scope="row">Saídas</th>
                <?php foreach($totals as $t): ?>
                    <td><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
        </thead>
        <thead class="bg-dark">
            <tr class="bg-black">
                <th scope="row">ENTRADAS - SAIDAS</th>
                <?php foreach($entradas_saidas as $t): ?>
                    <td><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th scope="row">INICIAL</th>
                <?php foreach($inicial as $t): ?>
                    <td><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th scope="row">FINAL</th>
                <?php foreach($final as $t): ?>
                    <td><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
        </thead>
    </table>
</div>
<?php } else{?>
    <div class="container bg-dark">
    <div class="panel-body">
        <div class="form-group">
            <?= $this->Form->create() ?>
                <?= $this->Form->control('comeco', ['label' => 'Começo', 'type' => 'date'], ['class' => 'form-control']); ?>
                <?= $this->Form->control('final', ['label' => 'Final', 'type' => 'date'], ['class' => 'form-control']); ?>
                <?= $this->Form->button(__('Submit', ['class' => 'btn btn-dark pull-right'])) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<?php } ?>