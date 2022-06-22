<?php
// login to DataBase credentials
$mysqlserver = "localhost";
$mysqldb = "teliki_ergasia";
$mysqluser = "root";
$mysqlpwd = "";

$conn = new mysqli($mysqlserver,$mysqluser,$mysqlpwd,$mysqldb);
if($conn -> connect_error)
{
    die("connection failed; ". $conn-> connect_error);
}

//Checking if table has data
$sql="SELECT id FROM quiz WHERE id = 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

//If not,then create
if(!isset($row['id']))
{
    $sql1 = "INSERT INTO quiz (id , question , type , ans1 , ans2 , ans3,ans4 ,correct, diff)
    VALUES(1,'Ποίος είναι ο πραγματικός δημιουργός του bitcoin;','mult1corr','Dorian Nakamoto',
    'Craig Wright','Nick Szabo','Άγνωστο',4,'easy')";

    $sql2 = "INSERT INTO quiz (id , question , type , ans1 , ans2 , ans3,ans4 ,correct, diff)
    VALUES(2,'Ποία από τα παρακάτω είναι κρυπτονομίσματα;','multi1+cor','Ethereum',
    'Cardano', 'Luna', 'Yuan',123,'easy')";

    $sql3 = "INSERT INTO quiz (id , question , type , ans1 , ans2 , ans3,ans4 ,cor-fal, diff)
    VALUES(3,'Πότε δημιουργήθηκε το bitcoin;','multiple','2012','2022' ,
    '2004','2008',4,'easy')";

    $sql4 = "INSERT INTO quiz (id , question , type , ans1 , ans2 , ans3,ans4 ,cor-fal, diff)
    VALUES(4,'Το bitcoin προσφέρει ασφάλεια και ταχύτητα στις συναλλαγές με χαμηλό κόστος','truefalse',
    'Σωστό', 'Λάθος','empty','empty',1,'easy')";

    $conn->query($sql1);
    $conn->query($sql2);
    $conn->query($sql3);
    $conn->query($sql4);
}
else
{
    echo "Table data has been already created";
    
}
$conn->close();
?>