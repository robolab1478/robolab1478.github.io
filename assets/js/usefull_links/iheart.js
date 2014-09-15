var per_ihr_init = false;
function personal_ihr_init()
{
	if(!(per_ihr_init))
	{
		var toInput = $("#iheart");
		jQuery('<iframe/>', 
		{	
			id:'iheartframe',
	   		src: 'https://iheart.com',
	   		title: 'IHR',
		    height: "750px",
	   		width: "750px",
		}).appendTo(toInput);
		jQuery('<br/>').appendTo($("#ihearta"));
		hasInit = true;
	}
}
