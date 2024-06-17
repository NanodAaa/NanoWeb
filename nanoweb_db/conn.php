<?php
$SERVER_NAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE_NAME = 'nanoweb_db';

// Login to nanodb
$conn = new mysqli($SERVER_NAME, $USERNAME, $PASSWORD, $DATABASE_NAME);
if ($conn->connect_error) {
    die("Connection failed!". $conn->connect_error);
}
//echo "Connect success!";
