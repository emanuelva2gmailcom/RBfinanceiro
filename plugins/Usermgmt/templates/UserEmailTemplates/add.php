<div class="cardPAINEL card mt-2">
	<div class="cardheaderDASH card-header">
		<span class=" text-white card-title">
			<?php echo __('Adicionar modelo de E-mail');?>
		</span>

		<span class="card-title float-right">
			<?php echo $this->Html->link(__('Voltar', true), ['action'=>'index'], ['class'=>'btn cancelarADD btn-sm']);?>
		</span>
	</div>

	<div class="cardbodyDASH card-body">
		<?php echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addTemplateForm', 'submitButtonId'=>'addTemplateSubmitBtn']);?>
		<?php echo $this->Form->create($userEmailTemplateEntity, ['id'=>'addTemplateForm']);?>

		<div class="row form-group">
			<label class="col-md-2 col-form-label required"><?php echo __('Template Name');?></label>
			<div class="col-md-6">
				<?php echo $this->Form->control('UserEmailTemplates.template_name', ['type'=>'text', 'label'=>false, 'class'=>'form-control']);?>
			</div>
		</div>

		<div class="row form-group">
			<label class="col-md-2 col-form-label"><?php echo __('Email Header');?></label>
			<div class="col-md-6">
				<?php
				if(strtoupper(DEFAULT_HTML_EDITOR) == 'TINYMCE') {
					echo $this->Tinymce->textarea('UserEmailTemplates.template_header', ['type'=>'textarea', 'label'=>false, 'class'=>'form-control'], ['skin'=>'oxide'], 'full');
				}
				else if(strtoupper(DEFAULT_HTML_EDITOR) == 'CKEDITOR') {
					echo $this->Ckeditor->textarea('UserEmailTemplates.template_header', ['type'=>'textarea', 'label'=>false, 'class'=>'form-control'], [], 'full');
				}?>
			</div>
		</div>

		<div class="row form-group">
			<label class="col-md-2 col-form-label"><?php echo __('Email Footer');?></label>
			<div class="col-md-6">
				<?php
				if(strtoupper(DEFAULT_HTML_EDITOR) == 'TINYMCE') {
					echo $this->Tinymce->textarea('UserEmailTemplates.template_footer', ['type'=>'textarea', 'label'=>false, 'class'=>'form-control'], ['skin'=>'oxide'], 'full');
				}
				else if(strtoupper(DEFAULT_HTML_EDITOR) == 'CKEDITOR') {
					echo $this->Ckeditor->textarea('UserEmailTemplates.template_footer', ['type'=>'textarea', 'label'=>false, 'class'=>'form-control'], [], 'full');
				}?>
			</div>
		</div>

		<div class="row form-group border-top pt-3">
			<div class="col">
				<?php echo $this->Form->Submit(__('Adicionar Template'), ['class'=>'btn btnADD', 'id'=>'addTemplateSubmitBtn']);?>
			</div>
		</div>

		<?php echo $this->Form->end();?>
	</div>
</div>