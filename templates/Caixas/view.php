<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caixa $caixa
 */
?>

<?php
$this->assign('title', __('Caixa') );
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($caixa->data_caixa) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Id Caixa') ?></th>
            <td><?= $this->Number->format($caixa->id_caixa) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Caixa') ?></th>
            <td><?= $this->Number->format($caixa->data_caixa) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($caixa->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($caixa->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Aberto') ?></th>
            <td><?= $caixa->is_aberto ? __('Sim') : __('Não'); ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $caixa->id_caixa],
          ['confirm' => __('Você quer mesmo deletar?',  $caixa->data_caixa), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $caixa->id_caixa], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-caixaregistros view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Caixaregistros') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Caixaregistros' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('Todos '), ['controller' => 'Caixaregistros' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Caixaregistro') ?></th>
          <th><?= __('Caixa Id') ?></th>
          <th><?= __('Tipopagamento Id') ?></th>
          <th><?= __('Lancamento Id') ?></th>
          <th class="actions"><?= __('Ações') ?></th>
      </tr>
      <?php if (empty($caixa->caixaregistros)) { ?>
        <tr>
            <td colspan="5" class="text-muted">
              Caixaregistros record not found!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($caixa->caixaregistros as $caixaregistros) : ?>
        <tr>
            <td><?= h($caixaregistros->id_caixaregistro) ?></td>
            <td><?= h($caixaregistros->caixa_id) ?></td>
            <td><?= h($caixaregistros->tipopagamento_id) ?></td>
            <td><?= h($caixaregistros->lancamento_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['controller' => 'Caixaregistros', 'action' => 'view', $caixaregistros->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Editar'), ['controller' => 'Caixaregistros', 'action' => 'edit', $caixaregistros->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Caixaregistros', 'action' => 'delete', $caixaregistros->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $caixaregistros->id_caixaregistro)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>

