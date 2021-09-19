<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento[]|\Cake\Collection\CollectionInterface $lancamentos
 */
?>
<?php $this->assign('title', __('Lancamentos')); ?>

<style>
  .teste {
    color: #E1E7F0;
  }
</style>
<script>

</script>
<div class="card   card-outline bg-dark">
  <div class="card-header d-sm-flex">
    <h2 class="card-title">
      <!-- -->
    </h2>
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
        'label' => false,
        'class' => 'form-control-sm',
      ]); ?>
      <?= $this->Html->link(__('Novo Lançamento'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <?= $this->Html->link(__('Caixa diario'), ['controller' => 'relatorios','action' => 'caixadiario'], ['class' => 'btn btn-primary btn-sm']) ?>

  <div class="card-body table-responsive p-0">
    <table class="table text-nowrap">
      <thead>
        <tr>

          <th class="teste"><?= ('Tipo') ?></th>
          <th class="teste"><?= ('Descricao') ?></th>
          <th class="teste"><?= ('Valor') ?></th>
          <th class="teste"><?= ('Data de Emissão') ?></th>
          <th class="teste"><?= ('Data de Baixa') ?></th>
          <th class="teste"><?= ('Data de Vencimento') ?></th>

          <!-- <th class="teste"><?= ('Fluxoconta') ?></th> -->
          <th class="teste"><?= ('Fornecedor') ?></th>
          <!-- <th class="teste"><?= ('Cliente') ?></th> -->
<!-- 
          <th class="teste"><?= ('Dreconta') ?></th> -->
          <th class="actions teste"><?= __('Ações') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($lancamentos as $lancamento) : ?>
          <tr>

            <td><?= h($lancamento->tipo) ?></td>
            <td><?= h($lancamento->descricao) ?></td>
            <td><?= $this->Number->format($lancamento->valor) ?></td>
            <td><?= h($lancamento->data_emissao) ?></td>
            <td><?= h($lancamento->data_baixa) ?></td>
            <td><?= h($lancamento->data_vencimento) ?></td>

            <!-- <td><?= $lancamento->has('fluxoconta') ? $this->Html->link($lancamento->fluxoconta->conta, ['controller' => 'Fluxocontas', 'action' => 'view', $lancamento->fluxoconta->conta]) : '' ?></td> -->
            <td><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->nome, ['controller' => 'Fornecedores', 'action' => 'view', $lancamento->fornecedore->nome]) : '' ?></td>
            <!-- <td><?= $lancamento->has('cliente') ? $this->Html->link($lancamento->cliente->nome, ['controller' => 'Clientes', 'action' => 'view', $lancamento->cliente->nome]) : '' ?></td> -->
            <!-- <td><?= $lancamento->has('dreconta') ? $this->Html->link($lancamento->dreconta->conta, ['controller' => 'Drecontas', 'action' => 'view', $lancamento->dreconta->conta]) : '' ?></td> -->
            <td class="actions">
              <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_baixa == null)) { ?>
                <!-- <?= $this->Html->link(__('Dar baixa'), ['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?> -->
                <?= $this->Html->link(__('Dar baixa'),['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-primary']) ?>
              <?php } ?>
              <!-- <?= $this->Html->link(__('Dar baixa'), ['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?> -->
              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?', $lancamento->tipo)]) ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator">
    <div class="mr-auto" style="font-size:.8rem">
      <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} lançamentos de {{count}} no total')) ?>
    </div>

    <ul class="pagination pagination-sm">
      <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
      <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
      <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
    </ul>

  </div>
  <!-- /.card-footer -->
</div>
<script> function teste(){ console.log("oi") } </script>