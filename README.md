# Technical Assessment

This is a simple Laravel Vue (with Tailwind CSS) project that allows customers interested in insurance policies to submit their information for various insurance quotes.

## Project Setup

1. **Create .env File**: Create a file in the root directory and name it `.env`. Copy the content from the `.env.example` and paste into `.env`, and save it.

2. **Install Composer Dependencies**: Run the command

    ```bash
    composer install
    ```

3. **Install NPM Dependencies**: Run the command

    ```bash
    npm install
    ```

4. **Create Database**: Create a database (MySql DB preferably) and name it exactly as specified in the `.env` file "risk_advisor".

5. **Migrate Database**: Run the following command to populate your database with the necessary tables:

    ```bash
    php artisan migrate
    ```

6. **Run Seeder**: Run the command below to populate the product's table with some data for easy testing

    ```bash
    php artisan db:seed
    ```

## TESTS

1. To run tests, execute the command

    ```bash
    php artisan db:seed
    ```

For test coverage, you can locate (and open in a browser) the `index.html` file in the `\coverage` folder in the root directory

## Run Project

1. Run the following commands in two separte terminals

    ```bash
    php artisan serve
    ```

    ```bash
    npm run dev
    ```

## API Endpoints

### Create Submission

-   **Submit Form**

    -   Method: POST
    -   Endpoint: `/api/submissions`
    -   Description: Submit form for insurance quote
    -   Request Body:
        ```json
        {
            "selectedProducts": [1, 2],
            "email": "example@gmail.com",
            "first_name": "Name",
            "last_name": "Hassan",
            "phone_number": "0249952818",
            "contact_preference": "email",
            "street_address": "Mfum Lane, Alajo",
            "apartment": "1st block",
            "city": "Accra",
            "state": "Greater Accra",
            "zip_code": "00233"
        }
        ```
    -   Response:
        ```json
        {
            "data": {
                "message": "Form submitted successfully"
            }
        }
        ```
