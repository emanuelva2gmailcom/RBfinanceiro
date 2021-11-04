<?php $this->layout = "CakeLte.login" ?>

<style>

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

<div class="card" style="border-radius: 20px;">
	<div class="card-body register-card-body" style="border-radius: 20px;background-color: #F7E7CE; color: #7A3E26;">
		<?php echo $this->element('Usermgmt.ajax_validation', ['formId' => 'registerForm', 'submitButtonId' => 'registerSubmitBtn']); ?>
		<?php echo $this->Form->create($userEntity, ['id' => 'registerForm', 'novalidate' => true]); ?>

		<?= $this->Form->create() ?>

		<?= $this->Form->control('Users.user_group_id', [
			'type' => 'select',
			'options' => $userGroups,
			'label' => false,
			'class' => 'form-control'
		]); ?>

		<?= $this->Form->control('Users.username', [
			'type' => 'text',
			'label' => false,
			'placeholder' => __('Username'),
			'class' => 'form-control',
			'append' => '<i class=" fas fa-user" style="color: #CF6856;"></i>'
		]); ?>

		<?= $this->Form->control('Users.first_name', [
			'type' => 'text',
			'placeholder' => __('Nome'),
			'label' => false,
			'class' => 'form-control',
			'append' => '<i class=" fas fa-user" style="color: #CF6856;"></i>'
		]); ?>

		<?= $this->Form->control('Users.last_name', [
			'type' => 'text',
			'placeholder' => __('Sobrenome'),
			'label' => false,
			'class' => 'form-control',
			'append' => '<i class=" fas fa-user" style="color: #CF6856;"></i>'
		]); ?>


		<?= $this->Form->control('Users.email', [
			'type' => 'text',
			'label' => false,
			'placeholder' => __('Email'),
			'class' => 'form-control',
			'append' => '<i class=" fas fa-envelope" style="color: #CF6856;"></i>'
		]); ?>


		<?= $this->Form->control('Users.password', [
			'type' => 'password',
			'label' => false,
			'placeholder' => __('Senha'),
			'class' => 'form-control',
			'append' => '<i class=" fas fa-lock" style="color: #CF6856;"></i>'
		]) ?>

		<?= $this->Form->control('Users.cpassword', [
			'type' => 'password',
			'label' => false,
			'class' => 'form-control',
			'placeholder' => __('Confirmar senha'),
			'append' => '<i class=" fas fa-lock" style="color: #CF6856;"></i>'
		]) ?>

			<div>
				<?= $this->Form->control('agree_terms', [
					'label' => 'Eu concordo com todos os termos',
					'type' => 'checkbox',
					'custom' => true,
					'escape' => false
				]) ?>
			</div>
			<div class="d-flex justify-content-between">
			    <?php echo $this->Html->link(__('Voltar', true), ['controller' => 'Users', 'action' => 'login', 'plugin' => 'Usermgmt'], ['class' => 'btn btn-sm']); ?>
				<?= $this->Form->Submit(__('Registrar'), ['class' => 'btn btn-sm', 'id' => 'registerSubmitBtn']); ?>
			</div>

		<?= $this->Form->end() ?>

		<!-- <div class="social-auth-links text-center mb-3">
			<p>- OR -</p>
			<?php
			echo $this->Html->link(
				'<i class="fab fa-facebook-f mr-2"></i>' . __('Sign up using Facebook'),
				'#',
				['class' => 'btn btn-block btn-primary', 'escape' => false]
			);
			?>
			<?php
			echo $this->Html->link(
				'<i class="fab fa-google mr-2"></i>' . __('Sign up using Google'),
				'#',
				['class' => 'btn btn-block btn-danger', 'escape' => false]
			);
			?>
		</div> -->
		<!-- /.social-auth-links -->
	</div>
	<!-- /.register-card-body -->
</div>
