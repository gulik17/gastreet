<?php

  require 'eventonline.class.php';

  $EO = new EventOnline('http://metroconf.tmweb.ru', '68e1c_admin', '27SzOBpd');

  // getMasterclasses()

/*  echo "\nTEST FUNCTION getMasterclasses()\n";
  $R = $EO->getMasterclasses();
  echo "getMasterclasses() finished\n";
  echo "getLastError() error: $EO->getLastError \n";
  echo "function result:".print_r($R,true);
*/
  // saveMasterclass($masterclass_id, $name, $time_spending, $withcontrol);

  echo "\nTEST FUNCTION saveMasterclass(masterclass_id, name, time_spending, withcontrol)\n";

  $masterclass_id = 5;
  $name = 'Новый мастеркласс +';
  $time_spending = '2018-03-21 15:31:03';
  $withcontrol = true;

  $R = $EO->saveMasterclass($masterclass_id, $name, $time_spending, $withcontrol);
  echo "saveMasterclass() finished\n";
  echo "saveMasterclass() error: $EO->getLastError \n";
  echo "function result:".print_r($R,true);

die();
  // deleteMasterclass(masterclass_id);

  echo "\nTEST FUNCTION deleteMasterclass(masterclass_id, name, time_spending, withcontrol)\n";

  $masterclass_id = 8;

  $R = $EO->deleteMasterclass($masterclass_id);

  echo "deleteMasterclass() finished\n";
  echo "deleteMasterclass() error: ".$EO->getLastError()." \n";
  echo "function result:".print_r($R, true);

  // saveTicket($signature, $first_name, $middle_name, $last_name, 
  //    $email, $phone, $organization, $rank, $status, $ticket_type, $printed, 
  //    $note, $masterclass_array)

  echo "\nTEST FUNCTION saveTicket(signature, first_name, middle_name, last_name, ".
      "email, phone, organization, rank, status, ticket_type, printed, ".
      "note, masterclass_array)\n";

  $R = $EO->saveTicket('203465039210106951766919014142787452928', 't_first', 't_middle', 't_last', 
      'email', 'phone', 'organization', 'rank', 'status', 'ticket_type', false, 
      'note', [3,4]);
  echo "saveTicket finished\n";
  echo "saveTicket error: ".$EO->getLastError()." \n";
  echo "function result:".print_r($R, true);

  // deleteTicket($signature)

  echo "\nTEST FUNCTION deleteTicket(signature)\n";

  $R = $EO->deleteTicket('203465039210106951766919014142787452928');

  echo "deleteTicket finished\n";
  echo "deleteTicket error: ".$EO->getLastError()." \n";
  echo "function result:".print_r($R, true);