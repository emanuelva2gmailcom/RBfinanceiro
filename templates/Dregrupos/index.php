<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dregrupo[]|\Cake\Collection\CollectionInterface $dregrupos
 */
?>

<?php $this->assign('title', __('Dregrupos') ); ?>
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

      <?= $this->Html->link(__('Novo grupo'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>

    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table text-nowrap">
        <thead>
          <tr>
              
              <th class="teste"><?= ('Grupo') ?></th>
              <th class="teste"><?= ('Descrição') ?></th>
              
              
              <th class="actions teste"><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dregrupos as $dregrupo): ?>
          <tr>
            
            <td><?= h($dregrupo->grupo) ?></td>
            <td><?= h($dregrupo->descricao) ?></td>
            
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $dregrupo->id_dregrupo], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $dregrupo->id_dregrupo], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>


              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $dregrupo->id_dregrupo], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você quer mesmo deletar {0}?', $dregrupo->grupo)]) ?>

            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator">
    <div class="mr-auto" style="font-size:.8rem">
      <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} DRE grupos de {{count}} no total')) ?>
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
