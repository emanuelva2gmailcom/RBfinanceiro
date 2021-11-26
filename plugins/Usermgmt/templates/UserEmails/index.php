<div class="cardPAINEl card mt-2">
	<div class="cardheaderDASH card-header">
		<span class="text-white card-title">
			<?php echo __('Todos os e-mails enviados');?>
		</span>

		<span class="card-title float-right">
			<?php echo $this->Html->link(__('Enviar E-mail', true), ['action'=>'send'], ['class'=>'btn cancelarADD btn-sm']);?>
		</span>

		<span class="card-title float-right mr-2">
			<?php echo $this->Html->link(__('Emails programados', true), ['controller'=>'ScheduledEmails', 'action'=>'index'], ['class'=>'btn cancelarADD btn-sm']);?>
		</span>
	</div>

	<div class="cardbodyDASH2 card-body p-0">
		<?php echo $this->element('Usermgmt.all_user_emails');?>
	</div>
</div>
