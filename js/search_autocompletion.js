$(document).ready(function() {
    $('#searchUsername').keyup(function() {
        var query = $(this).val().toLowerCase();

        if(query.length > 0) { 
            $.ajax({
                url: '../php/get_accounts.php',
                method: 'POST',
                data: {query:query},
                success: function(data) {
                    $('#searchResults').fadeIn();
                    $('#searchResults').html(data);
                }
            });
        } else { 
            $('#searchResults').fadeOut();
        }
    })

    $(document).on('click', 'li', function() {
        $('#searchUsername').val($(this).text());
        $('#searchResults').fadeOut();
    });



});