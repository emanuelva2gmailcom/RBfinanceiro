<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxogrupo $fluxogrupo
 */
?>

<?php
$this->assign('title', __('Fluxogrupo') );
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($fluxogrupo->grupo) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Grupo') ?></th>
            <td><?= h($fluxogrupo->grupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($fluxogrupo->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Fluxogrupo') ?></th>
            <td><?= $this->Number->format($fluxogrupo->id_fluxogrupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($fluxogrupo->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($fluxogrupo->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $fluxogrupo->id_fluxogrupo],
          ['confirm' => __('Você tem certeza sobre deletar "{0}"?', $fluxogrupo->grupo), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $fluxogrupo->id_fluxogrupo], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-fluxosubgrupos view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Relacionados') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Fluxosubgrupos' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('Todos'), ['controller' => 'Fluxosubgrupos' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Fluxosubgrupo') ?></th>
          <th><?= __('Subgrupo') ?></th>
          <th><?= __('Descrição') ?></th>
          <th class="actions"><?= __('Ações') ?></th>
      </tr>
      <?php if (empty($fluxogrupo->fluxosubgrupos)) { ?>
        <tr>
            <td colspan="7" class="text-muted">
              Não encontrado!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($fluxogrupo->fluxosubgrupos as $fluxosubgrupos) : ?>
        <tr>
            <td><?= h($fluxosubgrupos->id_fluxosubgrupo) ?></td>
            <td><?= h($fluxosubgrupos->subgrupo) ?></td>
            <td><?= h($fluxosubgrupos->descricao) ?></td>
            <td><?= h($fluxosubgrupos->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td><?= h($fluxosubgrupos->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td><?= h($fluxosubgrupos->fluxogrupo_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['controller' => 'Fluxosubgrupos', 'action' => 'view', $fluxosubgrupos->id_fluxosubgrupo], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Editar'), ['controller' => 'Fluxosubgrupos', 'action' => 'edit', $fluxosubgrupos->id_fluxosubgrupo], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Fluxosubgrupos', 'action' => 'delete', $fluxosubgrupos->id_fluxosubgrupo], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar "{0}"?', $fluxogrupo->grupo)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>

