
<div class="container d-flex justify-content-center">

  <div class="cardADD card card-danger m-5">
    <div class="cardbodyADD card-body">
  <?= $this->Form->create($caixaregistro,['type' => 'file']) ?>

    <?= $this->Form->control('tipopagamento_id', ['label' => 'Tipo de Pagamento'], ['options' => $tipopagamentos], ['class' => 'form-control']); ?>

    <div class="form-group">
      <?= $this->Form->control('Comprovante',['type' => 'file']); ?>
    </div>
  </div>

  <div class="cardfooterADD card-footer d-flex">
      <div class="mr-auto p-2">
        <?= $this->Html->link(__('Cancelar'), ['controller' => 'Lancamentos','action' => 'index'], ['class' => 'btn btnADD btn-default']) ?>
      </div>
      <div class="p-2">
        <?= $this->Form->button(__('Salvar')) ?>
      </div>
    </div>

  <?= $this->Form->end() ?>
</div>
</div>

