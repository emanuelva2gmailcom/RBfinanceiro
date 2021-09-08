

<?php $this->layout = "CakeLte.login" ?>

<div class="card">
	<div class="card-body login-card-body">
		<p class="login-box-msg"><?= __('Entre na sua conta') ?></p>
		
		<?= $this->Form->create() ?>

			<?= $this->Form->control('Users.email', [
				'type'=>'text', 
				'label'=>false, 
				'placeholder'=>__('Email / Username'), 
				'class'=>'form-control',
				'append' => '<i class="fas fa-user"></i>'
			]);?>

			<?= $this->Form->control('Users.password', [
				'type'=>'password', 'label'=>false, 
				'placeholder'=>__('Password'), 
				'class'=>'form-control',
				'append' => '<i class="fas fa-lock"></i>'
			]);?>

		<?php
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
					<?= $this->UserAuth->showCaptcha($error);?>
				</div>
			</div>
		<?php }; ?>
		<!-- /.col -->
		<div class="row">
			<?php
			if(USE_REMEMBER_ME) {
				if(!isset($userEntity['remember'])) {
					$userEntity['remember'] = true;
				}?>
				<div class="col-8">
					<?= $this->Form->control('Users.remember', ['type'=>'checkbox', 'custom'=>true]);?>
				</div>
			<?php }; ?>
			<!-- /.col -->
			<div class="col-4">
				<?= $this->Form->Submit(__('Login'), ['type'=>'submit', 'class'=>'btn btn-primary btn-block', 'id'=>'loginSubmitBtn']);?>
			</div>
		</div>
		<!-- /.col -->

		
		<!-- /.col -->

		<?= $this->Form->end() ?>

		<!-- <div class="social-auth-links text-center mb-3">
			<p>- OR -</p>
			<?php
				echo $this->Html->link(
					'<i class="fab fa-facebook-f mr-2"></i>'.__('Sign in using Facebook'),'#',
					['class'=>'btn btn-block btn-primary', 'escape'=>false]
				);
			?>
			<?php
				echo $this->Html->link(
					'<i class="fab fa-google mr-2"></i>'.__('Sign in using Google'),'#',
					['class'=>'btn btn-block btn-danger', 'escape'=>false]
				);
			?>
		</div> -->
		<!-- /.social-auth-links -->

		<p class="mb-1">
			<?= $this->Html->link(__('Esqueceu a senha?'), '/forgotPassword');?>
		</p>
		<p class="mb-1">
			<?= $this->Html->link(__('Verifique o seu email'), '/emailVerification');?>
		</p>
		<?php
		if(SITE_REGISTRATION) {?>
			<p class="mb-1">
				<?= $this->Html->link(__('Não tem conta? Crie uma conta!', true), ['controller'=>'Users', 'action'=>'register', 'plugin'=>'Usermgmt']);?>
			</p>
		<?php
		}?>
	</div>
  <!-- /.login-card-body -->
</div>


