<input type="hidden" id="p_menu_active" value="all_req">
<input type="hidden" id="p_view_content" value="v_sdh_detail_req">

<div class="row">
	<div class="col-sm-12 bg-white con-datatables">
		<table class="table table-hover table-striped table-bordered font-12 datatables">
			<thead>
				<tr>
					<th style="text-align:center">Req. No #</th>
					<th style="text-align:center">Req. Type</th>
					<th style="text-align:center">Req. Category</th>
					<th style="text-align:center">Ref No #</th>
					<th style="text-align:center">PIC</th>
					<th style="text-align:center">Status</th>
					<th style="text-align:center">Date Created</th>
					<th style="text-align:center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($data_table as $d)
				{
					?>
					<tr>
						<td style="text-align:center"><?php echo $d['REQ_NO']; ?></td>
						<td style="text-align:center"><?php echo $d['TYPE_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['CATEGORY_NAME']; ?></td>
						<td><?php echo $d['REF_NO']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_PIC']==99 ? "WAITING PIC" : $d['REQ_PIC']; ?></td>
						<td style="text-align:center" class="<?PHP echo $d['NOTIF']; ?>"><?php echo $d['STATUS_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['REQ_CREATED']; ?></td>
						<td style="text-align:center;">
							<a href="#" class="ttip" data-toggle="tooltip" id="<?php echo $d['REQ_NO']; ?>" data-placement="top" data-original-title="Detail" onClick="modal_request_detail(this.id)">
								<i class="glyphicon glyphicon-th-list"></i>
							</a>
							<a href="<?php echo base_url().'uploads/'.str_replace("/","_",$d['REQ_NO']).'/'.$d['FILE_DOC_SUPPORT'];?>" class="ttip" data-toggle="tooltip" data-placement="top" data-original-title="Download File Attachment"><i class="glyphicon glyphicon-download-alt"></i></a>
							<?php
							if ($d['FILE_UAT']!="N/A")
							{
							?>
								<a href="<?php echo base_url().'uploads/'.str_replace("/","_",$d['REQ_NO']).'/'.$d['FILE_UAT'];?>" class="ttip" data-toggle="tooltip" data-placement="top" data-original-title="Download File UAT"><i class="glyphicon glyphicon-download"></i></a>
							<?php
							}
							
							if ($d['REQ_LSTATUS']=="1")
							{
							?>
								<a href="#" id="<?php echo str_replace("/","_",$d['REQ_NO']); ?>" onclick="print_request(this.id)" class="ttip" data-toggle="tooltip" data-placement="top" data-original-title="Print"><i class="glyphicon glyphicon-print"></i></a>
							<?php
							}
							?>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>