<div class="card">
	<div class="card-header text-white bg-dark">
		<span class="card-title">
			<?php echo __('Sign Up');?>
		</span>

		<span class="card-title float-right">
			<?php echo $this->Html->link(__('Sign In', true), ['controller'=>'Users', 'action'=>'login', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm']);?>
		</span>
	</div>

	<div class="card-body">
		<div class="row">
			<div class="col-lg-8 col-md-8">
				<?php echo $this->element('Usermgmt.ajax_validation', ['formId'=>'registerForm', 'submitButtonId'=>'registerSubmitBtn']);?>
				<?php echo $this->Form->create($userEntity, ['id'=>'registerForm', 'novalidate'=>true]);?>

				<div class="row form-group">
					<label class="col-md-3 col-form-label required"><?php echo __('User Group');?></label>
					<div class="col-md-6">
						<?php echo $this->Form->control('Users.user_group_id', ['type'=>'select', 'options'=>$userGroups, 'label'=>false, 'class'=>'form-control']);?>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3 col-form-label required"><?php echo __('Username');?></label>
					<div class="col-md-6">
						<?php echo $this->Form->control('Users.username', ['type'=>'text', 'label'=>false, 'class'=>'form-control']);?>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3 col-form-label required"><?php echo __('First Name');?></label>
					<div class="col-md-6">
						<?php echo $this->Form->control('Users.first_name', ['type'=>'text', 'label'=>false, 'class'=>'form-control']);?>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3 col-form-label"><?php echo __('Last Name');?></label>
					<div class="col-md-6">
						<?php echo $this->Form->control('Users.last_name', ['type'=>'text', 'label'=>false, 'class'=>'form-control']);?>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3 col-form-label required"><?php echo __('Email');?></label>
					<div class="col-md-6">
						<?php echo $this->Form->control('Users.email', ['type'=>'text', 'label'=>false, 'class'=>'form-control']);?>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3 col-form-label required"><?php echo __('Password');?></label>
					<div class="col-md-6">
						<?php echo $this->Form->control('Users.password', ['type'=>'password', 'label'=>false, 'class'=>'form-control']);?>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3 col-form-label required"><?php echo __('Confirm Password');?></label>
					<div class="col-md-6">
						<?php echo $this->Form->control('Users.cpassword', ['type'=>'password', 'label'=>false, 'class'=>'form-control']);?>
					</div>
				</div>

				<?php
				if($this->UserAuth->canUseRecaptha('registration')) {
					$errors = $userEntity->getErrors();
					$error = "";
					
					if(isset($errors['captcha'])) {
						foreach($errors['captcha'] as $er) {
							$error = $er;
						}	
					}?>

					<div class="row form-group">
						<label class="col-md-3 col-form-label required"><?php echo __('Prove you\'re not a robot');?></label>
						<div class="col-md-6">
							<?php echo $this->UserAuth->showCaptcha($error);?>
						</div>
					</div>
				<?php
				}?>

				<div class="row form-group border-top pt-3">
					<div class="col">
						<?php echo $this->Form->Submit(__('Sign Up'), ['class'=>'btn btn-primary', 'id'=>'registerSubmitBtn']);?>
					</div>
				</div>

				<?php echo $this->Form->end();?>
			</div>

			<div class="col-lg-4 col-md-4">
				<?php echo $this->element('Usermgmt.provider');?>
			</div>
		</div>
	</div>
</div>