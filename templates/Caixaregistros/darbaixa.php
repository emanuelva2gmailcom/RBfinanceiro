<div class="card card-primary card-outline">
  <?= $this->Form->create() ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('tipopagamento_id', ['options' => $tipopagamentos]);
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