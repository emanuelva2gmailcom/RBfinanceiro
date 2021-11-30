<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subconta[]|\Cake\Collection\CollectionInterface $subcontas
 */
?>

<?php $this->assign('title', __('Subcontas') ); ?>

<div class="card">
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead class="theINDEX">
          <tr>
              <th><?= __('Nº da Subconta') ?></th>
              <th><?= __('Subconta') ?></th>
              <th><?= __('Descrição') ?></th>
              <th><?= __('Conta') ?></th>
              <th><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody class="tboINDEX">
          <?php foreach ($subcontas as $subconta): ?>
          <tr>
            <td><?= $this->Number->format($subconta->id_subconta) ?></td>
            <td><?= h($subconta->subconta) ?></td>
            <td><?= h($subconta->descricao) ?></td>
            <td class="tdINDEX"><?= $subconta->has('conta') ? $this->Html->link($subconta->conta->id_conta, ['controller' => 'Contas', 'action' => 'view', $subconta->conta->id_conta]) : '' ?></td>
            <td class="actions">
            <div class="btn-group">
                <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $subconta->id_subconta], ['class'=>'btn vis btn-xs btn-outline-primary', 'escape'=>false]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $subconta->id_subconta], ['class'=>'btn edi btn-xs btn-outline-primary', 'escape'=>false]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $subconta->id_subconta], ['class'=>'btn del btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você deseja mesmo deletar # {0}?', $subconta->id_subconta)]) ?>
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
                "info": "Mostrando _END_ de _MAX_ subcontas",
                "infoEmpty":      "Mostrando 0 de 0 subcontas",
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
          data: 'Nº da Subconta'
        },
        {
          data: 'Subconta'
        },
        {
          data: 'Descrição'
        },
        {
          data: 'Conta'
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
                     window.location.href = '/subcontas/add'
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
