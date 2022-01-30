function sendAjax(response, link, type, dataType, redirect='')
{
	$(response).html('<div><center>Please Wait ...</center></div>');
	if(redirect == '')
	{
		$.ajax({
			url 	: link,
			type 	: type,
			dataType: dataType,
			success : function(data)
			{
				$(response).html(data);
			}
		});
	} else {
		$.ajax({
			url 	: link,
			type 	: type,
			dataType: dataType,
			success : function(data)
			{
				if(data == 'redirect')
				{
					window.location.href = redirect;
				} else {
					$(response).html(data);
				}
			}
		});
	}
}