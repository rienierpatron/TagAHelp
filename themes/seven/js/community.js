HELP = {};
HELP.community = {
	editDonationDetails:function(){
		var old_allotment = $("#fund-allotment").html();	
		$("#edit-allotment").click(function(){
			$('.displayTotalPercentage').remove();
			$('.computeTotalPercentage').show();
			var elems = $('#fund-allotment > tr');
			$("#edit-allotment").hide();
			for(i=2;i<elems.length;i++){
				var cell_unit = $(elems[i].cells);
				//allotments[] = cell_unit[1].innerText
				cell_unit[0].innerHTML = '<input type="text" class="donationName form-control" value="'+cell_unit[0].innerText+'"/>';
				cell_unit[1].innerHTML = '<center><input type="text" class="percentageRate alignCenter form-control" value="'+cell_unit[1].innerText+'"/></center>';
				cell_unit[2].innerHTML = '<i class="btn btn-danger icon-remove removeDonationField"></i>';
			}
			$("#fund-allotment").after("<tr><td colspan='3'><input type='button' value='Add new field' id='add-fund-field' class='pull-right btn btn-xs btn-info'/><input type='button' value='Save Changes' id='save-field' class='pull-right btn btn-xs btn-warning'/> <input type='button' value='Cancel' id='cancel-fund-allotment' class='btn btn-xs btn-primary pull-right'/></td></tr>");

			$("#add-fund-field").click(function(){
				var textfield = '<tr class="donationValues"><td><input type="text" class=" donationName form-control col-md-12" /></td><td><center><input type="text" class=" percentageRate alignCenter form-control " /></center></td><td><i class="btn btn-danger icon-remove removeDonationField"></i></td></tr>'
				$("#fund-allotment").append(textfield);
			});

			$("#cancel-fund-allotment").click(function(){
				$("#edit-allotment").show();
				$('#add-fund-field,#save-field,#cancel-fund-allotment').remove();
				$("#fund-allotment").empty().append(old_allotment);
				$('.computeTotalPercentage').hide();
			});

			$("#save-field").click(function(){
				var fields = {};
				var elems = $('#fund-allotment > tr');
				for(i=2;i<elems.length;i++){
					var cell_unit = $(elems[i].cells);
					fields[$(cell_unit[0]).find('input').val()] = $(cell_unit[1]).find('input').val();	
				}
				console.log(fields);
			});
		});
	},
	removeDonationDetails:function(){
		$('.removeDonationField').live('click',function(){
			$parentTr = $(this).parents('tr.donationValues');
			$parentTr.remove();
			var donation = new Array();
			i = 0 ;
			$('.percentageRate').each(function(){
				donation[i++] = $(this).val();
			});
			var total = 0;
			var grandTotal = 0;
			for(var a=0;a<donation.length;a++){
		        if(parseInt(donation[a]))
		            total += parseInt(donation[a]);
		        
		    }
		    grandTotal = total + parseInt(20);
		    $('.totalPercentage').text(grandTotal);
		    if(grandTotal > 100){
		    	$('#add-fund-field').attr('disabled',true);
		    	$('#save-field').attr('disabled',true);
		    }else{
		    	$('#add-fund-field').attr('disabled',false);
		    	$('#save-field').attr('disabled',false);
		    }	
		});
	},
	computeDonationPercentage:function(){
		var donation = new Array();
		i = 0 ;
		$('.donationTotalList').each(function(){
			donation[i++] = $(this).text();
		});
		var total = 0;
		for(var a=0;a<donation.length;a++){
	        if(parseInt(donation[a]))
	            total += parseInt(donation[a]);
	        
	    }
	    $('.totalPercentage').text(total);
	},
	inputDonationPercentage:function(){
		$('#fund-allotment').on('keyup','.percentageRate',function(){
			var donation = new Array();
			i = 0 ;
			$('.percentageRate').each(function(){
				donation[i++] = $(this).val();
			});
			var total = 0;
			var grandTotal = 0;
			for(var a=0;a<donation.length;a++){
		        if(parseInt(donation[a]))
		            total += parseInt(donation[a]);
		        
		    }
		    grandTotal = total + parseInt(20);
		    $('.totalPercentage').text(grandTotal);
		    if(grandTotal > 100){
		    	$('#add-fund-field').attr('disabled',true);
		    	$('#save-field').attr('disabled',true);
		    }else{
		    	$('#add-fund-field').attr('disabled',false);
		    	$('#save-field').attr('disabled',false);
		    }	
		});	
	},
	saveDonationPercentage:function(communityId,url){
		$('#save-field').live('click',function(){
			var name = "";
			var rate = "";
			var rateLoop = 0;
			var nameLoop = 0;
			$('.donationName').each(function () {
				if(nameLoop == 0){
			    		name = $(this).val();
		    	}else{
		    		name = name + "=|=" + $(this).val();
		    	}	
		    	nameLoop++;
			});
			$('.percentageRate').each(function () {
				if(rateLoop == 0){
			    		rate = $(this).val();
		    	}else{
		    		rate = rate + "=|=" + $(this).val();
		    	}
		    	rateLoop++;
			}); 
			if(rate || name){
				rate = rate + "=|=" + parseInt(20);	
			}else {
				rate = 20;
			}
			if(name){
				name = name + "=|=" + $('.fixedDonationName').text();
			}else {				
				name = $('.fixedDonationName').text();
			}

			var values = { 'rate' : rate,'name' : name , 'communityId' : communityId };
			$.ajax({
				url:url,
				type:'POST',
				data: { values : values },
				success:function(result){
					location.reload();
				}
			});

		});
	},
};