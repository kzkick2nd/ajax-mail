<?php
  if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
    && isset($_POST))
  {
    header('Content-Type: application/json');
    $from_mail = htmlspecialchars($_POST['email']);
    $message   = htmlspecialchars($_POST['body']);

    if(is_valid_email($from_mail)){
      $to      = '';
      $subject = 'ajax-mail';
      $headers = 'From: '.$from_mail."\r\n";

      mb_language("Japanese");
      mb_internal_encoding("UTF-8");
      mb_send_mail($to, $subject, $message, $headers);

      echo json_encode( "mail sent." );
    }else{
      http_response_code(400);
      echo json_encode( "email address invalid." );
    }
  }else{
    http_response_code(403);
  }

  function is_valid_email($email)
  {
    return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
  }
