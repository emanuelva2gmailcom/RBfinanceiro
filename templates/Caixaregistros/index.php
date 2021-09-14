<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caixaregistro[]|\Cake\Collection\CollectionInterface $caixaregistros
 */
?>
<?php
$this->assign('title', __('Caixa Registro') );
?>
<style>
  .teste{
    color: #E1E7F0;
  }
</style>
<div class="card card-primary card-outline bg-dark">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><!-- --></h2>
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
          ]); ?>
      <?= $this->Html->link(__('Novo Caixa Registro'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table  text-nowrap">
        <thead>
          <tr>
              <th class="teste"><?= ('Tipo de Pagamento') ?></th>
              <th class="teste"><?= ('Lançamento') ?></th>
              <th class="actions teste"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($caixaregistros as $caixaregistro): ?>
          <tr>
            <td><?= $caixaregistro->has('tipopagamento') ? $this->Html->link($caixaregistro->tipopagamento->nome, ['controller' => 'Tipopagamentos', 'action' => 'view', $caixaregistro->tipopagamento->nome]) : '' ?></td>
            <td><?= $caixaregistro->has('lancamento') ? $this->Html->link($caixaregistro->lancamento->id_lancamento, ['controller' => 'Lancamentos', 'action' => 'view', $caixaregistro->lancamento->id_lancamento]) : '' ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $caixaregistro->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $caixaregistro->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $caixaregistro->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você quer mesmo deletar {0}?', $caixaregistro->caixa)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator">
    <div class="mr-auto" style="font-size:.8rem">
      <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} Caixa Registro de {{count}} no total')) ?>
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
