
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxosubgrupo[]|\Cake\Collection\CollectionInterface $fluxosubgrupos
 */
?>

<?php $this->assign('title', __('Subgrupos')); ?>

<div class="card">
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead class="theINDEX">
        <tr>

          <th><?= __('Subgrupo') ?></th>
          <th><?= __('Descrição') ?></th>
          <th><?= __('Grupo') ?></th>
          <th><?= __('Ações') ?></th>
        </tr>
      </thead>
      <tbody class="tboINDEX">
        <?php foreach ($fluxosubgrupos as $fluxosubgrupo) : ?>
          <tr>

            <td><?= h($fluxosubgrupo->subgrupo) ?></td>
            <td><?= h($fluxosubgrupo->descricao) ?></td>


            <td class="tdINDEX"><?= $fluxosubgrupo->has('fluxogrupo') ? $this->Html->link($fluxosubgrupo->fluxogrupo->grupo, ['controller' => 'Fluxogrupos', 'action' => 'view', $fluxosubgrupo->fluxogrupo->grupo]) : '' ?></td>
            <td class="actions">
              <div class="btn-group">
                <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $fluxosubgrupo->id_fluxosubgrupo], ['class' => 'btn vis btn-xs btn-outline-info', 'escape' => false]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fluxosubgrupo->id_fluxosubgrupo], ['class' => 'btn edi btn-xs btn-outline-success', 'escape' => false]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $fluxosubgrupo->id_fluxosubgrupo], ['class' => 'btn del btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?',  $fluxosubgrupo->subgrupo)]) ?>
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
                "info": "Mostrando _END_ de _MAX_ Subgrupos",
                "infoEmpty": "Mostrando 0 de 0 Subgrupos",
                "infoFiltered": "",
                "search": "Procurar:",
                "paginate": {
                    "first":      "Primeiro",
                    "last":       "Último",
                    "next":       "Próximo",
                    "previous":   "Anterior"
    },
},

      columns: [{
          data: 'Subgrupo'
        },
        {
          data: 'Descricao'
        },
        {
          data: 'Fluxogrupo'
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
    window.location.href = '/fluxosubgrupos/add'
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

<!-- <div class="container-fluid d-flex align-items-center justify-content-center p-5">

  <div class="card container card-outline bg-white" style="border: green solid 2px; border-radius: 20px;">

    <div class="card-header d-sm-flex" style="padding-top: 50px;">
      <h2 class="card-title">

      </h2>
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

            <th class="teste"><?= $this->Paginator->sort('Subgrupo') ?></th>
            <th class="teste"><?= $this->Paginator->sort('Descrição') ?></th>


            <th class="teste"><?= $this->Paginator->sort('Fluxogrupo') ?></th>
            <th class="actions teste"><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($fluxosubgrupos as $fluxosubgrupo) : ?>
            <TR style="color: #029BE1;">

              <td><?= h($fluxosubgrupo->subgrupo) ?></td>
              <td><?= h($fluxosubgrupo->descricao) ?></td>


              <td class="tr1"><?= $fluxosubgrupo->has('fluxogrupo') ? $this->Html->link($fluxosubgrupo->fluxogrupo->grupo, ['controller' => 'Fluxogrupos', 'action' => 'view', $fluxosubgrupo->fluxogrupo->grupo]) : '' ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $fluxosubgrupo->id_fluxosubgrupo], ['class' => 'btn btn-xs btn-outline-info', 'escape' => false]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fluxosubgrupo->id_fluxosubgrupo], ['class' => 'btn btn-xs btn-outline-success', 'escape' => false]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $fluxosubgrupo->id_fluxosubgrupo], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?',  $fluxosubgrupo->subgrupo)]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>


    <div class="card-footer d-md-flex paginator" style="color: green;">

      <div class="mr-auto" style="font-size:.8rem">
        <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} fluxos subgrupos de {{count}} no total')) ?>
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
