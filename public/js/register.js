$('#register-form').on('submit', function(e) {
    e.preventDefault();

    alert('Please wait...');

    $.ajax({
        url: 'register',
        method: 'POST',
        data: $(this).serialize(),
        success: (response) => {
            let messages= '';
            response= JSON.parse(response);
            
            if (response.status_code === 400) {
                Object.keys(response.messages).forEach(key => messages+= `${response.messages[key]}\n`);

                return alert(messages);
            } 

            messages+= `Register success\nCheck your e-mail to verifiy`;

            alert(messages);
            
            return window.location.href= BASE_URL;
        }
    });
});