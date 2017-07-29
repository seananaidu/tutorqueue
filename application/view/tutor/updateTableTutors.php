<?php
  $database = DatabaseFactory::getFactory()->getConnection();
  $query = $database->prepare("SELECT * FROM qscQueue.tblRequests WHERE serviceState IN ('wait', 'progress', 'done')");
  $query->execute();
  $result = $query->fetchAll();
  $q2 = $database->prepare("SELECT * FROM qscQueue.tblTutorQuickNotes");
  $q2->execute();
  $r2 = $q2->fetchAll();



  echo "
    <thead>
      <tr><th>Table<br>Number</th>
          <th>Subject</th>
          <th>Sub-Subject</th>
          <th>Requested<br>Tutor</th>
          <th>In<br>Queue</th>
          <th>Being<br>Helped</th>
          <th>Done</th>
          <th>Notes</th>
          <th>Responding<br>Tutor</th>
          <th>Remove</th>
          <th>Add to<br>front <b>(disabled<sup>1</sup>)</b></th>
      </tr>
    </thead>
  ";

  foreach ($result as $record) {

    if (intval($record->tableNo) <= 0) {
      continue;
    }

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
      echo " style='background-color: #b3b3b3;'";  // light gray
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

    if ($record->serviceState == "wait") {
      echo "<input type='radio' name='$record->id' value='wait' checked='checked'>";
    } else {
      echo "<input type='radio' name='$record->id' value='wait'>";
    }

    echo "</td><td>";

    if ($record->serviceState == "progress") {
      echo "<input type='radio' name='$record->id' value='progress' checked='checked'>";
    } else {
      echo "<input type='radio' name='$record->id' value='progress'>";
    }

    echo "</td><td>";

    // Because done can mean notes still need to be added
    if ($record->serviceState == "done") {
      echo "<input type='radio' name='$record->id' value='done' checked='checked'>";
    } else {
      echo "<input type='radio' name='$record->id' value='done'>";
    }

    echo "</td><td>";

    echo "<input id='custNotes' type='text' name='customNotes' title='Notes are saved upon removal'>";
    echo "<select id='dropNotes$record->id' class='input-small'>";
    echo "<option selected='selected'></option>";
    $dropNumber = 0;
    foreach ($r2 as $rec2) {
        echo "<option value='$dropNumber'>$rec2->qNoteReason</option>";
        $dropNumber += 1;
    }

    echo "</select>";
    echo "</td><td>";
    echo $record->helpingTutor;
    echo "</td><td>";
    echo "<input type='checkbox' name='removeChkBox' id='$record->id'>";
    echo "</td><td>";
    echo "<input type='checkbox' name='addTopChkBox' id='$record->id' disabled>";
    echo "</td></tr>";
  }
?>
