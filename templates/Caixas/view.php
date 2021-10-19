<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caixa $caixa
 */
?>

<style>

.del{
        margin-right: 80%;
    }

    .edi{
        margin-right: 3%;
    }

</style>

<?php
$this->assign('title', __('Caixas') ); ?>

<div  class="container-fluid d-flex align-items-center justify-content-center p-5">

 <div style="border: green solid 2px; border-radius: 20px;" class="card card-outline container bg-white ">

  <div class="card-header d-sm-flex" style="padding-top: 50px; color: green;">
    <h2 class="card-title"><?= h($caixa->id_caixa) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table text-nowrap">
        <tr>
            <th style="color: green;" ><?= __('Id Caixa') ?></th>
            <td class="text-info" ><?= $this->Number->format($caixa->id_caixa) ?></td>
        </tr>
        <tr>
            <th style="color: green;" ><?= __('Data Caixa') ?></th>
            <td class="text-info" ><?= h($caixa->data_caixa) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Created') ?></th>
            <td class="text-info"><?= h($caixa->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Modified') ?></th>
            <td class="text-info"><?= h($caixa->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Is Aberto') ?></th>
            <td class="text-info"><?= $caixa->is_aberto ? __('Sim') : __('Não'); ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer bg-white" style="border-radius: 20px;">
    <div style="padding-top: 20px;" class="d-flex justify-content-end">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete',  $caixa->id_caixa],
          ['confirm' => __('Você quer mesmo deletar {0}?',  $caixa->id_caixa), 'class' => 'del btn btn-sm btn-outline-danger']
      ) ?>
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $caixa->id_caixa], ['class' => 'edi btn btn-sm btn-outline-success']) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-sm btn-outline-info']) ?>
    </div>
  </div>
     </div>
</div>

<div  class="container-fluid d-flex align-items-center justify-content-center p-5">

<div style="border: green solid 2px; border-radius: 20px;"  class="related related-caixaregistros view card container bg-white">

  <div class="card-header d-sm-flex" style="padding-top: 50px;">
    <h3 class="card-title" style="color: green;"><?= __('Relacionados') ?></h3>
    <!-- <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Caixaregistros' , 'action' => 'add'], ['class' => 'btn btn-info btn-sm']) ?>
      <?= $this->Html->link(__('Todos'), ['controller' => 'Caixaregistros' , 'action' => 'index'], ['class' => 'btn btn-info btn-sm']) ?>
    </div> -->
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table text-nowrap">
      <tr style="color: green;">
          <th><?= __('Id Caixaregistro') ?></th>
          <th><?= __('Caixa Id') ?></th>
          <th><?= __('Tipopagamento Id') ?></th>
          <th><?= __('Lancamento Id') ?></th>
          <th class="actions"><?= __('Ações') ?></th>
      </tr>
      <?php if (empty($caixa->caixaregistros)) { ?>
        <tr>
            <td colspan="5" class="text-info">
              Não encontrado!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($caixa->caixaregistros as $caixaregistros) : ?>
        <tr>
            <td class="text-info" ><?= h($caixaregistros->id_caixaregistro) ?></td>
            <td class="text-info"><?= h($caixaregistros->caixa_id) ?></td>
            <td class="text-info"><?= h($caixaregistros->tipopagamento_id) ?></td>
            <td class="text-info"><?= h($caixaregistros->lancamento_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['controller' => 'Caixaregistros', 'action' => 'view', $caixaregistros->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-info']) ?>
              <?= $this->Html->link(__('Editar'), ['controller' => 'Caixaregistros', 'action' => 'edit', $caixaregistros->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-success']) ?>
              <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Caixaregistros', 'action' => 'delete', $caixaregistros->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $caixaregistros->id_caixaregistro)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>
    </div>

