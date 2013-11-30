<?php $userInfo = $info['result']; ?>
<div id="profileIndex">
	<div class="main_body">
		<div class="row">
			<div class="col-md-6">
				<div class="widget-container fluid-height">
					<div class="heading">
						<i class="icon-list-alt"></i>Info
					</div>
					<div class="widget-content padded">
						<div class="row userInfo">
							<img class="userImage pull-left" src="http://tagbond.com/image/user/<?php echo $_SESSION['id'];?>">
							<div class="userDetails col-md-5">
								<div class="userName" >
									<?php echo $userInfo['user_firstname']." ".$userInfo['user_lastname']." - ".$userInfo['id']; ?>
								</div>
								<?php if($userInfo['profile_email']){ ?>
									<div class="userSocialNetworks" >
										<i class="icon-envelope"></i>&nbsp;&nbsp;<?php echo $userInfo['profile_email'];?>
									</div>
								<?php } ?>
								<?php if($userInfo['profile_mobile']){ ?>
									<div class="userSocialNetworks" >
										<i class="icon-phone-sign"></i>&nbsp;&nbsp;<?php echo $userInfo['profile_mobile'];?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="widget-container fluid-height userWallets">
					<div class="heading">
						<i class="icon-list-alt"></i>Wallets
					</div>
					<div class="widget-content padded">
						<table class="table table-filters userWalletsTable">
			                <tbody>
			                		<tr>
			                			<td class="filter-category green col-md-2">
			                				<i class="icon-money"></i>
					                    	<div class="arrow-left"></div>
					                    </td>
					                    <td class="col-md-10"0>jella divina</td>
					                    <td>1,000</td>
			                		</tr>
			                </tbody>
			            </table>					
			        </div>
				</div>
			</div>
		</div>
	</div>
</div>