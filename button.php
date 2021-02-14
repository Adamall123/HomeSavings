<!-- DELETE INCOME-->
		<div class="modal fade" id="delIncomeModal<?php echo $income['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 style="color:red"><i class='far fa-trash-alt'></i> Delete</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					<?php
					$del=$db->query("SELECT * FROM incomes_category_assigned_to_users WHERE user_id='".$user_loggedin_id."' AND id='".$income['id']."'");
					$drow=$del->fetch();
					?>	
					<div class="container-fluid">
					<h5 style="color:black"><center>Are you sure to delete <strong style="color:red"><?php echo ucwords($drow['name']); ?></strong> from the list? This method cannot be undone.</center></h5> 
					</div> 
					</div>
					<div class="modal-footer">
						<a href="delete.php?id=<?php echo $income['id']; ?>" class="btn btn-danger"><i class='far fa-trash-alt'></i>  Delete</a>
						<button type="button" class="btn btn-outline-success" data-dismiss="modal">
						<i class="fas fa-times"></i>
						Cancel
						</button>
					</div>
					
				</div>
			</div>
		</div>
<!-- DELETE INCOME -->
	
<!-- Edit Income Modal -->
		<div class="modal fade" id="editIncomeModal<?php echo $income['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel aria-hidden="true"data-backdrop="static" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 style="color:green"><i class='fas fa-pencil-alt edit_btn'></i> Edit category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<div class="modal-body">
					<?php
					$edit=$db->query("SELECT * FROM incomes_category_assigned_to_users WHERE user_id='".$user_loggedin_id."' AND id='".$income['id']."'");
					$eincome=$edit->fetch();
					?>
					<div class="container-fluid">
					<form method="POST" action="edit.php?id=<?php echo $eincome['id']?>">
						<div class="form-group">
						<label class="col-form-label" style="color:green"><i class="far fa-sticky-note"></i> Name of category:</label>
						<input id="income_id" type="text" name="editincome"  class="form-control" value="<?php echo $eincome['name']; ?>"/>
						</div>
					</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="updateincome" class="btn btn-outline-success" >
							<i class="far fa-sticky-note"></i>
							Update
							</button>
						<button type="button" class="btn btn-outline-danger" data-dismiss="modal">
						<i class="fas fa-times"></i>
						Close
						</button>
					</div>
					</form>	
				</div>
			</div>
		</div>
<!-- Edit Income Modal -->
<!--###########################################################################################################################################################-->
<!-- DELETE EXPENCE-->
		<div class="modal fade" id="delExpenceModal<?php echo $expense['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 style="color:red"><i class='far fa-trash-alt'></i> Delete</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					<?php
					$del=$db->query("SELECT * FROM expenses_category_assigned_to_users WHERE user_id='".$user_loggedin_id."' AND id='".$expense['id']."'");
					$drow=$del->fetch();
					?>	
					<div class="container-fluid">
					<h5 style="color:black"><center>Are you sure to delete <strong style="color:red"><?php echo ucwords($drow['name']); ?></strong> from the list? This method cannot be undone.</center></h5> 
					</div> 
					</div>
					<div class="modal-footer">
						<a href="deleteexpence.php?id=<?php echo $expense['id']; ?>" class="btn btn-danger"><i class='far fa-trash-alt'></i>  Delete</a>
						<button type="button" class="btn btn-outline-success" data-dismiss="modal">
						<i class="fas fa-times"></i>
						Cancel
						</button>
					</div>
					
				</div>
			</div>
		</div>
<!-- DELETE EXPENCE -->
	
<!-- Edit Expence Modal -->
		<div class="modal fade" id="editExpenceModal<?php echo $expense['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel aria-hidden="true"data-backdrop="static" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 style="color:green"><i class='fas fa-pencil-alt edit_btn'></i> Edit category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<div class="modal-body">
					<?php
					$edit=$db->query("SELECT * FROM expenses_category_assigned_to_users WHERE user_id='".$user_loggedin_id."' AND id='".$expense['id']."'");
					$erow=$edit->fetch();
					?>
					<div class="container-fluid">
					<form method="POST" action="edit.php?id=<?php echo $expense['id']?>">
						<div class="form-group">
						<label class="col-form-label" style="color:green"><i class="far fa-sticky-note"></i> Name of category:</label>
						<input id="income_id" type="text" name="editexpence"  class="form-control" value="<?php echo $erow['name']; ?>"/>
						</div>
					</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="updateincome" class="btn btn-outline-success" >
							<i class="far fa-sticky-note"></i>
							Update
							</button>
						<button type="button" class="btn btn-outline-danger" data-dismiss="modal">
						<i class="fas fa-times"></i>
						Close
						</button>
					</div>
					</form>	
				</div>
			</div>
		</div>
<!-- Edit Expence Modal -->
<!--###########################################################################################################################################################-->
<!-- DELETE PAYMENT-->
		<div class="modal fade" id="delPaymentModal<?php echo $paymentMethod['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 style="color:red"><i class='far fa-trash-alt'></i> Delete</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					<?php
					$del=$db->query("SELECT * FROM payment_methods_assigned_to_users WHERE user_id='".$user_loggedin_id."' AND id='".$paymentMethod['id']."'");
					$drow=$del->fetch();
					?>	
					<div class="container-fluid">
					<h5 style="color:black"><center>Are you sure to delete <strong style="color:red"><?php echo ucwords($drow['name']); ?></strong> from the list? This method cannot be undone.</center></h5> 
					</div> 
					</div>
					<div class="modal-footer">
						<a href="deletepayment.php?id=<?php echo $paymentMethod['id']; ?>" class="btn btn-danger"><i class='far fa-trash-alt'></i>  Delete</a>
						<button type="button" class="btn btn-outline-success" data-dismiss="modal">
						<i class="fas fa-times"></i>
						Cancel
						</button>
					</div>
					
				</div>
			</div>
		</div>
<!-- DELETE PAYMENT -->
	
<!-- Edit PAYMENT Modal -->
		<div class="modal fade" id="editPaymentModal<?php echo $paymentMethod['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel aria-hidden="true"data-backdrop="static" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 style="color:green"><i class='fas fa-pencil-alt edit_btn'></i> Edit category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<div class="modal-body">
					<?php
					$edit=$db->query("SELECT * FROM payment_methods_assigned_to_users WHERE user_id='".$user_loggedin_id."' AND id='".$paymentMethod['id']."'");
					$erow=$edit->fetch();
					?>
					<div class="container-fluid">
					<form method="POST" action="edit.php?id=<?php echo $paymentMethod['id']?>">
						<div class="form-group">
						<label class="col-form-label" style="color:green"><i class="far fa-sticky-note"></i> Name of category:</label>
						<input id="income_id" type="text" name="editpayment"  class="form-control" value="<?php echo $erow['name']; ?>"/>
						</div>
					</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="updateincome" class="btn btn-outline-success" >
							<i class="far fa-sticky-note"></i>
							Update
							</button>
						<button type="button" class="btn btn-outline-danger" data-dismiss="modal">
						<i class="fas fa-times"></i>
						Close
						</button>
					</div>
					</form>	
				</div>
			</div>
		</div>
<!-- Edit Expence Modal -->