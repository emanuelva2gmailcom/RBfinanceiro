<div class="cardPAINEL card mt-2">
	<div class="cardheaderDASH card-header">
		<span class="text-white card-title">
			<?php echo __('Todos os usuários');?>
		</span>

		<span class="card-title float-right">
			<?php echo $this->Html->link(__('Adicionar Usuário', true), ['action'=>'addUser'], ['class'=>'btn cancelarADD btn-sm']);?>
		</span>
	</div>

	<div class="cardbodyDASH2 card-body p-0">
		<?php echo $this->element('Usermgmt.all_users');?>
	</div>
</div>