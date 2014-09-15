$(document).ready(function()
{
	var iheart_runnable = true;
	$("#iheart").click(function()
	{
		if(iheart_runnable)
		{
			personal_ihr_init();
			iheart_runnable = false;
		}
	});
});
