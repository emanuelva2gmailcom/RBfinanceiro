<div id="updateUsersIndex">
	<?php echo $this->Search->searchForm('Users', ['legend'=>false, 'updateDivId'=>'updateUsersIndex', 'class'=>'btnADD']);?>
	<?php echo $this->element('Usermgmt.paginator', ['updateDivId'=>'updateUsersIndex', 'class'=>'btnADD']);?>
	
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-sm table-hover">
			<thead>
				<tr>
					<th><?php echo __('#');?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.id', __('ID do Usuário'));?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.first_name', __('Nome'));?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.username', __('Nome do Usuário'));?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.email', __('E-mail'));?></th>

					<th><?php echo __('Grupo(s)');?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.is_email_verified', __('E-mail Verificado'));?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.is_active', __('Status'));?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.created', __('Criado'));?></th>

					<th><?php echo __('Ações');?></th>
				</tr>
			</thead>

			<tbody>
				<?php
				if(!empty($users)) {
					$i = $this->UserAuth->getPageStart();

					foreach($users as $row) {
						$i++;

						echo "<tr>";
							echo "<td>".$i."</td>";
							
							echo "<td>".$row['id']."</td>";
							
							echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
							
							echo "<td>".$row['username']."</td>";
							
							echo "<td>".$row['email']."</td>";
							
							echo "<td>".$row['user_group_name']."</td>";
							
							echo "<td>";
								if($row['is_email_verified']) {
									echo "<span class='badge badge-success'>".__('Sim')."</span>";
								} else {
									echo "<span class='badge badge-danger'>".__('Não')."</span>";
								}
							echo"</td>";

							echo "<td>";
								if($row['is_active']) {
									echo "<span class='badge badge-success'>".__('Ativo')."</span>";
								} else {
									echo "<span class='badge badge-danger'>".__('Inativo')."</span>";
								}
							echo"</td>";
							
							echo "<td>".$this->UserAuth->getFormatDate($row['created'])."</td>";
							
							echo "<td>";
								echo "<div class='dropdown'>";
									echo "<button class='btn btnADD btn-sm dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>".__('Ações')."</button>";
									
									echo "<div class='dropdown-menu dropdown-menu-right'>";
										echo $this->Html->link(__('Exibir Usuário'), ['controller'=>'Users', 'action'=>'viewUser', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item']);

										echo $this->Html->link(__('Editar Usuário'), ['controller'=>'Users', 'action'=>'editUser', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item']);

										echo $this->Html->link(__('Mudar Senha'), ['controller'=>'Users', 'action'=>'changeUserPassword', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item']);

										if($row['id'] != 1 && strtolower($row['username']) != 'admin') {
											if($row['is_active']) {
												echo $this->Form->postLink(__('Inativar'), ['controller'=>'Users', 'action'=>'setInactive', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item', 'confirm'=>__('Are you sure you want to inactivate this user?')]);
											} else {
												echo $this->Form->postLink(__('Ativar'), ['controller'=>'Users', 'action'=>'setActive', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item', 'confirm'=>__('Are you sure you want to activate this user?')]);
											}
											
											if(!$row['is_email_verified']) {
												echo $this->Form->postLink(__('Verificar E-mail'), ['action'=>'verifyEmail', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item', 'confirm'=>__('Are you sure you want to verify email of this user?')]);
											}
											
											echo $this->Form->postLink(__('Deletar Usuário'), ['controller'=>'Users', 'action'=>'deleteUser', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item', 'confirm'=>__('Are you sure you want to delete this user?')]);
										}
										
										echo $this->Html->link(__('Exibir  Permissões'), ['controller'=>'UserGroupPermissions', 'action'=>'user', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item']);
										
										echo $this->Html->link(__('Enviar E-mail'), ['controller'=>'UserEmails', 'action'=>'sendToUser', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item']);
									echo "</div>";
								echo "</div>";
							echo "</td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan=10><br/>".__('Nenhum registro disponível')."</td></tr>";
				}?>
			</tbody>
		</table>
	</div>

	<?php
	if(!empty($users)) {
		echo $this->element('Usermgmt.pagination', ['paginationText'=>__('Número de usuários')]);
	}?>

	<script type="text/javascript">
		$(function(){
			$(document).on("focus", ".datepicker", function() {
				$(this).datepicker({
					format: 'dd-M-yyyy',
					autoclose: true
				});
			});
		});
	</script>
</div>