
<div  class="container-fluid d-flex align-items-center justify-content-center p-5">
<div class="card card-outline container  p-5 " style="border: green solid 2px; border-radius: 20px;" >

    <div class="card-header" >
    <a href="/relatorios/exportCaixaDiario" style="font-size: 30px;color:green;"><i class="fas fa-file-excel"></i></a>
    <div class="card-tools">
        <div class="input-group input-group-sm">
        <input type="text" name="table_search" class="border border-info form-control float-right" placeholder="Pesquisar">
        <div class="input-group-append">
            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
        </div>
        </div>
    </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">

        <thead style="color: green;">
            <?= $this->Html->tableHeaders(
                ['Valor','Conta', 'Fornecedor', 'Cliente', 'Descrição'])?>
        </thead>
        <tbody class="text-info">
            <?php
            foreach($arrays as $array):?>
                <?=$this->Html->tableCells([
                    $array,
                ]);?>
            <?php endforeach;
            ?>
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
</div>
            </div>

