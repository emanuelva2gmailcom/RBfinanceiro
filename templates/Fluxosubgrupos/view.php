<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxosubgrupo $fluxosubgrupo
 */
?>


<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($fluxosubgrupo->subgrupo) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Subgrupo') ?></th>
            <td><?= h($fluxosubgrupo->subgrupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Descrição') ?></th>
            <td><?= h($fluxosubgrupo->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Fluxogrupo') ?></th>
            <td><?= $fluxosubgrupo->has('fluxogrupo') ? $this->Html->link($fluxosubgrupo->fluxogrupo->grupo, ['controller' => 'Fluxogrupos', 'action' => 'view', $fluxosubgrupo->fluxogrupo->grupo]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id Fluxosubgrupo') ?></th>
            <td><?= $this->Number->format($fluxosubgrupo->id_fluxosubgrupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($fluxosubgrupo->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($fluxosubgrupo->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $fluxosubgrupo->id_fluxosubgrupo],
          ['confirm' => __('Você quer mesmo deletar {0}?',  $fluxosubgrupo->subgrupo), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $fluxosubgrupo->id_fluxosubgrupo], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-fluxocontas view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Relacionados') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Fluxocontas' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('Todos'), ['controller' => 'Fluxocontas' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Fluxoconta') ?></th>
          <th><?= __('Conta') ?></th>
          <th><?= __('Descricao') ?></th>
          <th><?= __('Created') ?></th>
          <th><?= __('Modified') ?></th>
          <th><?= __('Fluxosubgrupo Id') ?></th>
          <th class="actions"><?= __('Ações') ?></th>
      </tr>
      <?php if (empty($fluxosubgrupo->fluxocontas)) { ?>
        <tr>
            <td colspan="7" class="text-muted">
              Não Encontrado!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($fluxosubgrupo->fluxocontas as $fluxocontas) : ?>
        <tr>
            <td><?= h($fluxocontas->id_fluxoconta) ?></td>
            <td><?= h($fluxocontas->conta) ?></td>
            <td><?= h($fluxocontas->descricao) ?></td>
            <td><?= h($fluxocontas->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td><?= h($fluxocontas->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td><?= h($fluxocontas->fluxosubgrupo_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['controller' => 'Fluxocontas', 'action' => 'view', $fluxocontas->id_fluxoconta], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Editar'), ['controller' => 'Fluxocontas', 'action' => 'edit', $fluxocontas->id_fluxoconta], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Fluxocontas', 'action' => 'delete', $fluxocontas->id_fluxoconta], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $fluxocontas->conta)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>

