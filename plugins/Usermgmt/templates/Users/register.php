<?php $this->layout = "CakeLte.login" ?>

<div class="cardLOGIN card">
	<div class="cardbodyLOGIN card-body register-card-body">
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
			'append' => '<i class=" fas fa-user"></i>'
		]); ?>

		<?= $this->Form->control('Users.first_name', [
			'type' => 'text',
			'placeholder' => __('Nome'),
			'label' => false,
			'class' => 'form-control',
			'append' => '<i class=" fas fa-user"></i>'
		]); ?>

		<?= $this->Form->control('Users.last_name', [
			'type' => 'text',
			'placeholder' => __('Sobrenome'),
			'label' => false,
			'class' => 'form-control',
			'append' => '<i class=" fas fa-user"></i>'
		]); ?>


		<?= $this->Form->control('Users.email', [
			'type' => 'text',
			'label' => false,
			'placeholder' => __('Email'),
			'class' => 'form-control',
			'append' => '<i class=" fas fa-envelope"></i>'
		]); ?>


		<?= $this->Form->control('Users.password', [
			'type' => 'password',
			'label' => false,
			'placeholder' => __('Senha'),
			'class' => 'form-control',
			'append' => '<i class=" fas fa-lock"></i>'
		]) ?>

		<?= $this->Form->control('Users.cpassword', [
			'type' => 'password',
			'label' => false,
			'class' => 'form-control',
			'placeholder' => __('Confirmar senha'),
			'append' => '<i class=" fas fa-lock"></i>'
		]) ?>

			<div>
				<?= $this->Form->control('agree_terms', [
					'label' => 'Eu concordo com todos os termos',
					'type' => 'checkbox',
					'custom' => true,
					'escape' => false
				]) ?>
			</div>
			<div class="voltarREGISTRO d-flex justify-content-between">
			    <?php echo $this->Html->link(__('Voltar', true), ['controller' => 'Users', 'action' => 'login', 'plugin' => 'Usermgmt'], ['class' => 'btnADD btn btn-sm']); ?>
				<?= $this->Form->Submit(__('Registrar'), ['class' => 'btnADD btn btn-sm', 'id' => 'registerSubmitBtn']); ?>
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
