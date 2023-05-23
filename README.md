# Shopping Basket Feature

This repository contains the implementation of a shopping basket feature for an online shopping platform. The feature allows the sales team to track items that were added to the basket but removed before checkout. This data can be used later for targeted discounts.

# Technologies Used

-   Laravel: A PHP web framework used for developing the REST API.
-   MySQL: A relational database used for storing data.
-   Vue 3: A progressive JavaScript framework used for building user interfaces.
-   Pinia: A state management library for Vue 3.

## Installation

1.  Clone the repository:

    ```bash
    git clone <repository-url>
    ```

2.  Install dependencies

        Install Laravel API dependencies

        ```bash
        cd api
        composer install
        ```

        Navigate to fronted directory and Install Vue frontend dependencies

        ```bash
        cd ../frontend
        yarn
        ```

## Setup

1. For the API:

    1. Create a `.env` file in the API root directory:

    ```bash
    cd api
    cp .env.example .env
    ```

    2. Generate an application key:

    ```bash
    php artisan key:generate
    ```

    3. Open the `.env` file in a text editor and update the following variables to configure the database connection and other environment settings:

    ```makefile
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    APP_URL=http://localhost:8000
    FRONTEND_URL=http://localhost:5173
    SANCTUM_STATEFUL_DOMAINS=http://localhost:5173
    ```

    4. Run database migrations and seeders:

        ```bash
        php artisan migrate --seed
        ```

    5. Start the development server:

        ```bash
        php artisan serve
        ```

    6. Start the job process using the queue:work command on a separate cli:
        ```bash
        php artisan queue:work
        ```

    The application will be accessible at `http://localhost:8000`.

2. For the frontend:

    1. Create a `.env` file in the frontend directory:

    ```bash
    cd frontend
    touch .env
    ```

    2. Open the `.env` file in a text editor and add the following line to configure the API base URL:

    ```makefile
    VITE_APP_API_BASE_URL=http://localhost:8000
    ```

    3. Start the development server:

        ```bash
        yarn dev
        ```

To improve the note regarding the automatic login for demo purposes, you can provide additional context and clarification. Here's an improved version:

### Note: Automatic User Login for Demo Purposes

For demonstration purposes, the application has a feature that automatically logs in the user as both a regular user and an admin. This allows you to explore and experience the application's functionalities without the need for separate user accounts. To access the page displaying products for potential discounts by mentioning the `"Admin"` link on the navigation bar. It clarifies that the admin-related functionality is accessible through this link.
