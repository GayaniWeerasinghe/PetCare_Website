<?php

include('db_connection.php');

if (isset($_GET['pet_id'])) {
    $pet_id = intval($_GET['pet_id']);
    $sql = "SELECT * FROM pets WHERE id = $pet_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $pet = $result->fetch_assoc();
        echo json_encode($pet);
    } else {
        echo json_encode(['error' => 'Pet not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();

?>
