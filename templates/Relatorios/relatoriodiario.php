

<div  class="container-fluid d-flex align-items-center justify-content-center p-5">
<div class="cardCaixaDiario card card-outline container  p-5 "  >

    <div class="cardheaderCaixaDiario card-header" >
    <a href="/relatorios/exportCaixaDiario"><i class="fas fa-file-excel"></i></a>
    <div class="card-tools">
        <div class="input-group input-group-sm">
        <input type="text" name="table_search" class="border form-control float-right" placeholder="Pesquisar">
        <div class="input-group-append">
            <button type="submit" class="btn"><i class="fas fa-search"></i></button>
        </div>
        </div>
    </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">

        <thead class="theINDEX">
            <?= $this->Html->tableHeaders(
                ['Valor','Conta', 'Fornecedor', 'aCliente', 'Descrição'])?>
        </thead>
        <tbody class="tboINDEX">
            <?php foreach($lancamentos as $array):?>
                      <tr>
                    <?php if($array[0]<0){?>
                      <td class="text-danger"><?= $array[0] ?></td>
                      <?php }else if($array[0]>0){?>
                        <td class="text-success"><?= $array[0] ?></td>
                        <?php }else{ ?>
                            <td class="text-info"><?= $array[0] ?></td>
                <?php } ?>
                   <td> <?= $array[1] ?></td>
                   <td> <?= $array[2] ?></td>
                   <td> <?= $array[3] ?></td>
                   <td> <?= $array[4] ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
</div>
            </div>
