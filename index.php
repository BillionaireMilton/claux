<!DOCTYPE html>
<html>
<head>
  <title>Customer API Documentation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    h1 {
      margin-bottom: 20px;
      color: #333;
    }
    h2 {
      margin-bottom: 10px;
      color: #666;
    }
    p {
      margin-bottom: 5px;
      color: #888;
    }
    code {
      background-color: #f2f2f2;
      padding: 2px 4px;
      color: #333;
    }
    ul {
      margin-top: 5px;
      margin-bottom: 15px;
    }
    li {
      color: #444;
      margin-bottom: 5px;
    }
    .get {
      color: #228B22;
    }
    .post {
      color: #008080;
    }
    .put {
      color: #0000FF;
    }
    .patch {
      color: #800080;
    }
    .delete {
      color: #FFA500;
    }
  </style>
</head>
<body>
  <h1>Customer API Documentation</h1>
  <p>Base URL: <code>http://localhost/web/claux/customers</code></p>
  
  <h2 class="post">Create a Customer</h2>
  <p>HTTP Method: <code>POST</code></p>
  <p>Endpoint: <code>/</code></p>
  <p>Parameters:</p>
  <ul>
    <li><strong>name</strong> (string, required): The name of the customer.</li>
    <li><strong>email</strong> (string, required): The email address of the customer.</li>
    <li><strong>phone</strong> (string, required): The phone number of the customer.</li>
  </ul>
  
  <h2 class="delete">Delete a Customer</h2>
  <p>HTTP Method: <code>DELETE</code></p>
  <p>Endpoint: <code>/{customer_id}</code></p>
  <p>Parameters:</p>
  <ul>
    <li><strong>customer_id</strong> (integer, required): The ID of the customer to delete.</li>
  </ul>
  
  <h2 class="get">Read All Customers</h2>
  <p>HTTP Method: <code>GET</code></p>
  <p>Endpoint: <code>/</code></p>
  
  <h2 class="get">Read a Customer</h2>
  <p>HTTP Method: <code>GET</code></p>
  <p>Endpoint: <code>/{customer_id}</code></p>
  <p>Parameters:</p>
  <ul>
    <li><strong>customer_id</strong> (integer, required): The ID of the customer to retrieve.</li>
  </ul>
  
  <h2 class="put">Update a Customer</h2>
  <p>HTTP Method: <code>PUT</code></p>
  <p>Endpoint: <code>/{customer_id}</code></p>
  <p>Parameters:</p>
  <ul>
    <li><strong>customer_id</strong> (integer, required): The ID of the customer to update.</li>
    <li><strong>name</strong> (string, optional): The updated name of the customer.</li>
    <li><strong>email</strong> (string, optional): The updated email address of the customer.</li>
    <li><strong>phone</strong> (string, optional): The updated phone number of the customer.</li>
  </ul>
  
  <h2 class="patch">Edit a Customer</h2>
  <p>HTTP Method: <code>PATCH</code></p>
  <p>Endpoint: <code>/{customer_id}</code></p>
  <p>Parameters:</p>
  <ul>
    <li><strong>customer_id</strong> (integer, required): The ID of the customer to edit.</li>
    <li><strong>name</strong> (string, optional): The updated name of the customer.</li>
    <li><strong>email</strong> (string, optional): The updated email address of the customer.</li>
    <li><strong>phone</strong> (string, optional): The updated phone number of the customer.</li>
  </ul>
</body>
</html>
