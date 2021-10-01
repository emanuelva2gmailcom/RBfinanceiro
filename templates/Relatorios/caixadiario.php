
<div  class="container-fluid d-flex align-items-center justify-content-center p-5">
<div class="card card-outline container  p-5 " style="border: green solid 2px; border-radius: 20px;" >

    <div class="card-header" >
    <div class="card-tools">
        <div class="input-group input-group-sm">
        <input type="text" name="table_search" class="form-control float-right" placeholder="">
        <div class="input-group-append">
            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
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
        <tbody>
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

