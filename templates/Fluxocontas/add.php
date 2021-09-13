<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxoconta $fluxoconta
 */
?>

<?php $this->assign('title', __('Adicionar Fluxoconta') ); ?>




<div class="card card-primary card-outline">
  <?= $this->Form->create($fluxoconta) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('conta');
      echo $this->Form->control('descricao');
      echo $this->Form->control('fluxosubgrupo_id', ['options' => $fluxosubgrupos, 'empty' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Form->button(__('Salvar')) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>
