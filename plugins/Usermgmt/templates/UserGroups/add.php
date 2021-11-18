<div class="cardPAINEL card mt-2">
	<div class="cardheaderDASH card-header">
		<span class="text-white card-title">
			<?php echo __('Adicionar Grupo de Usuários');?>
		</span>
		
		<span class="card-title float-right">
			<?php echo $this->Html->link(__('Voltar', true), ['action'=>'index'], ['class'=>'btn cancelarADD btn-sm']);?>
		</span>
	</div>
	
	<div class="cardbodyDASH card-body">
		<?php echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addUserGroupForm', 'submitButtonId'=>'addUserGroupSubmitBtn']);?>
		<?php echo $this->Form->create($userGroupEntity, ['id'=>'addUserGroupForm', 'novalidate'=>true]);?>

		<div class="row form-group">
			<label class="col-md-2 col-form-label required"><?php echo __('Nome do Grupo');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('UserGroups.name', ['type'=>'text', 'label'=>false, 'class'=>'form-control']);?>
				<span class="tagline"><?php echo __('por ex. Usuário Empresarial');?></span>
			</div>
		</div>
		
		<div class="row form-group">
			<label class="col-md-2 col-form-label"><?php echo __('Grupo Matriz');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('UserGroups.parent_id', ['type'=>'select', 'options'=>$parentGroups, 'label'=>false, 'class'=>'form-control']);?>
			</div>
		</div>
		
		<div class="row form-group">
			<label class="col-md-2 col-form-label"><?php echo __('Descrição');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('UserGroups.description', ['type'=>'textarea', 'label'=>false, 'class'=>'form-control']);?>
			</div>
		</div>
		
		<div class="row form-group">
			<label class="col-md-2 col-form-label"><?php echo __('Novo Registro Permitido?');?></label>
			<div class="col-md-1">
				<?php echo $this->Form->control('UserGroups.is_registration_allowed', ['type'=>'checkbox', 'label'=>false, 'autocomplete'=>'off', 'default'=>false, 'class'=>'ml-0']);?>
			</div>
		</div>

		<div class="row form-group border-top pt-3">
			<div class="col">
				<?php echo $this->Form->Submit(__('Salvar'), ['class'=>'btn btnADD', 'id'=>'addUserGroupSubmitBtn']);?>
			</div>
		</div>
		
		<?php echo $this->Form->end();?>
		
		<div style="padding:5px">
			<?php echo __('Nota: Se você adicionar um Novo Grupo, deverá atribuir permissões a esse Grupo recém-criado.');?>
		</div>
	</div>
</div>