<!DOCTYPE html>
<html lang="en">
    
    <head>
        <title>Contact form - Demo</title>
        
        <meta charset="UTF-8">
        <meta name="description" content="Contact form">
        <meta name="keywords" content="contact, form">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Main Stylesheets -->
        <link rel="stylesheet" href="css/style.css"/>
        
        <!-- Google reCaptcha -->
        <script src="https://www.google.com/recaptcha/api.js?render=YOUR_RECAPTCHA_SITE_KEY"></script>
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute('YOUR_RECAPTCHA_SITE_KEY', { action: 'contact' }).then(function (token) {
                    var recaptchaResponse = document.getElementById('recaptchaResponse');
                    recaptchaResponse.value = token;
                });
            });
        </script>

    </head>
    
    <body>
        
        <div class="container">
            
            <form id="contact" action="includes/contact.php" method="post">
                
                <h3>Contact Form</h3>
                
                
                <div id="success"></div>
                <div id="error"></div>
                
                
                <fieldset>
                    <input name="name" id="name" placeholder="Your name" type="text" tabindex="1">
                </fieldset>
                
                <fieldset>
                  <input name="email" id="email" placeholder="Your Email Address" type="email" tabindex="2">
                </fieldset>
                
                <fieldset>
                  <input name="phone" id="phone" placeholder="Your Phone Number (optional)" type="tel" tabindex="3">
                </fieldset>
                
                <fieldset>
                  <input name="website" placeholder="Your Web Site (optional)" type="url" tabindex="4">
                </fieldset>
                
                <fieldset>
                  <textarea name="message" id="message" placeholder="Type your message here...." tabindex="5"></textarea>
                </fieldset>
                
                <fieldset>
                  <button name="submit" id="contact-submit" type="submit" data-submit="...Sending">Submit</button>
                </fieldset>
                
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                
            </form>
            
        </div>
        
        
        <!-- Java Script -->
        <script src='js/jquery-3.2.1.min.js'></script>
        <script src='js/contact-script.js'></script>
        
    </body>
    
</html>