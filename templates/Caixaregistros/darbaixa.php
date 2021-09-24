<div class="card card-primary card-outline">
  <?= $this->Form->create($caixaregistro,['type' => 'file']) ?>
  <div class="card-body">
    <?php
    echo $this->Form->control('tipopagamento_id', ['options' => $tipopagamentos]);
    ?>
    <div class="form-group">
      <?= $this->Form->control('uploadfiles', ['type' => 'file']); ?>
    </div>
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Form->button(__('Salvar')) ?>
      <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>