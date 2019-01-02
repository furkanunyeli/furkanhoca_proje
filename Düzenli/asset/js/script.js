
$(document).ready(function(){
	
	$("#file").change(function(e){
		var img = e.target.files[0];

		if(!iEdit.open(img, true, function(res){
			$("#result").attr("src", res);
			
		})){
			alert("Whoops! That is not an image!");
		}

	});
	$("#ufile").change(function(e){
		var img = e.target.files[0];

		if(!iEdit.open(img, true, function(res){
			$("#gupdate").attr("src", res);
			
		})){
			alert("Whoops! That is not an image!");
		}

	});
});