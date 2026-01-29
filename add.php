<?php
include "db.php";
date_default_timezone_set("Asia/Kolkata");

$uid = $_GET['uid'];
$now = date("Y-m-d H:i:s");

/* Check registered card */
$user = $conn->query("SELECT * FROM users WHERE uid='$uid'");
if ($user->num_rows == 0) {
    echo "Unregistered Card";
    exit();
}

$name = $user->fetch_assoc()['name'];

/* Get last entry */
$last = $conn->query(
    "SELECT * FROM attendance 
     WHERE uid='$uid' 
     ORDER BY id DESC 
     LIMIT 1"
);

if ($last->num_rows == 0) {

    // FIRST IN
    $conn->query(
        "INSERT INTO attendance (uid, name, date_time, in_time)
         VALUES ('$uid', '$name', '$now', '$now')"
    );
    echo "IN marked";

} else {

    $row = $last->fetch_assoc();

    if ($row['out_time'] == NULL) {

        // MARK OUT
        $conn->query(
            "UPDATE attendance 
             SET out_time='$now' 
             WHERE id={$row['id']}"
        );
        echo "OUT marked";

    } else {

        // NEW IN
        $conn->query(
            "INSERT INTO attendance (uid, name, date_time, in_time)
             VALUES ('$uid', '$name', '$now', '$now')"
        );
        echo "IN marked";
    }
}
?>
