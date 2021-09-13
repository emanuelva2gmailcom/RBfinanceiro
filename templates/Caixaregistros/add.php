<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caixaregistro $caixaregistro
 */
?>

<?php $this->assign('title', __('Adicionar Caixa Registro') ); ?>




<div class="card card-primary card-outline">
  <?= $this->Form->create($caixaregistro) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('caixa_id', ['options' => $caixas, 'empty' => true]);
      echo $this->Form->control('tipopagamento_id', ['options' => $tipopagamentos, 'empty' => true]);
      echo $this->Form->control('lancamento_id', ['options' => $lancamentos, 'empty' => true]);
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
