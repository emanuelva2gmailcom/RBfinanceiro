<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dreconta $dreconta
 */
?>

<?php $this->assign('title', __('Edit Dreconta') ); ?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($dreconta) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('conta', ['label' => 'Conta']);
      echo $this->Form->control('descricao', ['label' => 'Descrição']);
      echo $this->Form->control('dregrupo_id', ['options' => $dregrupos, 'empty' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <!-- <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $dreconta->id_dreconta],
          ['confirm' => __('Você quer mesmo deletar "{0}"?', $dreconta->conta), 'class' => 'btn btn-danger']
      ) ?>
    </div> -->
    <div class="ml-auto">
      <?= $this->Form->button(__('Salvar')) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>
