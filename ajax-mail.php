<?php
  if(is_null($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'
    && is_null($_POST)){
    http_response_code(403);
    exit(1);
  }

  header('Content-Type: application/json');
  $from_mail = htmlspecialchars($_POST['email']);
  $message   = htmlspecialchars($_POST['body']);

  if(!is_valid_email($from_mail)){
    http_response_code(400);
    echo json_encode( "email address invalid." );
    exit(1);
  }

  $to      = '';
  $subject = 'ajax-mail';
  $headers = 'From: '.$from_mail."\r\n";

  mb_language("Japanese");
  mb_internal_encoding("UTF-8");
  mb_send_mail($to, $subject, $message, $headers);

  echo json_encode( "mail sent." );

  function is_valid_email($email){
    return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
  }
