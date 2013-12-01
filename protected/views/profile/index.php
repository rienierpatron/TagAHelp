<?php 
	$userInfo = $info['result']; 
	$userWallet = $wallet['result']; 
?>
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
							<center>
								<div class="col-md-3">
									<img class="userImage" src="http://tagbond.com/image/user/<?php echo $_SESSION['id'];?>">
								</div>
							</center>
							<br>
							<div class="userDetails col-md-5 pull-left">
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
						<i class="icon-list-alt"></i>Biography
					</div>
					<div class="widget-content padded">
						<?php if($userInfo['profile_bio']){ ?>
							<div class="userBio">
								<?php echo $userInfo['profile_bio'];?>
							</div>			
						<?php } else{?>
							<div class="errorMessage">
	                			<?php echo "No Biography." ;?>
	                		</div>
	                	<?php } ?>
			        </div>
				</div>
				<div class="widget-container fluid-height">
					<div class="heading">
						<i class="icon-list-alt"></i>Social Networks
					</div>
					<div class="widget-content padded">
						<?php if($userInfo['profile_facebook'] && $userInfo['profile_twitter'] && $userInfo['profile_linkedin'] && $userInfo['profile_skype']) {
							if($userInfo['profile_facebook']) {?>
								<div class="userSocialNetworks marginTopten">
									<i class="icon-facebook-sign"></i>&nbsp;&nbsp;<?php echo $userInfo['profile_facebook'];?>
								</div>			
							<?php } ?>
							<?php if($userInfo['profile_twitter']) {?>
								<div class="userSocialNetworks">
									<i class="icon-twitter-sign"></i>&nbsp;&nbsp;<?php echo $userInfo['profile_twitter'];?>
								</div>			
							<?php } ?>
							<?php if($userInfo['profile_linkedin']) {?>
								<div class="userSocialNetworks">
									<i class="icon-linkedin-sign"></i>&nbsp;&nbsp;<?php echo $userInfo['profile_linkedin'];?>
								</div>			
							<?php } ?>
							<?php if($userInfo['profile_skype']) {?>
								<div class="userSocialNetworks">
									<i class="icon-skype"></i>&nbsp;&nbsp;<?php echo $userInfo['profile_skype'];?>
								</div>			
							<?php } 
						}else{?>
							<div class="errorMessage">
	                			<?php echo "No Social networks." ;?>
	                		</div>
	                	<?php } ?>
			        </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="widget-container fluid-height">
					<div class="heading">
						<i class="icon-money"></i>Wallets
					</div>
					<div class="widget-content padded">
						<table class="table table-filters userWalletsTable">
			                <tbody>
			                	<?php if($userWallet){
			                		foreach ($userWallet as $key => $walletValue) { ?>
				                		<tr>
				                			<td class="filter-category green col-md-2">
						                    	<?php echo $walletValue['currency_code'];?>
						                    	<div class="arrow-left"></div>
						                    </td>
						                    <td class="col-md-10">
						                    	<?php echo $walletValue['wallet_name'];?>
						                    </td>
						                    <td class="userWalletAmount">
						                    	<?php echo $walletValue['balance_amount'];?>
						                    </td>
				                		</tr>
				                	<?php } ?>
				                <?php }else{?>
				                	<div class="errorMessage">
			                			<?php echo "No wallet found." ;?>
			                		</div>
			                	<?php }?>
			                </tbody>
			            </table>					
			        </div>
				</div>
			</div>
		</div>
	</div>
</div>