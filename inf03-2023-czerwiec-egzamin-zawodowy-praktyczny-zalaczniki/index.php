<?php

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "sklep";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}


$query1 = "SELECT nazwa FROM tabela1";

$result1 = $conn->query($query1);


if ($result1->num_rows > 0) {
    echo "<ol>";
    while ($row = $result1->fetch_assoc()) {
        echo "<li>" . $row["nazwa"] . "</li>";
    }
    echo "</ol>";
} else {
    echo "Brak wyników.";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_product = $_POST['products'];

    $query2 = "SELECT cena FROM tabela1 WHERE nazwa = '$selected_product'"; 

    $result2 = $conn->query($query2);

    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        $regular_price = $row['cena'];
        $discounted_price = $regular_price * 0.7; 
     
        echo "<div>";
        echo "Cena regularna: " . $regular_price . "<br>";
        echo "Cena w promocji 30%: " . $discounted_price;
        echo "</div>";
    } else {
        echo "Brak wyników.";
    }
}


$conn->close();
?>