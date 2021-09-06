<div id="updateUsersIndex">
	<?php echo $this->Search->searchForm('Users', ['legend'=>false, 'updateDivId'=>'updateUsersIndex']);?>
	<?php echo $this->element('Usermgmt.paginator', ['updateDivId'=>'updateUsersIndex']);?>
	
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-sm table-hover">
			<thead>
				<tr>
					<th><?php echo __('#');?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.id', __('User Id'));?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.first_name', __('Name'));?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.username', __('Username'));?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.email', __('Email'));?></th>

					<th><?php echo __('Groups(s)');?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.is_email_verified', __('Email Verified'));?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.is_active', __('Status'));?></th>

					<th class="psorting"><?php echo $this->Paginator->sort('Users.created', __('Created'));?></th>

					<th><?php echo __('Action');?></th>
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
									echo "<span class='badge badge-success'>".__('Yes')."</span>";
								} else {
									echo "<span class='badge badge-danger'>".__('No')."</span>";
								}
							echo"</td>";

							echo "<td>";
								if($row['is_active']) {
									echo "<span class='badge badge-success'>".__('Active')."</span>";
								} else {
									echo "<span class='badge badge-danger'>".__('Inactive')."</span>";
								}
							echo"</td>";
							
							echo "<td>".$this->UserAuth->getFormatDate($row['created'])."</td>";
							
							echo "<td>";
								echo "<div class='dropdown'>";
									echo "<button class='btn btn-dark btn-sm dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>".__('Action')."</button>";
									
									echo "<div class='dropdown-menu dropdown-menu-right'>";
										echo $this->Html->link(__('View User'), ['controller'=>'Users', 'action'=>'viewUser', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item']);

										echo $this->Html->link(__('Edit User'), ['controller'=>'Users', 'action'=>'editUser', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item']);

										echo $this->Html->link(__('Change Password'), ['controller'=>'Users', 'action'=>'changeUserPassword', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item']);

										if($row['id'] != 1 && strtolower($row['username']) != 'admin') {
											if($row['is_active']) {
												echo $this->Form->postLink(__('Inactivate'), ['controller'=>'Users', 'action'=>'setInactive', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item', 'confirm'=>__('Are you sure you want to inactivate this user?')]);
											} else {
												echo $this->Form->postLink(__('Activate'), ['controller'=>'Users', 'action'=>'setActive', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item', 'confirm'=>__('Are you sure you want to activate this user?')]);
											}
											
											if(!$row['is_email_verified']) {
												echo $this->Form->postLink(__('Verify Email'), ['action'=>'verifyEmail', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item', 'confirm'=>__('Are you sure you want to verify email of this user?')]);
											}
											
											echo $this->Form->postLink(__('Delete User'), ['controller'=>'Users', 'action'=>'deleteUser', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item', 'confirm'=>__('Are you sure you want to delete this user?')]);
										}
										
										echo $this->Html->link(__('View Permissions'), ['controller'=>'UserGroupPermissions', 'action'=>'user', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item']);
										
										echo $this->Html->link(__('Send Email'), ['controller'=>'UserEmails', 'action'=>'sendToUser', $row['id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item']);
									echo "</div>";
								echo "</div>";
							echo "</td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan=10><br/>".__('No Records Available')."</td></tr>";
				}?>
			</tbody>
		</table>
	</div>

	<?php
	if(!empty($users)) {
		echo $this->element('Usermgmt.pagination', ['paginationText'=>__('Number of Users')]);
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