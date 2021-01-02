function AJAXProcess(path, form)
{
	
	if(typeof(form)==='undefined') form = 'comm-form';
	
	
	var dataStr = $('#'+form).serialize();
	$.ajax({
				
				
				
				type:'post',
				url:path+'.php',
				data:dataStr,
				success:function(response) 
				{
					
					//setTimeout('$("#msg").html("")', 5000);
					ajaxResponse(response);
				}
			});
}

var pkey=0;
function ret_valid_digit(evt, type, cnt)
{
	pkey= (evt.which) ? evt.which : event.keyCode;
	
	if(pkey==8 || pkey==127)
		return true;
	if(type=='int')
	{
		if(pkey>=48 && pkey <=57)
			return true;
	}
	else if(type=='double')
	{
		if(pkey>=48 && pkey <=57)
			return true;
		
		if(pkey==46 && cnt==-1)
			return true;
	}
	
	return false;
}