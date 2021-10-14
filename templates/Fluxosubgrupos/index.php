<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxosubgrupo[]|\Cake\Collection\CollectionInterface $fluxosubgrupos
 */
?>

<?php $this->assign('title', __('Subgrupos') ); ?>
<style>
 
  .tr1 a{

        color: #029BE1;

    }

</style>


<div class="container-fluid d-flex align-items-center justify-content-center p-5">

    <div class="card container card-outline bg-white" style="border: green solid 2px; border-radius: 20px;">

        <div class="card-header d-sm-flex" style="padding-top: 50px;">
    <h2 class="card-title"><!-- --></h2>
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
            'style' => 'color: #029BE1; border: 2px solid green;',
          ]); ?>
      <?= $this->Html->link(__('Novo Subgrupo'), ['action' => 'add'], ['class' => 'btn btn-info btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table text-nowrap">
        <thead>
          <tr style="color: green;">
     
              <th class="teste"><?= ('Subgrupo') ?></th>
              <th class="teste"><?= ('Descrição') ?></th>
            
             
              <th class="teste"><?= ('Fluxogrupo') ?></th>
              <th class="actions teste"><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($fluxosubgrupos as $fluxosubgrupo): ?>
          <TR style="color: #029BE1;">
           
            <td><?= h($fluxosubgrupo->subgrupo) ?></td>
            <td><?= h($fluxosubgrupo->descricao) ?></td>
           
           
            <td class="tr1" ><?= $fluxosubgrupo->has('fluxogrupo') ? $this->Html->link($fluxosubgrupo->fluxogrupo->grupo, ['controller' => 'Fluxogrupos', 'action' => 'view', $fluxosubgrupo->fluxogrupo->grupo]) : '' ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $fluxosubgrupo->id_fluxosubgrupo], ['class'=>'btn btn-xs btn-outline-info', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fluxosubgrupo->id_fluxosubgrupo], ['class'=>'btn btn-xs btn-outline-success', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $fluxosubgrupo->id_fluxosubgrupo], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você quer mesmo deletar {0}?',  $fluxosubgrupo->subgrupo)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator" style="color: green;" >

    <div class="mr-auto" style="font-size:.8rem">
      <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} fluxos subgrupos de {{count}} no total')) ?>
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
