<?php
include 'config.php';

function registerUser($conn, $username, $email, $password) {
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $passwordHash);
    return $stmt->execute();
}

function loginUser($conn, $username, $password) {
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $passwordHash);
        $stmt->fetch();
        if (password_verify($password, $passwordHash)) {
            return $id;
        }
    }
    return false;
}
?>
