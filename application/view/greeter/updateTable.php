<?php
  $database = DatabaseFactory::getFactory()->getConnection();
  $query = $database->prepare("SELECT * FROM qscQueue.tblRequests WHERE serviceState IN ('wait', 'progress', 'done') AND tableNo != 0");
  $query->execute();
  $result = $query->fetchAll();
  $count = 0;
  echo "
    <thead>
      <tr>
        <th>Table Number</th>
        <th>Subject </th>
        <th>Sub-Subject </th>
        <th>Requested Tutor</th>
        <th>Time In</th>
        <th>Wait Time Elapsed</th>
        <th>Help Time Elapsed</th>
        <th>Responding Tutor</th>
      </tr>
    </thead>
  ";
  foreach ($result as $record) {
    echo "<tr";


    if ($record->subject == "Biology (BIO)") {
      echo " style='background-color: #ff6666;'"; // red
    };

    if ($record->subject == "Business (BBUS)") {
      echo " style='background-color: #ff99ff;'"; // pink
    };

    if ($record->subject == "Chemistry (CHEM)") {
      echo " style='background-color:   #ffff66;'"; // yellow
    };

    if ($record->subject == "CSS (CSS)") {
      echo " style='background-color:   #ffd966;'"; // mustard
    };

    if ($record->subject == "EE (BEE)") {
      echo " style='background-color: #66ff8c;'";  // green
    };

    if ($record->subject == "Math (MATH)") {
      echo " style='background-color: #66d9ff;'";  // sky blue
    };

    if ($record->subject == "Mech. Eng. (BME)") {
      echo " style='background-color: #ff6100;'";  // orange
    };

    if ($record->subject == "Physics (PHYS)") {
      echo " style='background-color: #ffffff;'";  // gravy
    };

    if ($record->subject == "Environmental Science (BES)") {
      echo " style='background-color:   #8cff66;'";  // greener
    };

    if ($record->subject == "Statistics & Research (STAT)") {
      echo " style='background-color:   #b366ff;'";  // purple
    };

    if ($record->subject == "Software (SW)") {
      echo " style='background-color: #668cff;'";  // navy
    };

    echo "><td>";


    
    echo $record->tableNo;
    echo "</td><td>";
    echo $record->subject;
    echo "</td><td>";
    echo $record->subSubject;
    echo "</td><td>";
    echo $record->tutorRequested;
    echo "</td><td>";

    // More info on MySQL timestap = http://dev.mysql.com/doc/refman/5.7/en/datetime.html

    // time in (time stamp)
    echo substr($record->tsRequest, 10);
    echo "</td><td>";

    // wait time (counter)
    if ($record->serviceState == 'wait') 
    {

          $orig = substr($record->tsRequest, 10);
          $hh1 = substr($orig, 0, 3); $mm1 = substr($orig, 4, 2); $ss1 = substr($orig, 7, 2);

          $curr = new DateTime("now");
          $str = substr(date_format($curr, 'Y-m-d H:i:s'), 10);
          $hh2 = substr($str, 0, 3); $mm2 = substr($str, 4, 3); $ss2 = substr($str, 7, 3);


          $secondsFromHours1 = intval($hh1) * 60 * 60; // bad form, will revise
          $secondsFromMinutes1 = intval($mm1) * 60;
          $totalSeconds1 = $secondsFromHours1 + $secondsFromMinutes1 + intval($ss1);

          $secondsFromHours2 = intval($hh2) * 60 * 60;
          $secondsFromMinutes2 = intval($mm2) * 60;
          $totalSeconds2 = $secondsFromHours2 + $secondsFromMinutes2 + intval($ss2);

          $totalSeconds1 = $totalSeconds2 - $totalSeconds1;

          $v1 = (int)($totalSeconds1 / (60 * 60));
          $totalSeconds1 = $totalSeconds1 % (60 * 60);

          $v2 = (int)($totalSeconds1 / 60);
          $totalSeconds1 = $totalSeconds1 % 60;

          $v3 = $totalSeconds1;

          /*
          $v1 = intval($hh2) - intval($hh1); // since requests are day by day, no problem here with subtracting values
          $v2 = intval($mm2) - intval($mm1);
          if (intval($v2) < 0) {
            $v2 = intval($v2) + 60;
          }
          $v3 = intval($ss2) - intval($ss1);
          if (intval($v3) < 0) {
            $v3 = intval($v3) + 60;
          }
          */
         

          //echo $v1 . ":" . $v2 . ":" . $v3;
          printf("%02d", $v1);
          echo ":";
          printf("%02d", $v2);
          echo ":";
          printf("%02d", $v3);
    } 
    else
    {
         $orig = substr($record->tsRequest, 10);
         $hh1 = substr($orig, 0, 3); $mm1 = substr($orig, 4, 2); $ss1 = substr($orig, 7, 2);

         $curr = substr($record->tsSessionStart, 10);
         $hh2 = substr($curr, 0, 3); $mm2 = substr($curr, 4, 3); $ss2 = substr($curr, 7, 3);

          $secondsFromHours1 = intval($hh1) * 60 * 60; // bad form, will revise
          $secondsFromMinutes1 = intval($mm1) * 60;
          $totalSeconds1 = $secondsFromHours1 + $secondsFromMinutes1 + intval($ss1);

          $secondsFromHours2 = intval($hh2) * 60 * 60;
          $secondsFromMinutes2 = intval($mm2) * 60;
          $totalSeconds2 = $secondsFromHours2 + $secondsFromMinutes2 + intval($ss2);

          $totalSeconds1 = $totalSeconds2 - $totalSeconds1;

          $v1 = (int)($totalSeconds1 / (60 * 60));
          $totalSeconds1 = $totalSeconds1 % (60 * 60);

          $v2 = (int)($totalSeconds1 / 60);
          $totalSeconds1 = $totalSeconds1 % 60;

          $v3 = $totalSeconds1;
/*
         $v1 = intval($hh2) - intval($hh1); // since requests are day by day, no problem here with subtracting values
         $v2 = intval($mm2) - intval($mm1);
         if (intval($v2) < 0) {
           $v2 = intval($v2) + 60;
         }
        $v3 = intval($ss2) - intval($ss1);
         if (intval($v3) < 0) {
           $v3 = intval($v3) + 60;
         }
*/
          //echo $v1 . ":" . $v2 . ":" . $v3;
          printf("%02d", $v1);
          echo ":";
          printf("%02d", $v2);
          echo ":";
          printf("%02d", $v3);
    }


    echo "</td><td>";
    if ($record->serviceState == 'progress') 
    {
          $orig2 = substr($record->tsSessionStart, 10);
          $hh3 = substr($orig2, 0, 3); $mm3 = substr($orig2, 4, 2); $ss3 = substr($orig2, 7, 2);

          $curr2 = new DateTime("now");
          $str2 = substr(date_format($curr2, 'Y-m-d H:i:s'), 10);
          $hh4 = substr($str2, 0, 3); $mm4 = substr($str2, 4, 3); $ss4 = substr($str2, 7, 3);


          $secondsFromHours3 = intval($hh3) * 60 * 60; // bad form, will revise
          $secondsFromMinutes3 = intval($mm3) * 60;
          $totalSeconds3 = $secondsFromHours3 + $secondsFromMinutes3 + intval($ss3);

          $secondsFromHours4 = intval($hh4) * 60 * 60;
          $secondsFromMinutes4 = intval($mm4) * 60;
          $totalSeconds4 = $secondsFromHours4 + $secondsFromMinutes4 + intval($ss4);

          $totalSeconds3 = $totalSeconds4 - $totalSeconds3;

          $v4 = (int)($totalSeconds3 / (60 * 60));
          $totalSeconds3 = $totalSeconds3 % (60 * 60);

          $v5 = (int)($totalSeconds3 / 60);
          $totalSeconds3 = $totalSeconds3 % 60;

          $v6 = $totalSeconds3;

/*
          $v4 = intval($hh4) - intval($hh3); // since requests are day by day, no problem here with subtracting values
          $v5 = intval($mm4) - intval($mm3);
          if (intval($v5) < 0) {
            $v5 = intval($v5) + 60;
          }
          $v6 = intval($ss4) - intval($ss3);
          if (intval($v6) < 0) {
            $v6 = intval($v6) + 60;
          }
*/
          //echo $v4 . ":" . $v5 . ":" . $v6;
          printf("%02d", $v4);
          echo ":";
          printf("%02d", $v5);
          echo ":";
          printf("%02d", $v6);
    }  
    else if ($record->serviceState == 'done') 
    {
          $orig2 = substr($record->tsSessionStart, 10);
          $hh3 = substr($orig2, 0, 3); $mm3 = substr($orig2, 4, 2); $ss3 = substr($orig2, 7, 2);

          
          $str2 = substr($record->tsSessionEnd, 10);
          $hh4 = substr($str2, 0, 3); $mm4 = substr($str2, 4, 3); $ss4 = substr($str2, 7, 3);

          $secondsFromHours3 = intval($hh3) * 60 * 60; // bad form, will revise
          $secondsFromMinutes3 = intval($mm3) * 60;
          $totalSeconds3 = $secondsFromHours3 + $secondsFromMinutes3 + intval($ss3);

          $secondsFromHours4 = intval($hh4) * 60 * 60;
          $secondsFromMinutes4 = intval($mm4) * 60;
          $totalSeconds4 = $secondsFromHours4 + $secondsFromMinutes4 + intval($ss4);

          $totalSeconds3 = $totalSeconds4 - $totalSeconds3;

          $v4 = (int)($totalSeconds3 / (60 * 60));
          $totalSeconds3 = $totalSeconds3 % (60 * 60);

          $v5 = (int)($totalSeconds3 / 60);
          $totalSeconds3 = $totalSeconds3 % 60;

          $v6 = $totalSeconds3;


/*
          $v4 = intval($hh4) - intval($hh3); // since requests are day by day, no problem here with subtracting values
          $v5 = intval($mm4) - intval($mm3);
          if (intval($v5) < 0) {
            $v5 = intval($v5) + 60;
          }
          $v6 = intval($ss4) - intval($ss3);
          if (intval($v6) < 0) {
            $v6 = intval($v6) + 60;
          }
*/
          //echo $v4 . ":" . $v5 . ":" . $v6;
          printf("%02d", $v4);
          echo ":";
          printf("%02d", $v5);
          echo ":";
          printf("%02d", $v6);
    }   
    else
    {
      echo "-";
    }
    echo "</td><td>";
    echo $record->helpingTutor;
    echo "</td></tr>";
  }
?>
