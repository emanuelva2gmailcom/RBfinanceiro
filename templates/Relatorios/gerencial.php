<?php if($show == true){ ?>
<style>
.table td{
    min-width: 100px;
}

.table th{
    min-width: 250px;
}

</style>
    <table class="table table-sm table-bordered table-dark rounded table-responsive">
        <thead class="bg-primary">
            <tr>
                <th scope="col"></th>
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
                        <th scope="row" class="bg-lightblue"><?= $valor[0] ?></th>
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
                        <th scope="row" class="bg-lightblue"><?= $valor[0] ?></th>
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
        <thead class="thead-dark">
            <tr>
                <th scope="row">ENTRADAS - SAIDAS</th>
                <?php foreach($entradas_saidas as $t): ?>
                    <td><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
        </thead>
        <div class="d-flex justify-content-start bg-light rounded-top" style="padding: 5px;">
            <a href="/relatorios/fluxodecaixa" class="btn btn-none border border-primary text-primary">Voltar</a>
        </div>
    </table>
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