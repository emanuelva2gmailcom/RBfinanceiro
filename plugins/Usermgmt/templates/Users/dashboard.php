<div class="card">
	<div class="card-header text-white bg-dark">
		<!-- <span class="card-title">
			<?php echo __('Dashboard');?>
		</span> -->
	</div>

	<div class="card-body">
		<?php
		if($this->UserAuth->isLogged()) {
			echo __('Olá').' '.$var['first_name'].' '.$var['last_name'];
			echo "<br/><br/>";

			$lastLoginTime = $this->UserAuth->getLastLoginTime();
			if($lastLoginTime) {
				echo __('Seu último acesso foi em ').$lastLoginTime;
				echo "<br/><br/>";
			}

			echo "<h4><span class='badge badge-primary'>".__('Minha Conta')."</span></h4><br/>";

			if($this->UserAuth->HP('Users', 'myprofile', 'Usermgmt')) {
				echo $this->Html->link(__('Meu Perfil'), ['controller'=>'Users', 'action'=>'myprofile', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
			}

			if($this->UserAuth->HP('Users', 'editProfile', 'Usermgmt')) {
				echo $this->Html->link(__('Editar Perfil'), ['controller'=>'Users', 'action'=>'editProfile', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
			}

			if($this->UserAuth->HP('Users', 'changePassword', 'Usermgmt')) {
				echo $this->Html->link(__('Mudar Senha'), ['controller'=>'Users', 'action'=>'changePassword', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
			}

			if(ALLOW_DELETE_ACCOUNT && $this->UserAuth->HP('Users', 'deleteAccount', 'Usermgmt') && !$this->UserAuth->isAdmin()) {
				echo $this->Form->postLink(__('Delete Account'), ['controller'=>'Users', 'action'=>'deleteAccount', 'plugin'=>'Usermgmt'], ['escape'=>false, 'class'=>'btn btn-secondary btn-sm mr-2 mb-2', 'confirm'=>__('Are you sure you want to delete your account?')]);
			}

			echo "<hr/>";

			if($this->UserAuth->isAdmin()) {
				echo "<h4><span class='badge badge-primary'>".__('Gestão de Usuários')."</span></h4><br/>";

				if($this->UserAuth->HP('Users', 'addUser', 'Usermgmt')) {
					echo $this->Html->link(__('Adicionar Usuários'), ['controller'=>'Users', 'action'=>'addUser', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				if($this->UserAuth->HP('Users', 'addMultipleUsers', 'Usermgmt')) {
					echo $this->Html->link(__('Adicionar Vários Usuários'), ['controller'=>'Users', 'action'=>'addMultipleUsers', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				if($this->UserAuth->HP('Users', 'index', 'Usermgmt')) {
					echo $this->Html->link(__('Todos os Usuários'), ['controller'=>'Users', 'action'=>'index', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				if($this->UserAuth->HP('Users', 'online', 'Usermgmt')) {
					echo $this->Html->link(__('Usuários Online'), ['controller'=>'Users', 'action'=>'online', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				if($this->UserAuth->HP('UserGroups', 'add', 'Usermgmt')) {
					echo $this->Html->link(__('Adicionar Grupo'), ['controller'=>'UserGroups', 'action'=>'add', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				if($this->UserAuth->HP('UserGroups', 'index', 'Usermgmt')) {
					echo $this->Html->link(__('Todos os Grupos'), ['controller'=>'UserGroups', 'action'=>'index', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				echo "<hr/>";

				echo "<h4><span class='badge badge-primary'>".__('Permissões de Grupo')."</span></h4><br/>";
				
				if($this->UserAuth->HP('UserGroupPermissions', 'groups', 'Usermgmt')) {
					echo $this->Html->link(__('Permissões de Grupo'), ['controller'=>'UserGroupPermissions', 'action'=>'groups', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				if($this->UserAuth->HP('UserGroupPermissions', 'subgroups', 'Usermgmt')) {
					echo $this->Html->link(__('Permissões de Subgrupos'), ['controller'=>'UserGroupPermissions', 'action'=>'subgroups', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				echo "<hr/>";

				echo "<h4><span class='badge badge-primary'>".__('Comunicação por E-mail')."</span></h4><br/>";
				
				if($this->UserAuth->HP('UserEmails', 'send', 'Usermgmt')) {
					echo $this->Html->link(__('Enviar E-mail'), ['controller'=>'UserEmails', 'action'=>'send', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				if($this->UserAuth->HP('UserEmails', 'index', 'Usermgmt')) {
					echo $this->Html->link(__('Ver E-mails enviados'), ['controller'=>'UserEmails', 'action'=>'index', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				if($this->UserAuth->HP('ScheduledEmails', 'index', 'Usermgmt')) {
					echo $this->Html->link(__('E-mails Programados'), ['controller'=>'ScheduledEmails', 'action'=>'index', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				if($this->UserAuth->HP('UserContacts', 'index', 'Usermgmt')) {
					echo $this->Html->link(__('Consultas de Contato'), ['controller'=>'UserContacts', 'action'=>'index', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				if($this->UserAuth->HP('UserEmailTemplates', 'index', 'Usermgmt')) {
					echo $this->Html->link(__('Modelos de E-mail'), ['controller'=>'UserEmailTemplates', 'action'=>'index', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				if($this->UserAuth->HP('UserEmailSignatures', 'index', 'Usermgmt')) {
					echo $this->Html->link(__('Assinaturas de E-mail'), ['controller'=>'UserEmailSignatures', 'action'=>'index', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				}

				echo "<hr/>";

				// echo "<h4><span class='badge badge-primary'>".__('Gerenciamento de Páginas Estáticas')."</span></h4><br/>";
				
				// if($this->UserAuth->HP('StaticPages', 'add', 'Usermgmt')) {
				// 	echo $this->Html->link(__('Adicionar Página'), ['controller'=>'StaticPages', 'action'=>'add', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				// }
				
				// if($this->UserAuth->HP('StaticPages', 'index', 'Usermgmt')) {
				// 	echo $this->Html->link(__('Todas as Páginas'), ['controller'=>'StaticPages', 'action'=>'index', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				// }
				
				// echo "<hr/>";

				// echo "<h4><span class='badge badge-primary'>".__('Configurações de Administrador')."</span></h4><br/>";
				
				// if($this->UserAuth->HP('UserSettings', 'index', 'Usermgmt')) {
				// 	echo $this->Html->link(__('Todas as Configurações'), ['controller'=>'UserSettings', 'action'=>'index', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				// }
				
				// if($this->UserAuth->HP('UserSettings', 'cakelog', 'Usermgmt')) {
				// 	echo $this->Html->link(__('Cake Logs'), ['controller'=>'UserSettings', 'action'=>'cakelog', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				// }
				
				// if($this->UserAuth->HP('Users', 'deleteCache', 'Usermgmt')) {
				// 	echo $this->Html->link(__('Excluir Cache'), ['controller'=>'Users', 'action'=>'deleteCache', 'plugin'=>'Usermgmt'], ['class'=>'btn btn-secondary btn-sm mr-2 mb-2']);
				// }
			}
		}?>
	</div>
</div>