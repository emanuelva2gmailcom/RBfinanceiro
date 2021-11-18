<div class="cardPAINEL card mt-2">
	<div class="cardheaderDASH card-header">
		<span class="text-white card-title">
			<?php echo __('Editar Perfil');?>
		</span>

		<span class="card-title float-right">
			<?php echo $this->Html->link(__('Voltar', true), ['action'=>'myprofile'], ['class'=>'btn cancelarADD btn-sm']);?>
		</span>
	</div>

	<div class="cardbodyDASH card-body">
		<?php echo $this->element('Usermgmt.ajax_validation', ['formId'=>'editProfileForm', 'submitButtonId'=>'editProfileSubmitBtn']);?>
		<?php echo $this->Form->create($userEntity, ['type'=>'file', 'id'=>'editProfileForm']);?>
		<?php $changeUserName = (ALLOW_CHANGE_USERNAME || empty($userEntity['username'])) ? false : true;?>

		<div class="row form-group">
			<label class="col-md-2 col-form-label required"><?php echo __('Nome do usuário');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('Users.username', ['type'=>'text', 'label'=>false, 'readonly'=>$changeUserName, 'class'=>'form-control']);?>
			</div>
		</div>

		<div class="row form-group">
			<label class="col-md-2 col-form-label required"><?php echo __('Primeiro nome');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('Users.first_name', ['type'=>'text', 'label'=>false, 'class'=>'form-control']);?>
			</div>
		</div>

		<div class="row form-group">
			<label class="col-md-2 col-form-label"><?php echo __('Último nome');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('Users.last_name', ['type'=>'text', 'label'=>false, 'class'=>'form-control']);?>
			</div>
		</div>

		<div class="row form-group">
			<label class="col-md-2 col-form-label required"><?php echo __('E-mail');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('Users.email', ['type'=>'text', 'label'=>false, 'class'=>'form-control']);?>
			</div>
		</div>

		<div class="row form-group">
			<label class="col-md-2 col-form-label required"><?php echo __('Gênero');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('Users.gender', ['type'=>'select', 'options'=>$genders, 'label'=>false, 'class'=>'form-control']);?>
			</div>
		</div>

		<div class="row form-group">
			<label class="col-md-2 col-form-label"><?php echo __('Aniversário');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('Users.bday', ['type'=>'text', 'label'=>false, 'class'=>'form-control datepicker']);?>
			</div>
		</div>

		<div class="row form-group">
			<label class="col-md-2 col-form-label"><?php echo __('Celular');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('Users.user_detail.cellphone', ['type'=>'text', 'label'=>false, 'class'=>'form-control']);?>
			</div>
		</div>

		<div class="row form-group">
			<label class="col-md-2 col-form-label"><?php echo __('Localização');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('Users.user_detail.location', ['type'=>'text', 'label'=>false, 'class'=>'form-control']);?>
			</div>
		</div>

		<div class="row form-group">
			<label class="col-md-2 col-form-label"><?php echo __('Foto');?></label>
			<div class="col-md-4">
				<?php $this->Form->unlockField('Users.photo_file');?>
				<?php echo $this->Form->control('Users.photo_file', ['type'=>'file', 'label'=>false]);?>
			</div>
		</div>

		<div class="row form-group border-top pt-3">
			<div class="col">
				<?php echo $this->Form->Submit(__('Atualizar Perfil'), ['class'=>'btn btnADD', 'id'=>'editProfileSubmitBtn']);?>
			</div>
		</div>

		<?php echo $this->Form->end();?>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$(document).on("focus", ".datepicker", function() {
			$(this).datepicker({
				format: 'dd-M-yyyy',
				autoclose: true
			});
		});
	});
</script>