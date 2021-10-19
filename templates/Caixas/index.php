<!-- <div class="card">
  <div class="card-header">
    <h3 class="card-title">Todos os lançamentos</h3>
  </div>
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead class="nm">
        <tr style="color: green;">

          <th><?= __('id_caixa') ?></th>
          <th><?= __('data_caixa') ?></th>
          <th><?= __('is_aberto') ?></th>
          <th><?= __('created') ?></th>
          <th><?= __('modified') ?></th>
          <th><?= __('Ações') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($caixas as $caixa) : ?>
          <tr style="color: #029BE1;">
            <td><?= $this->Number->format($caixa->id_caixa) ?></td>
            <td><?= h($caixa->data_caixa) ?></td>
            <td><?= ($caixa->is_aberto) ? __('Sim') : __('Não') ?></td>
            <td><?= h($caixa->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td><?= h($caixa->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td class="actions">
              <div class="btn-group">
                <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $caixa->id_caixa], ['class' => 'btn btn-xs btn-outline-info', 'escape' => false]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $caixa->id_caixa], ['class' => 'btn btn-xs btn-outline-success', 'escape' => false]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $caixa->id_caixa], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?', $caixa->id_caixa)]) ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr style="color: green;">

          <th><?= __('id_caixa') ?></th>
          <th><?= __('data_caixa') ?></th>
          <th><?= __('is_aberto') ?></th>
          <th><?= __('created') ?></th>
          <th><?= __('modified') ?></th>
          <th><?= __('Ações') ?></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
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
</script> -->

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caixa[]|\Cake\Collection\CollectionInterface $caixas
 */
?>
<style>
  .nm a {
    color: green;
  }
</style>
<?php $this->assign('title', __('Caixas')); ?>



<div class="container-fluid d-flex align-items-center justify-content-center p-5">
  <div style="border: green solid 2px; border-radius: 20px;" class="card card-outline container bg-white ">
    <div class="card-header d-sm-flex" style="padding-top: 50px;">
      <h2 class="card-title">
        <!-- -->
      </h2>
      <div class="card-toolbox">
        <?= $this->Paginator->limitControl([], null, [
          'label' => false,
          'class' => 'form-control-sm',
          'style' => 'color: #029BE1; border: 2px solid green;',
        ]); ?>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table text-nowrap">
        <thead class="nm">
          <tr style="color: green;">
            <th><?= $this->Paginator->sort('id_caixa') ?></th>
            <th><?= $this->Paginator->sort('data_caixa') ?></th>
            <th><?= $this->Paginator->sort('is_aberto') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($caixas as $caixa) : ?>
            <tr style="color: #029BE1;">
              <td><?= $this->Number->format($caixa->id_caixa) ?></td>
              <td><?= h($caixa->data_caixa) ?></td>
              <td><?= ($caixa->is_aberto) ? __('Sim') : __('Não') ?></td>
              <td><?= h($caixa->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td><?= h($caixa->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $caixa->id_caixa], ['class' => 'btn btn-xs btn-outline-info', 'escape' => false]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $caixa->id_caixa], ['class' => 'btn btn-xs btn-outline-success', 'escape' => false]) ?>
                <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $caixa->id_caixa], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?', $caixa->id_caixa)]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer d-md-flex paginator" style="color: green;">
      <div class="mr-auto" style="font-size:.8rem">
        <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} Caixas de {{count}} no total')) ?>
      </div>

      <ul class="pagination pagination-sm">
        <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
        <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
        <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
      </ul>

    </div>
    <!-- /.card-footer -->
  </div>
</div>