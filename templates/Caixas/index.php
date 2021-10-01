<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caixa[]|\Cake\Collection\CollectionInterface $caixas
 */
?>
<style>
    .nm a{
        color: green;
    }
</style>
<?php $this->assign('title', __('Caixas') ); ?>



<div style="height: 100vh;" class="container-fluid d-flex align-items-center justify-content-center p-5">
 <div style="border: green solid 2px; border-radius: 20px;" class="card card-outline container bg-white ">
  <div class="card-header d-sm-flex" style="padding-top: 50px;">
    <h2 class="card-title"><!-- --></h2>
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
          ]); ?>
      <?= $this->Html->link(__('Novo Caixa'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
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
          <?php foreach ($caixas as $caixa): ?>
          <tr style="color: #029BE1;">
            <td><?= $this->Number->format($caixa->id_caixa) ?></td>
            <td><?= ($caixa->data_caixa) ?></td>
            <td><?= ($caixa->is_aberto) ? __('Sim') : __('Não') ?></td>
            <td><?= h($caixa->created) ?></td>
            <td><?= h($caixa->modified) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $caixa->id_caixa], ['class'=>'btn btn-xs btn-outline-info', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $caixa->id_caixa], ['class'=>'btn btn-xs btn-outline-success', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $caixa->id_caixa], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você quer mesmo deletar {0}?', $caixa->id_caixa)]) ?>
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
      <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape'=>false]) ?>
      <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape'=>false]) ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape'=>false]) ?>
      <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape'=>false]) ?>
    </ul>

  </div>
  <!-- /.card-footer -->
 </div>
</div>
