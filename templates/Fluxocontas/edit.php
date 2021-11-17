<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxoconta $fluxoconta
 */
?>

<?php $this->assign('title', __('Editar Fluxoconta') ); ?>

<div class="container d-flex justify-content-center">

<div class="cardADD card card-danger m-5">
    <div class="cardbodyADD card-body">
  <?= $this->Form->create($fluxoconta) ?>

  <?= $this->Form->control('conta', ['label' => 'Conta'], ['class' => 'form-control']); ?>

<?= $this->Form->control('descricao', ['label' => 'Descrição'], ['class' => 'form-control']); ?>

<?= $this->Form->control('fluxosubgrupo_id', ['label' => 'Subgrupo'], ['options' => $fluxosubgrupos, 'empty' => true], ['class' => 'form-control']); ?>

  </div>

  <div class="carfooterADD card-footer d-flex">
      <div class="mr-auto p-2">
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btnADD btn-default']) ?>
      </div>
      <div class="p-2">
        <?= $this->Form->button(__('Salvar')) ?>
      </div>
    </div>

  <?= $this->Form->end() ?>
</div>
</div>
