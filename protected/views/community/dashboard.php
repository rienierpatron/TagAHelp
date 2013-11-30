<div class="main_body" id="communityDashboard">
	<div class="row">
		<div class="col-md-6">
			<div class="widget-container fluid-height">
				<div class="heading">
					<i class="icon-list-alt"></i>Community Details
				</div>
				<div class="widget-content padded">
					<table class="table table-filters">
						<tbody>
							<tr>
								<td>
									<b>Name</b>
								</td>
								<td>
									<?php echo $detail['result']['community_name']; ?>
								</td>
							</tr>
							<tr>
								<td>
									<b>Description</b>
								</td>
								<td>
									<?php echo $detail['result']['community_description']; ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="widget-container fluid-height">
				<div class="heading">
					<i class="icon-map-marker"></i>Location
				</div>
				<div class="widget-content padded">
					<div id="map-canvas" style="height:500px">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="widget-container fluid-height">
				<div class="heading">
					<i class="icon-info-sign"></i>Where Does Donations Go?
					<input type='button' id='edit-allotment' class='btn btn-danger btn-xs pull-right' value='EDIT'>
					<div class='pull-right computeTotalPercentage' style="display:none">Total: <span class='totalPercentage'></span>%</div>
				</div>
				<div class="widget-content padded">
					<div class="row">
						<form name="frmFunds" method="POST" action="<?php $this->createUrl('funds/set'); ?>">
							<table class="table table-filters" >
								<tbody id="fund-allotment">
									<tr>
										<th><b>Particulars</b></th>
										<th>
											<center>
												<b>Percentage</b>
											</center>
										</th>
										<th></th>
									</tr>
									<tr>
										<td class="fixedDonationName">TAGBOND</td>
										<td>
											<div class="danger alignCenter fixedTagbondValue donationTotalList">
												20
											</div>
										</td>
										<td></td>
									</tr>
									<?php for($i = 0; $i< sizeOf($funds); $i++){
										if($funds[$i]['breakdown'] != "TAGBOND"){?>
											<tr class="donationValues">
												<td><?php echo $funds[$i]['breakdown'];?></td>
												<td>
													<div class="danger alignCenter donationTotalList">
														<?php echo $funds[$i]['percentage'];?>
													</div>
												</td>
												<td></td>
											</tr>
										<?php }
									}?>
									
									<tr class="displayTotalPercentage">
										<td><b>TOTAL</b></td>
										<td>
											<div class="alignCenter">
												<span class="totalPercentage">20</span>%
											</div>
										</td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script>
	$(document).ready(function(){
		//HELP.map.getLocation("<?php echo $detail['result']['community_address1'].' '.$detail['result']['community_address2'].' '.$detail['result']['community_city'].' '.$_SESSION['country']; ?>","<?php echo $detail['result']['community_name']; ?>");
		HELP.community.editDonationDetails();
		HELP.community.removeDonationDetails();
		HELP.community.computeDonationPercentage();
		HELP.community.inputDonationPercentage();
		HELP.community.saveDonationPercentage('<?php echo $_GET["id"];?>',"<?php echo $this->createUrl('community/saveDonationRate'); ?>");
	});
	
</script>