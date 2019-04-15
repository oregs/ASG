//This display a group selection box when selecting 'group'.
function fun_showselectbox()
{
	var select_status=$('#format').val();

	if(select_status == 'group')
	{
		$('#group').show();
	}
	else
	{
		$('#group').hide();
	}
}

function selectbox()
{
	var select_status=$('#format-multiple').val();

	if(select_status == 'group')
	{
		$('#group-ass').show();
	}
	else
	{
		$('#group-ass').hide();
	}
}