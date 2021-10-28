<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore[]|\Cake\Collection\CollectionInterface $fornecedores
 */
?>

<?php $this->assign('title', __('Fornecedores')); ?>

<style>
    .tr1 a {
        color: #029BE1;
    }

    .nm a {
        color: green;
    }

    .dataTables_info{
        color: green;
    }

    .dataTables_empty{
        color: #17a2b8;
    }

    .dataTables_filter input:focus {
      color: #17a2b8;
      border: green solid 2px;

    }
    .dataTables_filter input{
      color: #17a2b8;
      border: green solid 2px;

    }

    .dataTables_filter label{
      color: #17a2b8;

    }

    .buttons-copy {
        background-color: #17a2b8;
        color: white;
        border: 1px solid #17a2b8;
        opacity: 0.7;
    }

    .buttons-copy:hover {
        background-color: white;
        color: #17a2b8;
        border: 1px solid #17a2b8;
        opacity: 0.7;
    }

    .buttons-print {
        background-color: #0099CC;
        color: white;
        border: 1px solid #0099CC;
        opacity: 0.7;
    }

    .buttons-print:hover {
        background-color: white;
        color: #0099CC;
        border: 1px solid #0099CC;
        opacity: 0.7;
    }

    .buttons-csv {
        background-color: green;
        color: white;
        border: 1px solid green;
        opacity: 0.7;
    }

    .buttons-csv:hover {
        background-color: white;
        color: green;
        border: 1px solid green;
        opacity: 0.7;
    }

    .buttons-excel {
        background-color: #006400;
        color: white;
        border: 1px solid #006400;
        opacity: 0.7;
    }

    .buttons-excel:hover {
        background-color: white;
        color: #006400;
        border: 1px solid #006400;
        opacity: 0.7;
    }

    .buttons-pdf {
        background-color: #4b4b4b;
        color: white;
        border: 1px solid #4b4b4b;
        opacity: 0.7;
    }

    .buttons-pdf:hover {
        background-color: white;
        color: #4b4b4b;
        border: 1px solid #4b4b4b;
        opacity: 0.7;
    }

    .buttons-collection {
        background-color: black;
        color: white;
        border: 1px solid black;
        opacity: 0.7;
    }

    .buttons-collection:hover {
        background-color: white;
        color: black;
        border: 1px solid black;
        opacity: 0.7;
    }

    li{
        color: #17a2b8;
    }

    li a{
        color: #17a2b8;
    }


</style>


    <div class="card">
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead class="nm">
            <tr style="color: green;">

              <th><?= __('Nome') ?></th>
              <th><?= __('CNPJ') ?></th>
              <th><?= __('Responsável') ?></th>
              <th><?= __('Endereço') ?></th>
              <th><?= __('E-mail') ?></th>
              <th><?= __('Telefone') ?></th>
              <th><?= __('Pendente') ?></th>
              <th><?= __('Ações') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($fornecedores as $fornecedore) : ?>
              <tr style="color: #029BE1;">

                <td><?= h($fornecedore->nome) ?></td>
                <td><?= h($fornecedore->cnpj) ?></td>
                <td><?= h($fornecedore->responsavel) ?></td>
                <td><?= h($fornecedore->endereco) ?></td>
                <td><?= h($fornecedore->email) ?></td>
                <td><?= h($fornecedore->telefone) ?></td>

                <td><?= ($fornecedore->is_pendente) ? __('Sim') : __('Não') ?></td>
                <td class="actions">
                  <div class="btn-group">
                    <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $fornecedore->id_fornecedor], ['class' => 'btn btn-xs btn-outline-info', 'escape' => false]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fornecedore->id_fornecedor], ['class' => 'btn btn-xs btn-outline-success', 'escape' => false]) ?>
                    <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $fornecedore->id_fornecedor], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar o fonecedor {0}?', $fornecedore->nome)]) ?>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <!-- <tfoot>
            <tr style="color: green;">

              <th><?= __('Nome') ?></th>
              <th><?= __('CNPJ') ?></th>
              <th><?= __('Responsável') ?></th>
              <th><?= __('Endereço') ?></th>
              <th><?= __('E-mail') ?></th>
              <th><?= __('Telefone') ?></th>
              <th><?= __('Is_Pendente') ?></th>
              <th><?= __('Ações') ?></th>
            </tr>
          </tfoot> -->
        </table>
      </div>
    </div>
    <script>
      $(function() {
        $("#example1").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "language": {
                "emptyTable":     "Nenhum registro disponível na tabela",
                "zeroRecords":    "Nenhum registro encontrado",
                "info": "Mostrando _START_ de _END_ dos _TOTAL_ fornecedores",
                "infoEmpty":      "Mostrando 0 de 0 dos 0 fornecedores",
                "infoFiltered":   "(filtrado do total de _MAX_ fornecedores)",
                "search": "Procurar:",
                "paginate": {
                    "first":      "Primeiro",
                    "last":       "Último",
                    "next":       "Próximo",
                    "previous":   "Anterior"
    },
},
          columns: [{
              data: 'Nome'
            },
            {
              data: 'CNPJ'
            },
            {
              data: 'Responsável'
            },
            {
              data: 'Endereço'
            },
            {
              data: 'E-mail'
            },
            {
              data: 'Telefone'
            },
            {
              data: 'Is_Pendente'
            },
            {
              data: 'Ações',
              render: function(data, type, row) {
                return type === 'export' ?
                  null :
                  data;
              }
            }
          ],
          buttons: [{
                    extend: 'copyHtml5',
                    text: 'Copiar',

                    exportOptions: {
                        orthogonal: 'export',
                        columns: function(column, data, node) {
                            if (column > 7) {
                                return false;
                            }
                            return true;
                        },
                    }
                }, "print", "csvHtml5",
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        orthogonal: 'export',
                        columns: function(column, data, node) {
                            if (column > 7) {
                                return false;
                            }
                            return true;
                        },
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        orthogonal: 'export',
                        columns: function(column, data, node) {
                            if (column > 7) {
                                return false;
                            }
                            return true;
                        },
                    }
                },
                {
              extend: 'collection',
              text: 'Mostrar Colunas',
              buttons: [ 'columnsVisibility' ],
              visibility: true
            },
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      });
    </script>

<!-- <div class="container-fluid d-flex align-items-center justify-content-center p-5">
  <div class="card container card-outline bg-white" style="border: green solid 2px; border-radius: 20px;">
    <div class="card-header d-sm-flex" style="padding-top: 50px;">
      <div class="card-toolbox">
        <?= $this->Paginator->limitControl([], null, [
          'label' => false,
          'class' => 'form-control-sm',
          'style' => 'color: #029BE1; border: 2px solid green;',
        ]); ?>
      </div>
    </div>

    <div class="card-body table-responsive p-0">
      <table class="table text-nowrap">
        <thead class="nm">
          <tr style="color: green;">

            <th class="teste"><?= $this->Paginator->sort('Nome') ?></th>
            <th class="teste"><?= $this->Paginator->sort('CNPJ') ?></th>
            <th class="teste"><?= $this->Paginator->sort('Responsável') ?></th>
            <th class="teste"><?= $this->Paginator->sort('Endereço') ?></th>
            <th class="teste"><?= $this->Paginator->sort('E-mail') ?></th>
            <th class="teste"><?= $this->Paginator->sort('Telefone') ?></th>

            <th class="teste"><?= $this->Paginator->sort('Is_Pendente') ?></th>
            <th class="actions teste"><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($fornecedores as $fornecedore) : ?>
            <tr style="color: #029BE1;">

              <td><?= h($fornecedore->nome) ?></td>
              <td><?= h($fornecedore->cnpj) ?></td>
              <td><?= h($fornecedore->responsavel) ?></td>
              <td><?= h($fornecedore->endereco) ?></td>
              <td><?= h($fornecedore->email) ?></td>
              <td><?= h($fornecedore->telefone) ?></td>

              <td><?= ($fornecedore->is_pendente) ? __('Sim') : __('Não') ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $fornecedore->id_fornecedor], ['class' => 'btn btn-xs btn-outline-info', 'escape' => false]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fornecedore->id_fornecedor], ['class' => 'btn btn-xs btn-outline-success', 'escape' => false]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $fornecedore->id_fornecedor], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar o fonecedor {0}?', $fornecedore->nome)]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>


    <div class="card-footer d-md-flex paginator" style="color: green;">
      <div class="mr-auto" style="font-size:.8rem">
        <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} Fornecedores de {{count}} no total')) ?>
      </div>
      <ul class="pagination pagination-sm">
        <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
        <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
        <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
      </ul>

    </div>

  </div>
</div> -->
