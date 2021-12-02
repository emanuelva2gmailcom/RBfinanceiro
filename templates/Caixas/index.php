
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caixa[]|\Cake\Collection\CollectionInterface $caixas
 */
?>

<?php $this->assign('title', __('Caixas')); ?>

<div class="card">
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead class="theINDEX">
        <tr>

          <th><?= __('N° de Caixa') ?></th>
          <th><?= __('Data do Caixa') ?></th>
          <th><?= __('Aberto') ?></th>
          <th><?= __('Criado') ?></th>
          <th><?= __('Modificado') ?></th>
          <th><?= __('Ações') ?></th>
        </tr>
      </thead>
      <tbody class="tboINDEX">
        <?php foreach ($caixas as $caixa) : ?>
          <tr>
            <td><?= $this->Number->format($caixa->id_caixa) ?></td>
            <td><?= h($caixa->data_caixa) ?></td>
            <td><?= ($caixa->is_aberto) ? __('Sim') : __('Não') ?></td>
            <td><?= h($caixa->created) ?></td>
            <td><?= h($caixa->modified) ?></td>
            <td class="actions">
              <div class="btn-group">
                <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $caixa->id_caixa], ['class' => 'btn vis btn-xs btn-outline-info', 'escape' => false]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $caixa->id_caixa], ['class' => 'btn del btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?', $caixa->id_caixa)]) ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
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
                "info": "Mostrando _END_ de _MAX_ caixas",
                "infoEmpty":      "Mostrando 0 de 0 caixas",
                "infoFiltered":   " ",
                "search": "Procurar:",
                "paginate": {
                    "first":      "Primeiro",
                    "last":       "Último",
                    "next":       "Próximo",
                    "previous":   "Anterior"
    },
},

      columns: [{
          data: 'id_caixa'
        },
        {
          data: 'data_caixa'
        },
        {
          data: 'is_aberto'
        },
        {
          data: 'created'
        },
        {
          data: 'modified'
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

