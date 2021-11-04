

<?php $this->layout = "CakeLte.login" ?>

<style>
	a{
		color: #7A3E26;
	}

    a:hover{
        color: #CF6856;
    }

    .btn{

background-color: #CF6856;

color: #F7E7CE;

border: 1px solid #CF6856;

}

.btn:hover{

background-color: #F7E7CE;

color: #CF6856;

border: 1px solid #CF6856;

}

.btn:focus{

background-color: #CF6856;

color: #F7E7CE;

border: 1px solid #CF6856;

}

</style>

<div class="card" style="margin-top: 0%; border-radius: 20px;">
	<div class="card-body login-card-body" style="border-radius: 20px; background-color: #F7E7CE; color: #7A3E26;">


		<?= $this->Form->create() ?>

			<?= $this->Form->control('Users.email', [
				'type'=>'text',
				'label'=>false,
				'placeholder'=>__('Digite seu email / username'),
				'class'=>'form-control',
				'append' => '<i class="fas fa-user" style="color: #CF6856;"></i>'
			]);?>

			<?= $this->Form->control('Users.password', [
				'type'=>'password', 'label'=>false,
				'placeholder'=>__('Digite sua senha'),
				'class'=>'form-control',
				'append' => '<i class="fas fa-lock" style="color: #CF6856;"></i>'
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
				<label class="col-md-4 col-form-label required"><?php echo __('Prove que não é um robô');?></label>
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
					<?= $this->Form->control('Users.lembrar', ['type'=>'checkbox', 'custom'=>true]);?>
				</div>
			<?php }; ?>
			<!-- /.col -->
			<div class="col-4">
				<?= $this->Form->Submit(__('Entrar'), ['type'=>'submit', 'class'=>'btn ml-auto', 'id'=>'loginSubmitBtn']);?><br>
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

		<!-- <p class="mb-1">
			<?= $this->Html->link(__('Esqueceu a senha? Redefina aqui'), '/forgotPassword');?>
		</p>
		<p class="mb-1">
			<?= $this->Html->link(__('Verifique o seu email aqui'), '/emailVerification');?>
		</p> -->
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


