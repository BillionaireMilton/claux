<?php
    // $host = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "api_tuts";

    // $conn = mysqli_connect($host, $username, $password, $dbname);

    // if(!$conn){
    //     die("Connection failed :: " . mysqli_connect_errno());
    // }

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "apis_tut";

    // Establish connection to MySQL server
    $conn = mysqli_connect($host, $username, $password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_errno());
    }

    // Create the database if it doesn't exist
    echo createDatabaseIfNotExists($conn, $dbname);

    // Select the database

    mysqli_select_db($conn, $dbname);

    // Rest of your code...

// Function to create database if not exists
function createDatabaseIfNotExists($conn, $dbname) {
    $query = "CREATE DATABASE IF NOT EXISTS $dbname";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        return "Error creating database: " . mysqli_error($conn);
    }
}
