
<?php
  $database = DatabaseFactory::getFactory()->getConnection();
  $query = $database->prepare("SELECT * FROM qscQueue.tblRequests WHERE serviceState IN ('wait')");
  $query->execute();
  $result = $query->fetchAll();
  echo "
    <thead>
      <tr><th>Table<br>Number</th>
          <th>Subject</th>
          <th>Sub-Subject</th>
          <th>Requested<br>Tutor</th>
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
    echo "</td></tr>";
  }
?>

