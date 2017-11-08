<?php
  $data = $_POST;

  mb_language("Japanese");
  mb_internal_encoding("UTF-8");

  $to      = '';
  $subject = 'ajax-mail';
  $message = $data['body'];
  $headers = 'From: ' . $data['email'] . "\r\n";

  mb_send_mail($to, $subject, $message, $headers);

  header('Content-Type: application/json');
  echo json_encode( "mail sent." );
