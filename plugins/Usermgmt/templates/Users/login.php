<div class="row justify-content-center">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header text-white bg-dark">
				<span class="card-title">
					<?php echo __('Sign In');?>
				</span>

				<?php
				if(SITE_REGISTRATION) {?>
					<span class="card-title float-right">
						<?php echo $this->Html->link(__('Sign Up', true), ['controller'=>'Users', 'action'=>'register', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm']);?>
					</span>
				<?php
				}?>
			</div>

			<div class="card-body">
				<?php echo $this->element('Usermgmt.ajax_validation', ['formId'=>'loginForm', 'submitButtonId'=>'loginSubmitBtn']);?>
				<?php echo $this->Form->create($userEntity, ['id'=>'loginForm']);?>

				<div class="row form-group">
					<label class="col-md-4 col-form-label required"><?php echo __('Email / Username');?></label>
					<div class="col-md-8">
						<?php echo $this->Form->control('Users.email', ['type'=>'text', 'label'=>false, 'placeholder'=>__('Email / Username'), 'class'=>'form-control']);?>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-4 col-form-label required"><?php echo __('Password');?></label>
					<div class="col-md-8">
						<?php echo $this->Form->control('Users.password', ['type'=>'password', 'label'=>false, 'placeholder'=>__('Password'), 'class'=>'form-control']);?>
					</div>
				</div>

				<?php
				if(USE_REMEMBER_ME) {
					if(!isset($userEntity['remember'])) {
						$userEntity['remember'] = true;
					}?>

					<div class="row form-group">
						<label class="col-md-4 col-form-label"><?php echo __('Remember me');?></label>
						<div class="col-md-1">
							<?php echo $this->Form->control('Users.remember', ['type'=>'checkbox', 'label'=>false]);?>
						</div>
					</div>
				<?php
				}

				if($this->UserAuth->canUseRecaptha('login')) {
					$errors = $userEntity->getErrors();
					$error = "";
					
					if(isset($errors['captcha'])) {
						foreach($errors['captcha'] as $er) {
							$error = $er;
						}	
					}?>

					<div class="row form-group">
						<label class="col-md-4 col-form-label required"><?php echo __('Prove you\'re not a robot');?></label>
						<div class="col-md-8">
							<?php echo $this->UserAuth->showCaptcha($error);?>
						</div>
					</div>
				<?php
				}?>

				<div class="row form-group border-top pt-3">
					<div class="col">
						<?php echo $this->Form->Submit(__('Sign In'), ['class'=>'btn btn-primary', 'id'=>'loginSubmitBtn']);?>
					
						<?php echo $this->Html->link(__('Forgot Password?'), '/forgotPassword', ['class'=>'btn btn-secondary float-right ml-2']);?>
					
						<?php echo $this->Html->link(__('Email Verification'), '/emailVerification', ['class'=>'btn btn-secondary float-right']);?>
					</div>
				</div>

				<?php echo $this->Form->end();?>
				
				<?php echo $this->element('Usermgmt.provider');?>
			</div>
		</div>
	</div>
</div>