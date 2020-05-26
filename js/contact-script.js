function validate() {
    
    
    var valid = true;
    
    
    var name = $("#name").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var message = $("#message").val();
    
    
    if (name == "") {
        
        $("#name").css("border", "1px solid red");
        valid = false;
        
    }
    
    if (email == "") {
        
        $("#email").css("border", "1px solid red");
        valid = false;
        
    }
    
    if (!email.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
        
        $("#email").css("border", "1px solid red");
        valid = false;
        
    }
    
    if (message == "") {
        
        $("#message").css("border", "1px solid red");
        valid = false;
        
    }
    
    
    
    
    if (name != "") {
        
        $("#name").css("border", "1px solid #ccc");
        
    }
    
    if (email != "") {
        
        $("#email").css("border", "1px solid #ccc");
        
    }
    
    if (email.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/) & email != '') {
        
        $("#email").css("border", "1px solid #ccc");
        
    }
    
    if (message != "") {
        
        $("#message").css("border", "1px solid #ccc");
        
    }
    
    
    return valid;
    
}


$(function() {
   
    var form = $('#contact');
    
    var error = $('#error');
    
    var success = $('#success');
    
    
    $(form).submit(function(e) {
       
        e.preventDefault();
        
        
        var formData = $(form).serialize();
        
        var valid = validate();
        
        
        if (valid = true) {
        
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
        })
        .done(function(response) {
            
            $(error).css("display", "none");
            
            $(success).css("display", "block");
            
            $(success).text(response);
            
            
            $('#name').val('');
            $('#email').val('');
            $('#phone').val('');
            $('#website').val('');
            $('#message').val('');
            
        })
        .fail(function(data) {
            
            $(success).css("display", "none");
            
            $(error).css("display", "block");
            
            if (data.responseText !== '') {
                
                $(error).text(data.responseText);
                
            } else {
                
                $(error).text('Oops! An error occured and your message could not be sent.');
                
            }
            
        });
        }
        
    });
    
});