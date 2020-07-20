$('#login-form').on('submit', function(e) {
    e.preventDefault();

    $.ajax({    
        url: 'login',
        method: 'POST',
        data: $(this).serialize(),
        success: (response) => {
            let messages= '';
            response= JSON.parse(response);
            
            if (response.status_code === 400) {
                Object.keys(response.messages).forEach(key => messages+= `${response.messages[key]}\n`);

                return alert(messages);
            } else if (response.status_code === 404) {
                messages+= response.messages;
                
                return alert(messages);
            }

            return window.location.href= BASE_URL;
        }
    })
});