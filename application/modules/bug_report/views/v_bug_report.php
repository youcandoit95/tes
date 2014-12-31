<div class="row">
	<form class="form-horizontal col-sm-8" role="form" method="POST" action="<?php echo site_url().'bug_report/c_bug_report/send_bug_report';?>" onSubmit="return confirm('Are you sure ?');">
		<div class="form-group">
			<div class="row">
				<label class="col-sm-3 control-label" style="padding-left:0;">Bug Description</label>
				<div class="col-xs-6 col-md-8" style="padding:0">
					<textarea name="bug_desc" id="bug_desc" class="form-control animated" rows=2 required></textarea>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 text-center" style="padding:0">
					<input type="submit" class="btn btn-primary" name="submit" value="Submit">
				</div>
			</div>
		</div>
	</form>
</div>