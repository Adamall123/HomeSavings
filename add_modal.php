<!-- Add New Income-->
    <div class="modal fade" id="addnew"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
						<h4 style="color:green"><i class="fas fa-plus"></i> Add category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
				</div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="addnew.php">
						<div class="form-group">
						<label class="col-form-label" style="color:green"><i class="far fa-sticky-note"></i> Name of category:</label>
						<input type="text" class="form-control" name="income">
						</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
					<button type="button" class="btn btn-outline-danger" data-dismiss="modal">
						<i class="fas fa-times"></i>
						Cancel
						</button>
				</form>
                </div>
            </div>
        </div>
    </div>
	
	
<!-- Add New Expence-->
    <div class="modal fade" id="addnewexpence"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
						<h4 style="color:green"><i class="fas fa-plus"></i> Add category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
				</div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="addnew.php">
						<div class="form-group">
						<label class="col-form-label" style="color:green"><i class="far fa-sticky-note"></i> Name of category:</label>
						<input type="text" class="form-control" name="expence">
						</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
					<button type="button" class="btn btn-outline-danger" data-dismiss="modal">
						<i class="fas fa-times"></i>
						Cancel
						</button>
				</form>
                </div>
            </div>
        </div>
    </div>
	
	
<!-- Add New Payment-->
    <div class="modal fade" id="addnewpaymentmethod"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
						<h4 style="color:green"><i class="fas fa-plus"></i> Add category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
				</div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="addnew.php">
						<div class="form-group">
						<label class="col-form-label" style="color:green"><i class="far fa-sticky-note"></i> Name of category:</label>
						<input type="text" class="form-control" name="payment">
						</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
					<button type="button" class="btn btn-outline-danger" data-dismiss="modal">
						<i class="fas fa-times"></i>
						Cancel
						</button>
				</form>
                </div>
            </div>
        </div>
    </div>