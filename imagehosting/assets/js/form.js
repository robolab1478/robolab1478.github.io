$(document).ready(function()
{
	$("input[name=questionAsker]:radio").change(function () 
	{
		if(this.value == 'yes')
		{
			$('input[name=type]').attr('value','CHOSEN');
			$('label[for=urlName]').attr("class","visible");
			$('input[name=urlName]').attr("type","text");
			$('label[for=stringLength]').attr("class","hidden");
			$('input[name=stringLength]').attr("type","hidden");
			$('input[name=stringLength]').attr("required","false");
			$('input[name=urlName]').attr('required','true');
			$('#breakerYes').add('<br/>');
			$('#breakerNo').remove('<br/>');
		}
		
		else if(this.value == 'no')
		{
			$('input[name=type]').attr('value','RANDOM');
			$('label[for=urlName]').attr("class","hidden");
			$('input[name=urlName]').attr("type","hidden");
			$('label[for=stringLength]').attr("class","visible");
			$('input[name=stringLength').attr("type","number");
			$('#breakerNo').add('<br/>');
			$('#breakerYes').remove('<br/>');
			$('input[name=stringLength]').attr("required","true");
			$('input[name=urlName]').attr('required','false');
		}
	});
});