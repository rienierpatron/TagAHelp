<div class="navbar navbar-fixed-bottom" role="navigation" style="overflow: visible;">
<div id="foot">
	<div class="btn-group" style="width:100%;">
	  <button class="navi btn btn-danger activeBtn" id="received" name="received">RECEIVED</button>
	  <button class="navi btn btn-danger" id="spent" name="spent">SPENT</button>
	  <button class="navi btn btn-danger" id="transfer" name="transfer">TRANSFER</button>
	</div>
</div>
</div>

<style>
.navi{
	width: 33.385%;
	height:60px;
	border:1px solid #C02C2C;
}
.navi:hover{
	border:1px solid #C02C2C;
}
#foot{
	width:100% !important;
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 50px;
    background:white;
} 
.activeBtn{
	border:1px solid #C02C2C;
	background-color:#FF4C4C;
	font-weight:bold;
}
</style>
<script>
	$(document).ready(function(){
		var active = "received";
		$('.navi').click(function (){
			var divname= $(this).attr('id');
			$("."+active).hide("slide", { direction: "left" }, 400);
			$("."+divname).delay(400).show("slide", { direction: "right" }, 400);
        	active = divname;
        	$('.information').hide();
        	$('.navi').removeClass('activeBtn');
        	$(this).addClass('activeBtn');
		});
	});
</script>