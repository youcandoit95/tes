<?PHP
/** View SD Home
 * UR = user request , SD = Staff Dev , NNR = Notification New Request , CNR = Check New Request, DWR = Data Waiting Respond , SDH = 
 * VE = validation / warning error form
 *
 *
 *
 */
?>

<input type="hidden" id="p_menu_active" value="done_request">
<input type="hidden" id="p_view_content" value="v_sdh_detail_req">

<div class="row">
	<div class="col-sm-12 bg-white con-datatables">
		<table class="table table-hover table-striped table-bordered font-12 datatables">
			<thead>
				<tr>
					<th style="text-align:center">Req. No #</th>
					<th style="text-align:center">Req. Name</th>
					<th style="text-align:center">Req. Type</th>
					<th style="text-align:center">Req. Category</th>
					<?php
					if ($this->session->userdata('user_level')==3)
					{
						?>
						<th style="text-align:center">PIC</th>
						<?php
					}
					?>
					<th style="text-align:center">Date Created</th>
					<th style="text-align:center" width=5%>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($data_table as $d)
				{
					$highlight_notif = $d['REQ_NOTIF_READ_DEV']=="1" ? "info" : "";
					?>
					<tr class="<?php echo $highlight_notif; ?>">
						<td style="text-align:center"><?php echo $d['REQ_NO']; ?></td>
						<td><?php echo $d['REQ_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['TYPE_NAME']; ?></td>
						<td style="text-align:center"><?php echo $d['CATEGORY_NAME']; ?></td>
						<?php
						if ($this->session->userdata('user_level')==3)
						{
							?>
							<td style="text-align:center"><?php echo $d['REQ_PIC']==99 ? "WAITING PIC" : $d['REQ_PIC']; ?></td>
							<?php
						}
						?>
						<td style="text-align:center"><?php echo $d['REQ_CREATED']; ?></td>
						<td style="text-align:center;">
							<a href="#" class="ttip" data-toggle="tooltip" id="<?php echo $d['REQ_NO']; ?>" data-placement="top" data-original-title="Detail" onClick="modal_request_detail(this.id)">
								<i class="glyphicon glyphicon-th-list"></i>
							</a>
							<?php
							if ($d['TYPE_NO']!="3")
							{
							?>
								<a href="<?php echo base_url().'uploads/'.str_replace("/","_",$d['REQ_NO']).'/'.$d['FILE_UAT'];?>" class="ttip" data-toggle="tooltip" data-placement="top" data-original-title="Download File UAT"><i class="glyphicon glyphicon-download"></i></a>
							<?php
							}
							?>
							<a href="<?php echo base_url().'uploads/'.str_replace("/","_",$d['REQ_NO']).'/'.$d['FILE_DOC_SUPPORT'];?>" class="ttip" data-toggle="tooltip" data-placement="top" data-original-title="Download Document Support"><i class="glyphicon glyphicon-download-alt"></i></a>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>