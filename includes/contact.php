<?php
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require '../vendor/autoload.php';
    
    $mail = new PHPMailer();
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['recaptcha_response'])) {
        
        $name = strip_tags(trim($_POST['name']));
        $name = str_replace(array('\r','\n'), array(' ',' '), $name);
        
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        
        $phone = $_POST['phone'];
        
        $website = $_POST['website'];
        
        $message = trim($_POST['message']);
        
        //$captcha = $_POST['g-recaptcha-response'];
        
        
        if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            http_response_code(400);
            echo 'Oops! There was a problem with your submission. Please complete the form and try again.';
            exit;
            
        }
        
        
        // Build POST request:
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = 'YOUR_RECAPTCHA_SECRET_KEY';
        $recaptcha_response = $_POST['recaptcha_response'];
        
        
        // Make and decode POST request:
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);
        
        
        
        
        // PHPMailer settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->IsSMTP();
        $mail->Host = 'HOST';
        $mail->Mailer = 'smtp';
        $mail->SMTPAuth = true;
        $mail->Username = 'USERNAME';
        $mail->Password = 'PASSWORD';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        
        // PHPMailer sender & recipient
        $mail->setFrom('contact@website.com');
        $mail->addAddress('contact@website.com');
        $mail->addReplyTo($email, 'Reply to sender');
        
        
        // PHPMailer mail structure
        $mail->isHTML(true);
        $mail->Subject = 'New contact from: ' . $name;
        $mail->Body = '<b>Name:</b>  ' . $name . '<br><b>Email:</b> ' . $email . '<br><b>Phone:</b> ' . $phone . '<br><b>Website:</b> ' . $website . '<br><br><b>Message:</b><br>' . $message;
        $mail->AltBody = 'Message frome:  ' . $name . ',  ' . $email . '<br><br>' . $message;
        
        
        if ($recaptcha->score >= 0.5) {
            
            if ($mail->Send()) {
                
                http_response_code(200);
                echo "Thank you! Your message has been sent.";
                
            } else {
                
                http_response_code(500);
                echo "Oops! Something went wrong and we couldn't send your message.";
                
            }
            
        } else {
            
            http_response_code(400);
            echo "Oops! You are spammer.";
            exit;
            
        }
        
    } else {
        
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
        
    }
?>