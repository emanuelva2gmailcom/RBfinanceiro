<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dreconta $dreconta
 */
?>

<?php
$this->assign('title', __('Dreconta') );?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($dreconta->conta) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Conta') ?></th>
            <td><?= h($dreconta->conta) ?></td>
        </tr>
        <tr>
            <th><?= __('Descrição') ?></th>
            <td><?= h($dreconta->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Dregrupo') ?></th>
            <td><?= $dreconta->has('dregrupo') ? $this->Html->link($dreconta->dregrupo->id_dregrupo, ['controller' => 'Dregrupos', 'action' => 'view', $dreconta->dregrupo->id_dregrupo]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id Dreconta') ?></th>
            <td><?= $this->Number->format($dreconta->id_dreconta) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($dreconta->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($dreconta->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $dreconta->id_dreconta],
          ['confirm' => __('Você quer mesmo deletar "{0}"?', $dreconta->conta), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $dreconta->id_dreconta], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-lancamentos view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Relacionados') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Lancamentos' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('Todos '), ['controller' => 'Lancamentos' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Lancamento') ?></th>
          <th><?= __('Tipo') ?></th>
          <th><?= __('Descrição') ?></th>
          <th><?= __('Valor') ?></th>
          <th><?= __('Data Emissão') ?></th>
          <th><?= __('Data Baixa') ?></th>
          <th><?= __('Data Vencimento') ?></th>
          <th><?= __('Created') ?></th>
          <th><?= __('Modified') ?></th>
          <th><?= __('Fluxoconta') ?></th>
          <th><?= __('Fornecedor') ?></th>
          <th><?= __('Cliente') ?></th>
          <th><?= __('Lançamento') ?></th>
          <th><?= __('Dreconta') ?></th>
          <th class="actions"><?= __('Ações') ?></th>
      </tr>
      <?php if (empty($dreconta->lancamentos)) { ?>
        <tr>
            <td colspan="15" class="text-muted">
              Não encontrado!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($dreconta->lancamentos as $lancamentos) : ?>
        <tr>
            <td><?= h($lancamentos->id_lancamento) ?></td>
            <td><?= h($lancamentos->tipo) ?></td>
            <td><?= h($lancamentos->descricao) ?></td>
            <td><?= h($lancamentos->valor) ?></td>
            <td><?= h($lancamentos->data_emissao) ?></td>
            <td><?= h($lancamentos->data_baixa) ?></td>
            <td><?= h($lancamentos->data_vencimento) ?></td>
            <td><?= h($lancamentos->created) ?></td>
            <td><?= h($lancamentos->modified) ?></td>
            <td><?= h($lancamentos->fluxoconta_id) ?></td>
            <td><?= h($lancamentos->fornecedor_id) ?></td>
            <td><?= h($lancamentos->cliente_id) ?></td>
            <td><?= h($lancamentos->lancamento_id) ?></td>
            <td><?= h($lancamentos->dreconta_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['controller' => 'Lancamentos', 'action' => 'view', $lancamentos->id_lancamento], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Editar'), ['controller' => 'Lancamentos', 'action' => 'edit', $lancamentos->id_lancamento], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Lancamentos', 'action' => 'delete', $lancamentos->id_lancamento], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $lancamentos->id_lancamento)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>

