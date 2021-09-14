<?php
$this->assign('title', __('Fluxo de caixa'));
?>

<div class="card card-primary" style="width: 100%; height: 100vh;">
    <div class="card-header">
        <h3 class="card-title">Quick Example</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form">
        <div class="card-body">
            <div class="form-group">
                <label>Periodo</label>
                <?= $this->Form->select('periodo', ['', 'mes' => 'Mês', 'ano' => 'Ano', 'dia' => 'Dia']); ?>
            </div>
            <div class="form-group">
                <label>Começo</label>
                <input type="date" class="form-control" placeholder="Inicio" name="comeco">
            </div>
            <div class="form-group">
                <label>Final</label>
                <input type="date" class="form-control" placeholder="Final" name="final">
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<div class="container bg-white" style="width: 100%; height: 100vh; margin: 0px; padding: 0">
    <?php
    $date = ['Data', $array['comeco'], $array['final']];
    debug($array); 
    ?>
    <table class="table table-hover text-nowrap">
        <thead>
            <?= $this->Html->tableHeaders(
                $date,
            );?>
        </thead>
        <thead>
            <?= $this->Html->tableHeaders(
                ['Entrada'],
            );?>
        </thead>
        <tbody>
            <?=
            $this->Html->tableCells([
                ['Jul 7th, 2007'],
                ['Jun 21st, 2007'],
                ['Aug 1st, 2006'],
            ]);?>
        </tbody>
        <thead>
            <?= $this->Html->tableHeaders(
                ['Saida'],
            );?>
        </thead>
        <tbody>
            <?=
            $this->Html->tableCells([
                ['Jul 7th, 2007'],
                ['Jun 21st, 2007'],
                ['Aug 1st, 2006'],
            ]);?>
        </tbody>
    </table>
</div>