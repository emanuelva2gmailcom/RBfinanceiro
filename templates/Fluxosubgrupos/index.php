
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxosubgrupo[]|\Cake\Collection\CollectionInterface $fluxosubgrupos
 */
?>

<?php $this->assign('title', __('Subgrupos')); ?>
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

    .buttons-copy{
        background-color: #17a2b8;
        color: white;
        border: 1px solid #17a2b8;
        opacity: 0.7;
    }

    .buttons-copy:hover{
        background-color: white;
        color: #17a2b8;
        border: 1px solid #17a2b8;
        opacity: 0.7;
    }

    .buttons-excel{
        background-color: green;
        color: white;
        border: 1px solid green;
        opacity: 0.7;
    }

    .buttons-excel:hover{
        background-color: white;
        color: green;
        border: 1px solid green;
        opacity: 0.7;
    }

    .buttons-pdf{
        background-color: black;
        color: white;
        border: 1px solid black;
        opacity: 0.7;
    }

    .buttons-pdf:hover{
        background-color: white;
        color: black;
        border: 1px solid black;
        opacity: 0.7;
    }


</style>

<div class="card">
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead class="nm">
        <tr style="color: green;">

          <th><?= __('Subgrupo') ?></th>
          <th><?= __('Descrição') ?></th>
          <th><?= __('Grupo') ?></th>
          <th><?= __('Ações') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($fluxosubgrupos as $fluxosubgrupo) : ?>
          <TR style="color: #029BE1;">

            <td><?= h($fluxosubgrupo->subgrupo) ?></td>
            <td><?= h($fluxosubgrupo->descricao) ?></td>


            <td class="tr1"><?= $fluxosubgrupo->has('fluxogrupo') ? $this->Html->link($fluxosubgrupo->fluxogrupo->grupo, ['controller' => 'Fluxogrupos', 'action' => 'view', $fluxosubgrupo->fluxogrupo->grupo]) : '' ?></td>
            <td class="actions">
              <div class="btn-group">
                <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $fluxosubgrupo->id_fluxosubgrupo], ['class' => 'btn btn-xs btn-outline-info', 'escape' => false]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fluxosubgrupo->id_fluxosubgrupo], ['class' => 'btn btn-xs btn-outline-success', 'escape' => false]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $fluxosubgrupo->id_fluxosubgrupo], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?',  $fluxosubgrupo->subgrupo)]) ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <!-- <tfoot>
        <tr style="color: green;">

          <th><?= __('Subgrupo') ?></th>
          <th><?= __('Descricao') ?></th>
          <th><?= __('Fluxogrupo') ?></th>
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
                "info": "Mostrando _START_ de _END_ dos _TOTAL_ subgrupos",
                "infoEmpty":      "Mostrando 0 de 0 dos 0 subgrupos",
                "infoFiltered":   "(filtrado do total de _MAX_ subgrupos)",
                "search": "Procurar:",
                "paginate": {
                    "first":      "Primeiro",
                    "last":       "Último",
                    "next":       "Próximo",
                    "previous":   "Depois"
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
        },
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
        }
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
