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
<?php if($cu == true){ ?>
    <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">Data=====></th>
            <th scope="col">20/09/2021</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Entradas</th>
            <td></td>
        </tr>
        <?php foreach($results as $result):
            if($result['tipo'] == 'entrada') {
            ?>
            <tr>
                <th scope="row" class="text-success"><?= $result['conta'] ?></th>
                <td><?= $result['valor'] ?></td>
            </tr>
        <?php } 
        endforeach; 
        ?>
        <tr>
            <th scope="row">Saídas</th>
            <td></td>
        </tr>
        <?php foreach($results as $result):
            if($result['tipo'] == 'saida') {
            ?>
            <tr>
                <th scope="row" class="text-danger"><?= $result['conta'] ?></th>
                <td><?= $result['valor'] ?></td>
            </tr>
        <?php } 
        endforeach; ?>
        </tbody>
    </table>
<?php } ?>