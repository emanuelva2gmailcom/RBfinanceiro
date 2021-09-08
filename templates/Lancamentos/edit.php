<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento $lancamento
 */
?>

<?php $this->assign('title', __('Edit Lancamento') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Lancamentos' => ['action'=>'index'],
      'View' => ['action'=>'view', $lancamento->id_lancamento],
      'Edit',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($lancamento) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('tipo');
      echo $this->Form->control('descricao');
      echo $this->Form->control('valor');
      echo $this->Form->control('data_emissao');
      echo $this->Form->control('data_baixa');
      echo $this->Form->control('data_vencimento');
      echo $this->Form->control('fluxoconta_id', ['options' => $fluxocontas, 'empty' => true]);
      echo $this->Form->control('fornecedor_id', ['options' => $fornecedores, 'empty' => true]);
      echo $this->Form->control('cliente_id', ['options' => $clientes, 'empty' => true]);
      echo $this->Form->control('lancamento_id');
      echo $this->Form->control('dreconta_id', ['options' => $drecontas, 'empty' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $lancamento->id_lancamento],
          ['confirm' => __('Are you sure you want to delete # {0}?', $lancamento->id_lancamento), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>
