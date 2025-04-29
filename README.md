# Mada Client Management System (CMS)

The Mada Client Management System (CMS) is a centralized, secure platform designed to manage the full lifecycle of individuals receiving assistive technology assessments, services, and device provisions from Mada Qatar Assistive Technology Center. The system allows for tracking client information, managing assessment requests, scheduling appointments, recommending and delivering assistive technologies, documenting outcomes, and generating reports for internal and external stakeholders.

## Features

- **User Role Management**: Admin, Manager, Trusted Specialist, AT Expert, Inventory Manager, Caseworker
- **Client Management**: Track client information, disability types, and assigned specialists
- **Trusted Specialists Management**: Manage specialists who work with clients
- **AT Experts Management**: Manage assistive technology experts
- **Equipment Management**: Track assistive technology equipment inventory
- **Categories Management**: Organize equipment by categories
- **Supplier Management**: Manage equipment suppliers
- **Equipment Provision**: Track permanent equipment provisions to clients
- **Equipment Loans**: Manage equipment loans with return dates
- **Session Management**: Schedule and track client sessions
- **Dashboard**: Visual metrics and charts for system overview
- **Reporting**: Generate reports on clients, equipment, and services

## Requirements

- PHP 8.2+
- Composer
- MySQL 8.0+
- Redis (for queue and cache)
- Node.js and NPM (for frontend assets)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/achrafoth/at_test_cms.git
   cd at_test_cms
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install NPM dependencies and build assets:
   ```bash
   npm install
   npm run build
   ```

4. Create a copy of the environment file:
   ```bash
   cp .env.example .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Configure your database in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mada_cms
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

7. Configure Redis in the `.env` file (if using Redis):
   ```
   REDIS_HOST=127.0.0.1
   REDIS_PASSWORD=null
   REDIS_PORT=6379
   ```

8. Run database migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

9. Create a symbolic link for storage:
   ```bash
   php artisan storage:link
   ```

## Running the Application

Start the development server:
```bash
php artisan serve
```

The application will be available at http://localhost:8000

## Default Admin Login

After seeding the database, you can log in with the following credentials:
- Email: admin@mada.org
- Password: password

## License

The Mada CMS is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
