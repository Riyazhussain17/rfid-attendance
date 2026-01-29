<?php
include "db.php";
date_default_timezone_set("Asia/Kolkata");
?>

<h2>Attendance Logs</h2>

<table border="1" cellpadding="5" cellspacing="0">
<tr>
  <th>Name</th>
  <th>UID</th>
  <th>Date</th>
  <th>IN</th>
  <th>OUT</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM attendance ORDER BY id DESC");

while ($row = $result->fetch_assoc()) {

    // SAFELY extract date from date_time
    $date = "";
    if (!empty($row['date_time'])) {
        $date = date("d-m-Y", strtotime($row['date_time']));
    }

    echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['uid']}</td>
        <td>{$date}</td>
        <td>{$row['in_time']}</td>
        <td>{$row['out_time']}</td>
    </tr>";
}
?>
</table>
