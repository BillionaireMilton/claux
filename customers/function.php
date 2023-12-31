<?php
require('../inc/dbcon.php');

// Errors
function error422($message)
{
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header('HTTP/1.0 422 Unprocessable entity');
    return json_encode($data);
    // exit();
}

// Create table if doesnt exist
function createCustomersTableIfNotExists() {
    global $conn;
    global $dbname;

    // $query = "CREATE TABLE IF NOT EXISTS api_tuts.customers (
    $query = "CREATE TABLE IF NOT EXISTS $dbname.customers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(20) NOT NULL
    )";
  
    $result = mysqli_query($conn, $query);
  
    if (!$result) {
        return "Error creating customers table: " . mysqli_error($conn);
    }
}

// Add customer
function storeCustomer($customerInput)
{
    global $conn;

    echo createCustomersTableIfNotExists();

    $name = mysqli_real_escape_string($conn, $customerInput['name']);
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $phone = mysqli_real_escape_string($conn, $customerInput['phone']);

    // Check if phone or email already exists in the table
    $query = "SELECT * FROM customers WHERE email='$email' OR phone='$phone'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row['email'] === $email) {
            return error422('Email already exists');
        } elseif ($row['phone'] === $phone) {
            return error422('Phone already exists');
        }
    } else {
        // Proceed to add the record to the table
        $insertQuery = "INSERT INTO customers (name, email, phone) VALUES ('$name', '$email', '$phone')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            $data = [
                'status' => 201,
                'message' => 'Customer Created Successfully',
                'data' => $customerInput,
            ];
            header('HTTP/1.0 201 Created');
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header('HTTP/1.0 500 Internal Server Error');
            return json_encode($data);
        }
    }
}



// Update customer
function updateCustomer($customerInput, $customerParams)
{
    global $conn;

    if (!isset($customerParams['id'])) {
        return error422('Customer id not found in URL');
    } elseif ($customerParams['id'] == null) {
        return error422('Please enter customer id');
    }

    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);
    $name = mysqli_real_escape_string($conn, $customerInput['name']);
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $phone = mysqli_real_escape_string($conn, $customerInput['phone']);

    if (empty(trim($name))) {
        return error422('Enter your name');
    } elseif (empty(trim($email))) {
        return error422('Enter your email');
    } elseif (empty(trim($phone))) {
        return error422('Enter your phone number');
    } else {
        $query = "UPDATE customers SET name='$name', email='$email', phone='$phone' WHERE id='$customerId' LIMIT 1";
        $result =  mysqli_query($conn, $query);

        if ($result) {
            // $response = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => 'Customer Updated Successfully',
                'data' => $customerInput,
            ];
            header('HTTP/1.0 200 Success');
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal  Server Error',
            ];
            header('HTTP/1.0 500 Internal  Server Error');
            return json_encode($data);
        }
    }
}

// Edit Customer Record
function editCustomer($customerInput, $customerParams){
    global $conn;

    if (!isset($customerParams['id'])) {
        return error422('Customer id not found in URL');
    } elseif ($customerParams['id'] == null) {
        return error422('Please enter customer id');
    }

    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);
    $query = "UPDATE customers SET";

    $updates = [];
    if (isset($customerInput['name'])) {
        $name = mysqli_real_escape_string($conn, $customerInput['name']);
        if (!empty(trim($name))) {
            $updates[] = "name='$name'";
        }
    }
    if (isset($customerInput['email'])) {
        $email = mysqli_real_escape_string($conn, $customerInput['email']);
        if (!empty(trim($email))) {
            $updates[] = "email='$email'";
        }
    }
    if (isset($customerInput['phone'])) {
        $phone = mysqli_real_escape_string($conn, $customerInput['phone']);
        if (!empty(trim($phone))) {
            $updates[] = "phone='$phone'";
        }
    }

    if (empty($updates)) {
        return error422('No valid data provided for update');
    }

    $query .= " " . implode(", ", $updates);
    $query .= " WHERE id='$customerId' LIMIT 1";

    $result =  mysqli_query($conn, $query);

    if ($result) {
        $data = [
            'status' => 200,
            'message' => 'Customer Updated Successfully',
            'data' => $customerInput,
        ];
        header('HTTP/1.0 200 Success');
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header('HTTP/1.0 500 Internal Server Error');
        return json_encode($data);
    }
}


// Get all customers
function getCustomerList()
{
    global $conn;

    $query = "SELECT * FROM  customers";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {

        if (mysqli_num_rows($query_run) > 0) {

            $response = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => 'Customers List Fetched Successfully',
                'data' => $response,
            ];
            header('HTTP/1.0 200 Ok');
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Customer Found',
            ];
            header('HTTP/1.0 404 No Customer Found');
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal  Server Error',
        ];
        header('HTTP/1.0 500 Internal  Server Error');
        return json_encode($data);
    }
}
// Get single customer 
function getCustomer($customerParams)
{
    global $conn;
    if ($customerParams['id'] == null) {
        return error422('Please enter customer id');
    }

    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);
    $query = "SELECT * FROM customers WHERE id='$customerId' LIMIT 1";
    $result  = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $res = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200,
                'message' => 'Customer Fetched Successfully',
                "data" => $res
            ];
            header('HTTP/1.0 200 Ok');
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Customer Found',
            ];
            header('HTTP/1.0 404 Not Found');
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal  Server Error',
        ];
        header('HTTP/1.0 500 Internal  Server Error');
        return json_encode($data);
    }
}

function deleteCustomer($customerParams)
{
    global $conn;

    if (!isset($customerParams['id'])) {
        return error422('Customer id not found in URL');
    } elseif ($customerParams['id'] == null) {
        return error422('Please enter customer id');
    }

    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);
    $query = "DELETE FROM customers WHERE id='$customerId' LIMIT 1";
    $result  = mysqli_query($conn, $query);
    if ($result) {
        $data = [
            'status' => 200,
            'message' => 'Customer Deleted Successfully',
            // "data" => $res
        ];
        header('HTTP/1.0 200 Ok');
        return json_encode($data);
    } else {
        $data = [
            'status' => 404,
            'message' => 'Customer Not Found',
        ];
        header('HTTP/1.0 404 Not Found');
        return json_encode($data);
    }
}
