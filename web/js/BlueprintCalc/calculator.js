// Add event listener to hide columns for copy paste
$(function()
{
    jQuery('.copy-btn').on('click', function ()
    {
        console.log('here');
        jQuery('.table-hide').toggle(function ()
        {
            jQuery('.table-hide').hide();
        }, function (){});
    });
});
