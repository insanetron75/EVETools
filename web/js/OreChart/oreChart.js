jQuery(document).ready(function ()
{
    var table = jQuery('#min-table').DataTable({
        "searching" : false,
        "lengthChange": false,
        "pageLength": 16,
        "paging": false,
        "info": false
    });
});