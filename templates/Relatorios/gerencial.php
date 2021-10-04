<?php if($show == true){ ?>
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
<div class="container">
    <table class="table table-sm table-bordered table-dark rounded table-responsive w-100">
        <thead class="bg-primary">
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
        <thead class="bg-primary">
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
        <thead class="bg-primary">
            <tr>
                <th scope="row" class="mwtd">Saídas</th>
                <?php foreach($obj['total']['saidas'] as $t): ?>
                    <td><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
        </thead>
        <thead class="thead-dark">
            <tr>
                <th scope="row">ENTRADAS - SAIDAS</th>
                <?php foreach($obj['total']['entradas-saidas'] as $t): ?>
                    <td><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th scope="row">INICIAL</th>
                <?php foreach($obj['total']['inicial'] as $t): ?>
                    <td><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th scope="row">FINAL</th>
                <?php foreach($obj['total']['final'] as $t): ?>
                    <td><?= $t ?></td>
                <?php endforeach; ?>
            </tr>
        </thead>
        <div class="d-flex justify-content-start bg-light rounded-top" style="padding: 5px;">
            <a href="/relatorios/gerencial" class="btn btn-none border border-primary text-primary">Voltar</a>
        </div>
    </table>
</div>
<?php } else{?>
    <div class="container-sm d-flex justify-content-center p-5">
    <div style="border: green 2px solid;border-radius: 20px;" class="card-sm bg-white shadow" style="width: 32rem;">
        <div class="card-body">
        <h2 style="font-size: 30px; color: green;" class="card-subtitle text-center">Pesquisa de Caixa Gerencial Avançado</h2>
        <hr class="border-info">
            <div class="form-group">
                <?= $this->Form->create() ?>
                    <?= $this->Form->control(0,['label' => 'Começo', 'type' => 'date'], ['class' => 'form-control']); ?>
                    <?= $this->Form->control(1,['label' => 'Final', 'type' => 'date'], ['class' => 'form-control']); ?>
                    <label>Periodo</label><br>
                    <?= $this->Form->select(2,['mes'=> 'mês','ano' => 'ano','dia' => 'dia'], ['class' => 'form-control select2bs4']); ?>
                        <!-- <label>Periodo</label>
                        <select name=2 class="form-control select2bs4">
                            <option value="mes" selected="selected">mês</option>
                            <option value="ano">ano</option>
                            <option value="dia">dia</option>
                        </select> -->
                </div>
            </div>
            <div class="d-flex justify-content-end card-footer">
                <?= $this->Form->button(__('Submit', ['class' => 'btn btn-dark pull-right'])) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<script>
    $('.select2bs4').select2({theme: 'bootstrap4'})
</script>
