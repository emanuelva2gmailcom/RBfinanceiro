<div class="cardPAINEL card mt-2">
	<div class="cardheaderDASH card-header">
		<span class="text-white card-title">
			<?php echo __('Mudar Senha');?>
		</span>
	</div>

	<div class="cardbodyDASH card-body">
		<?php echo $this->Form->create($userEntity, ['novalidate'=>true]);?>

		<?php
		if(!$this->request->getSession()->check('Auth.SocialChangePassword')) {?>
			<div class="row form-group">
				<label class="col-md-2 col-form-label required"><?php echo __('Senha Antiga');?></label>
				<div class="col-md-4">
					<?php echo $this->Form->control('Users.oldpassword', ['type'=>'password', 'label'=>false, 'class'=>'form-control']);?>
				</div>
			</div>
		<?php
		}?>

		<div class="row form-group">
			<label class="col-md-2 col-form-label required"><?php echo __('Nova Senha');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('Users.password', ['type'=>'password', 'label'=>false, 'class'=>'form-control']);?>
			</div>
		</div>

		<div class="row form-group">
			<label class="col-md-2 col-form-label required"><?php echo __('Confirme a Senha');?></label>
			<div class="col-md-4">
				<?php echo $this->Form->control('Users.cpassword', ['type'=>'password', 'label'=>false, 'class'=>'form-control']);?>
			</div>
		</div>

		<div class="row form-group border-top pt-3">
			<div class="col">
				<?php echo $this->Form->Submit(__('Mudar Senha'), ['class'=>'btn btnADD', 'id'=>'changePasswordSubmitBtn']);?>
			</div>
		</div>

		<?php echo $this->Form->end();?>
	</div>
</div>