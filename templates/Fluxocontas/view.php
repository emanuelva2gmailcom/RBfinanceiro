<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxoconta $fluxoconta
 */
?>

<?php
$this->assign('title', __('Fluxoconta') );
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($fluxoconta->conta) ?></h2>
  </div>style="font-size:.8rem">
      <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} Fluxo contas de {{count}} no total')) ?>
    </div>
            <th><?= __('Conta') ?></th>
            <td><?= h($fluxoconta->conta) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($fluxoconta->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Fluxosubgrupo') ?></th>
            <td><?= $fluxoconta->has('fluxosubgrupo') ? $this->Html->link($fluxoconta->fluxosubgrupo->subgrupo, ['controller' => 'Fluxosubgrupos', 'action' => 'view', $fluxoconta->fluxosubgrupo->subgrupo]) : ''?></td>
        </tr>
        <tr>
            <th><?= __('Id Fluxoconta') ?></th>
            <td><?= $this->Number->format($fluxoconta->id_fluxoconta) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($fluxoconta->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($fluxoconta->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $fluxoconta->id_fluxoconta],
          ['confirm' => __('Vocề quer mesmo deletar {0}?',  $fluxoconta->conta), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $fluxoconta->id_fluxoconta], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-lancamentos view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Relacionados') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Lancamentos' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('Todos'), ['controller' => 'Lancamentos' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Lancamento') ?></th>
          <th><?= __('Tipo') ?></th>
          <th><?= __('Descricao') ?></th>
          <th><?= __('Valor') ?></th>
          <th><?= __('Data Emissao') ?></th>
          <th><?= __('Data Baixa') ?></th>
          <th><?= __('Data Vencimento') ?></th>
          <th><?= __('Created') ?></th>
          <th><?= __('Modified') ?></th>
          <th><?= __('Fluxoconta Id') ?></th>
          <th><?= __('Fornecedor Id') ?></th>
          <th><?= __('Cliente Id') ?></th>
          <th><?= __('Lancamento Id') ?></th>
          <th><?= __('Dreconta Id') ?></th>
          <th class="actions"><?= __('Ações') ?></th>
      </tr>
      <?php if (empty($fluxoconta->lancamentos)) { ?>
        <tr>
            <td colspan="15" class="text-muted">
              Não Encontrado!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($fluxoconta->lancamentos as $lancamentos) : ?>
        <tr>
            <td><?= h($lancamentos->id_lancamento) ?></td>
            <td><?= h($lancamentos->tipo) ?></td>
            <td><?= h($lancamentos->descricao) ?></td>
            <td><?= h($lancamentos->valor) ?></td>
            <td><?= h($lancamentos->data_emissao->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td><?= h($lancamentos->data_baixa->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td><?= h($lancamentos->data_vencimento->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td><?= h($lancamentos->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td><?= h($lancamentos->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
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

