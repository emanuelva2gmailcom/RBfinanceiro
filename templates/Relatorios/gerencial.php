<?php if ($show == true) { ?>
    <style>
        tr>td {
            min-width: 100px;
        }

        .text-nw {
            padding: 0px;
            margin: 0px;
            white-space: nowrap;
            overflow: auto;

        }

        .text-nr {
            padding: 0px;
            margin: 0px;
            white-space: nowrap;
            overflow: auto;
            color: #17a2b8;
            font-size: 15px;
        }



        .mwtd {
            min-width: 150px;
        }
    </style>
    <div class="container-fluid d-flex align-items-center justify-content-center p-5">
        <div class="container p-5 bg-white" style="border: 2px solid green; border-radius: 20px;">
            <div style="margin-left: 95%;">
                <?= $this->Html->link(__('Voltar'), ['action' => 'gerencial'], ['class' => 'btn btn-outline-info btn-sm mb-2'], ['style' => 'color: green;']) ?>
            </div>
            <table class="table table-bordered rounded table-responsive w-100 mt-2">
                <thead class="bg-info">
                    <tr>
                        <th scope="col"><a href=<?= "/relatorios/exportGerencial/" . implode(",", $request) ?> style="font-size: 30px;color: white;"><i class="fas fa-file-excel"></i></a></th>
                        <?php foreach ($obj['header'] as $data) : ?>
                            <th scope="col"><?= $data ?></th>
                        <?php endforeach; ?>
                        <th scope="col">Total</th>
                    </tr>

                </thead>
                <thead>
                    <tr>
                        <th scope="row" class="bg-info">
                            <p class="text-nw">Entradas: </p>
                        </th>
                        <?php foreach ($obj['total']['entradas'] as $t) :
                            if ($t < 0) { ?>
                                <td class="text-danger"><?= $t ?></td>
                            <?php } else if ($t > 0) { ?>
                                <td class="text-success"><?= $t ?></td>
                            <?php } else { ?>
                                <td class="text-info"><?= $t ?></td>
                        <?php }
                        endforeach; ?>
                    </tr>
                </thead>
                <tbody class="text-success">
                    <?php
                    foreach ($obj['rows']['td'] as $valor) :
                        if (in_array($valor[0], $obj['rows']['th']['entradas'])) {
                    ?>
                            <tr>
                                <th scope="row" class="bg-white">
                                    <p class="text-nr"><i class="fas fa-angle-right"></i> <?= $valor[0] ?></p>
                                </th>
                                <?php for ($i = 1; $i < count($valor); $i++) : ?>
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
                        <th scope="row" class="bg-info">
                            <p class="text-nw">Saídas: </p>
                        </th>
                        <?php foreach ($obj['total']['saidas'] as $t) :
                            if ($t < 0) { ?>
                                <td class="text-danger"><?= $t ?></td>
                            <?php } else if ($t > 0) { ?>
                                <td class="text-success"><?= $t ?></td>
                            <?php } else { ?>
                                <td class="text-info"><?= $t ?></td>
                        <?php }
                        endforeach; ?>
                    </tr>
                </thead>
                <tbody class="text-danger">
                    <?php
                    foreach ($obj['rows']['td'] as $valor) :
                        if (in_array($valor[0], $obj['rows']['th']['saidas'])) {
                    ?>
                            <tr>
                                <th scope="row" class="bg-white">
                                    <p class="text-nr"><i class="fas fa-angle-right"></i> <?= $valor[0] ?></p>
                                </th>
                                <?php for ($i = 1; $i < count($valor); $i++) : ?>
                                    <td><?= $valor[$i] ?></td>
                                <?php endfor; ?>
                            </tr>
                    <?php
                        }
                    endforeach;
                    ?>
                </tbody>
                <thead class="thead-light">
                    <tr>
                        <th class="bg-info" style="color: white;" scope="row">
                            <p class="text-nw"> Saldo Atual <br> (Entradas - Saídas) </p>
                        </th>
                        <?php foreach ($obj['total']['entradas-saidas'] as $t) :
                            if ($t < 0) { ?>
                                <td class="text-danger"><?= $t ?></td>
                            <?php } else if ($t > 0) { ?>
                                <td class="text-success"><?= $t ?></td>
                            <?php } else { ?>
                                <td class="text-info"><?= $t ?></td>
                        <?php }
                        endforeach; ?>
                    </tr>

                </thead>

            </table>
        </div>
    </div>
<?php } else { ?>
    <div class="container-fluid d-flex align-items-center justify-content-center p-5">
        <div class="container p-5 bg-white" style="border: 2px solid green; border-radius: 20px;">
            <?= $this->element('relatorios/gerencial', ['obj' => $gerencial]) ?>
        </div>
    </div>
    <div class="container-sm d-flex justify-content-center p-5">
        <div style="border: green 2px solid;border-radius: 20px;" class="card-sm bg-white shadow" style="width: 32rem;">
            <div class="card-body">
                <h2 style="font-size: 30px; color: green;" class="card-subtitle text-center">Pesquisa de Caixa Gerencial Avançado</h2>
                <hr class="border-info">
                <div class="form-group">
                    <?= $this->Form->create() ?>
                    <?= $this->Form->control(0, ['label' => 'Começo', 'type' => 'date'], ['class' => 'form-control']); ?>
                    <?= $this->Form->control(1, ['label' => 'Final', 'type' => 'date'], ['class' => 'form-control']); ?>
                    <label>Periodo</label><br>
                    <?= $this->Form->select(2, ['mes' => 'MÊS', 'ano' => 'ANO', 'dia' => 'DIA'], ['class' => 'form-control select2bs4']); ?>
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
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>