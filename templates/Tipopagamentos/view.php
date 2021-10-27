<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tipopagamento $tipopagamento
 */
?>

<?php
$this->assign('title', __('Tipopagamento') );
?>

<style>

.del{
        margin-right: 80%;
    }

    .edi{
        margin-right: 3%;
    }

.tr1 a{
        color: #029BE1;
    }

</style>

<div  class="container-fluid d-flex align-items-center justify-content-center p-5">

 <div style="border: green solid 2px; border-radius: 20px;" class="card card-outline container bg-white ">

  <div class="card-header d-sm-flex" style="padding-top: 50px; color: green;">
    <h2 class="card-title"><?= h($tipopagamento->nome) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th style="color: green;"><?= __('Nome') ?></th>
            <td class="text-info"><?= h($tipopagamento->nome) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Descrição') ?></th>
            <td class="text-info"><?= h($tipopagamento->descricao) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('N° do Tipo de Pagamento') ?></th>
            <td class="text-info"><?= $this->Number->format($tipopagamento->id_tipopagamento) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Criado') ?></th>
            <td class="text-info"><?= h($tipopagamento->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Modificado') ?></th>
            <td class="text-info"><?= h($tipopagamento->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer bg-white" style="border-radius: 20px;">
    <div style="padding-top: 20px;" class="d-flex  mr-auto justify-content-around">
      <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $tipopagamento->id_tipopagamento],
          ['confirm' => __('Você quer mesmo deletar {0}?',  $tipopagamento->nome), 'class' => 'del btn btn-sm btn-outline-danger']
      ) ?>
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $tipopagamento->id_tipopagamento], ['class' => 'edi btn btn-sm btn-outline-success']) ?>
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
      <?= $this->Html->link(__('Novo'), ['controller' => 'Caixaregistros' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('Todos'), ['controller' => 'Caixaregistros' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div> -->
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr style="color:green;">
          <th><?= __('N° de Caixa Registro') ?></th>
          <th><?= __('Caixa') ?></th>
          <th><?= __('Tipo de Pagamento') ?></th>
          <th><?= __('Lançamento') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($tipopagamento->caixaregistros)) { ?>
        <tr>
            <td colspan="5" class="text-info">
              Não encontrado!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($tipopagamento->caixaregistros as $caixaregistros) : ?>
        <tr>
            <td class="text-info"><?= h($caixaregistros->id_caixaregistro) ?></td>
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

