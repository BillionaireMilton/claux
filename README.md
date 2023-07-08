```markdown
# PHP Customer Api Project 

This is a PHP project for managing customers.

## Setup

1. Clone the repository:

   ```bash
   git clone https://github.com/BillionaireMilton/claux.git
   ```

2. Configure the database connection in `dbcon.php`:

   ```php
   <?php
   $host = "localhost";
   $username = "root";
   $password = "";
   $dbname = "api_tuts";

   $conn = mysqli_connect($host, $username, $password, $dbname);

   if (!$conn) {
       die("Connection failed: " . mysqli_connect_errno());
   }
   ?>
   ```

   Make sure to replace the values with your own database credentials.

3. Create the `api_tuts` database and the `customers` table by running the following SQL query:

   ```sql
   CREATE DATABASE IF NOT EXISTS api_tuts;

   USE api_tuts;

   CREATE TABLE IF NOT EXISTS customers (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255) NOT NULL,
       email VARCHAR(255) NOT NULL,
       phone VARCHAR(20) NOT NULL
   );
   ```

4. Start the PHP development server:

   ```bash
   php -S localhost:8000
   ```

5. Access the application in your web browser at [http://localhost:8000](http://localhost:8000).

## API Endpoints

- **GET /customers**: Get all customers.
- **GET /customers/{id}**: Get a customer by ID.
- **POST /customers**: Create a new customer.
- **PUT /customers/{id}**: Update a customer by ID.
- **PATCH /customers/{id}**: Edit a customer by ID.
- **DELETE /customers/{id}**: Delete a customer by ID.

## Error Handling

The API follows standard HTTP status codes for indicating the success or failure of requests. In case of errors, the response will include a JSON object with the following structure:

```json
{
  "status": [status code],
  "message": "[error message]"
}
```

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
```