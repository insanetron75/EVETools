$(document).ready(function () {
    //submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: 'blueprintCalculator/fetchBlueprints',
        success: function( data ) {
            $('#list').append(data);
        }
    });
});
