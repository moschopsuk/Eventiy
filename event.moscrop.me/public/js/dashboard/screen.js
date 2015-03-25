$(function() 
{
	$(document).on('submit', '#edit-screen-form', function()
    {
        var sArray = $(this).serializeArray();
        $.ajax({
            "type": "PUT",
            "url": window.location.href.toString(),
            "data": sArray,
            "dataType": "json"
        }).done(function(result)
        {
            if(typeof result.message !== 'undefined')
            {
                showStatusMessage(result.message, result.messageType);
            }
            else if(typeof result.errorMessages !== 'undefined')
            {
                showRegisterFormAjaxErrors(result.errorMessages);
            }
        });

        return false;
    });
});