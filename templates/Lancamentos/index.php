<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento[]|\Cake\Collection\CollectionInterface $lancamentos
 */
?>

<?php $this->assign('title', __('Lancamentos') ); ?>



<div class="card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><!-- --></h2>
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
          ]); ?>
      <?= $this->Html->link(__('Novo Lançamento'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
              
              <th><?= $this->Paginator->sort('tipo') ?></th>
              <th><?= $this->Paginator->sort('descricao') ?></th>
              <th><?= $this->Paginator->sort('valor') ?></th>
              <th><?= $this->Paginator->sort('data_emissao') ?></th>
              <th><?= $this->Paginator->sort('data_baixa') ?></th>
              <th><?= $this->Paginator->sort('data_vencimento') ?></th>
              
              <th><?= $this->Paginator->sort('fluxoconta_id') ?></th>
              <th><?= $this->Paginator->sort('fornecedor_id') ?></th>
              <th><?= $this->Paginator->sort('cliente_id') ?></th>
             
              <th><?= $this->Paginator->sort('dreconta_id') ?></th>
              <th class="actions"><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($lancamentos as $lancamento): ?>
          <tr>
          
            <td><?= h($lancamento->tipo) ?></td>
            <td><?= h($lancamento->descricao) ?></td>
            <td><?= $this->Number->format($lancamento->valor) ?></td>
            <td><?= h($lancamento->data_emissao) ?></td>
            <td><?= h($lancamento->data_baixa) ?></td>
            <td><?= h($lancamento->data_vencimento) ?></td>
           
            <td><?= $lancamento->has('fluxoconta') ? $this->Html->link($lancamento->fluxoconta->conta, ['controller' => 'Fluxocontas', 'action' => 'view', $lancamento->fluxoconta->conta]) : '' ?></td>
            <td><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->fornecedor, ['controller' => 'Fornecedores', 'action' => 'view', $lancamento->fornecedore->fornecedor]) : '' ?></td>
            <td><?= $lancamento->has('cliente') ? $this->Html->link($lancamento->cliente->cliente, ['controller' => 'Clientes', 'action' => 'view', $lancamento->cliente->cliente]) : '' ?></td>
            <td><?= $lancamento->has('dreconta') ? $this->Html->link($lancamento->dreconta->conta, ['controller' => 'Drecontas', 'action' => 'view', $lancamento->dreconta->conta]) : '' ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $lancamento->id_lancamento], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $lancamento->id_lancamento], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $lancamento->id_lancamento], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você quer mesmo deletar {0}?', $lancamento->tipo)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator">
    <div class="mr-auto" style="font-size:.8rem">
      <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} lançamentos de {{count}} no total')) ?>
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