<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Conta[]|\Cake\Collection\CollectionInterface $contas
 */
?>

<?php $this->assign('title', __('Contas') ); ?>

<div class="card">
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead class="theINDEX">
          <tr>
              <th><?= __('Nº da Conta') ?></th>
              <th><?= __('Conta') ?></th>
              <th><?= __('Descrição') ?></th>
              <th><?= __('Subgrupo') ?></th>
              <th><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody class="tboINDEX">
          <?php foreach ($contas as $conta): ?>
          <tr>
            <td><?= $this->Number->format($conta->id_conta) ?></td>
            <td><?= h($conta->conta) ?></td>
            <td><?= h($conta->descricao) ?></td>
            <td class="tdINDEX"><?= $conta->has('subgrupo') ? $this->Html->link($conta->subgrupo->id_subgrupo, ['controller' => 'Subgrupos', 'action' => 'view', $conta->subgrupo->id_subgrupo]) : '' ?></td>
            <td class="actions">
            <div class="btn-group">
                <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $conta->id_conta], ['class'=>'btn vis btn-xs btn-outline-primary', 'escape'=>false]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $conta->id_conta], ['class'=>'btn edi btn-xs btn-outline-primary', 'escape'=>false]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $conta->id_conta], ['class'=>'btn del btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você deseja mesmo deletar # {0}?', $conta->id_conta)]) ?>
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
                "info": "Mostrando _START_ de _END_ dos _TOTAL_ contas",
                "infoEmpty":      "Mostrando 0 de 0 dos 0 contas",
                "infoFiltered":   "(filtrado do total de _MAX_ contas)",
                "search": "Procurar:",
                "paginate": {
                    "first":      "Primeiro",
                    "last":       "Último",
                    "next":       "Próximo",
                    "previous":   "Anterior"
    },
},

      columns: [{
          data: 'Nº da Conta'
        },
        {
          data: 'Conta'
        },
        {
          data: 'Descrição'
        },
        {
          data: 'Subgrupo'
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

                text: 'Adicionar',
                className: 'addINDEX',
                action: function(){
                     window.location.href = '/contas/add'
                }

},
{
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
