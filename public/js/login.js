$(document).ready(function() {
    $('#login-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({    
            url: 'login',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                /* DEBUG ALERT */

                response= JSON.parse(response);

                let messages= '';

                if (response.status_code === 400) {
                    response.messages.username.forEach(item => messages+= `${item}\n`);
                    response.messages.password.forEach(item => messages+= `${item}\n`);
                } else {
                    messages+= response.messages;
                }

                alert(messages);
                window.location.reload();
                
                //SEMENTARA HARD CODE
                //window.location.href= `http://localhost/magang/jacad`;
            }
        })
    });
});