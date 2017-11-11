<?php
  header('Content-Type: application/json');
  if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
    && isset($_POST))
  {
    $data = $_POST;

    $to      = '';
    $subject = 'ajax-mail';
    $message = $data['body'];
    $headers = 'From: ' . $data['email'] . "\r\n";

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    mb_send_mail($to, $subject, $message, $headers);

    echo json_encode( "mail sent." );
  }else{
    http_response_code(403);
  }
