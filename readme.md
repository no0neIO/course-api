# Course Management API

Welcome to the Course Management API project. This application provides a RESTful API for managing courses, built with Symfony.

## Prerequisites

Ensure you have the following tools installed before getting started:

- [Composer](https://getcomposer.org/)
- [Symfony CLI](https://symfony.com/download)
- PHP >= 8.2
- MySQL

## Installation

Follow these steps to set up and run the project:

1. **Clone the repository:**

    ```bash
    git clone https://github.com/no0neIO/course-api.git
    cd <project-directory>
    ```

2. **Install dependencies:**

    ```bash
    composer install
    ```

3. **Configure the database:**

   Open the `.env` file and update the `DATABASE_URL` to your preferred database configuration:

    ```env
    DATABASE_URL="mysql://root:@127.0.0.1:3306/course_db"
    ```

4. **Create the database:**

    ```bash
    php bin/console doctrine:database:create
    ```

5. **Run the database migrations:**

    ```bash
    php bin/console doctrine:migrations:migrate
    ```

6. **Start the Symfony server:**

    ```bash
    symfony server:start
    ```

7. **Access the API documentation:**

   Open your browser and navigate to `http://localhost:8000/api/doc` to view the Swagger UI for API documentation.

## Usage

### Endpoints

The following endpoints are available for managing courses:

- **GET /courses:** Retrieve a list of all courses.
- **GET /courses/{id}:** Retrieve details of a single course by ID.
- **POST /courses:** Create a new course.
- **PUT /courses/{id}:** Update an existing course by ID.
- **DELETE /courses/{id}:** Soft delete a course by ID.

### Postman Collection

A Postman collection is available at the root of the project to facilitate testing the API. Import this collection into Postman to quickly get started with the API requests.
