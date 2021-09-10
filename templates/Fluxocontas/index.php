<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxoconta[]|\Cake\Collection\CollectionInterface $fluxocontas
 */
?>

<?php $this->assign('title', __('Fluxocontas') ); ?>

<div class="card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><!-- --></h2>
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
          ]); ?>
      <?= $this->Html->link(__('Nova Conta'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
              <th><?= $this->Paginator->sort('id_fluxoconta') ?></th>
              <th><?= $this->Paginator->sort('conta') ?></th>
              <th><?= $this->Paginator->sort('descricao') ?></th>
              <th><?= $this->Paginator->sort('created') ?></th>
              <th><?= $this->Paginator->sort('modified') ?></th>
              <th><?= $this->Paginator->sort('fluxosubgrupo_id') ?></th>
              <th class="actions"><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($fluxocontas as $fluxoconta): ?>
          <tr>
            <td><?= $this->Number->format($fluxoconta->id_fluxoconta) ?></td>
            <td><?= h($fluxoconta->conta) ?></td>
            <td><?= h($fluxoconta->descricao) ?></td>
            <td><?= h($fluxoconta->created) ?></td>
            <td><?= h($fluxoconta->modified) ?></td>
            <td><?= $fluxoconta->has('fluxosubgrupo') ? $this->Html->link($fluxoconta->fluxosubgrupo->id_fluxosubgrupo, ['controller' => 'Fluxosubgrupos', 'action' => 'view', $fluxoconta->fluxosubgrupo->id_fluxosubgrupo]) : '' ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $fluxoconta->id_fluxoconta], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fluxoconta->id_fluxoconta], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $fluxoconta->id_fluxoconta], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você quer mesmo deletar # {0}?', $fluxoconta->id_fluxoconta)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator">
    <div class="mr-auto" style="font-size:.8rem">
      <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
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
