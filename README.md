# Team fEMR

teamfemr.org

## Community

1. [Slack](http://teamfemr.org/slack.html)
2. [JIRA](https://teamfemr.atlassian.net)
3. [Mailing List](https://groups.google.com/forum/#!forum/team-femr)

## Prerequisites

### Option 1: Docker (Recommended)

If you have Docker Desktop installed, you can use Laravel Sail and don't need to install PHP, Composer, or Node.js locally:

- **Docker Desktop** - [Download](https://www.docker.com/products/docker-desktop)

### Option 2: Local Environment

If you prefer to run the project without Docker:

- **PHP >= 8.3**
- **Composer** - [Download](https://getcomposer.org/download/)
- **Node.js >= 14.x** - [Download](https://nodejs.org/en/download)
- **MySQL 8.0** - [Download](https://dev.mysql.com/downloads/mysql/)

## Getting Started for New Developers

### 1. Clone the Repository

```bash
git clone https://github.com/YOUR_ORG/teamfemr.org.git
cd teamfemr.org
```

### 2. Environment Configuration

Copy the example environment file and configure it:

```bash
cp .env.example .env
```

Edit the `.env` file and set the required values:

- `GOOGLE_MAPS_API_KEY` - Required for location features ([Get API Key](https://developers.google.com/maps/documentation/javascript/get-api-key))
- Other values are pre-configured for local development with Laravel Sail

### 3. Install Dependencies

```bash
composer install
npm install
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Start the Development Environment

This project uses Laravel Sail for Docker-based local development:

```bash
./vendor/bin/sail up -d
```

This will start:

- **Application**: http://localhost (port 80)
- **MySQL Database**: localhost:3306
- **Mailpit** (email testing): http://localhost:8025

### 6. Database Setup and Seeding

Run migrations to create database tables:

```bash
./vendor/bin/sail artisan migrate
```

Seed the database with initial data:

```bash
# For production-like data
./vendor/bin/sail artisan db:seed

# For development with sample data
./vendor/bin/sail artisan db:seed --class=DevelopmentSeeder
```

### 7. Build Frontend Assets

For development (with file watching):

```bash
npm run dev
```

For production build:

```bash
npm run prod
```

### 8. Access the Application

Visit http://localhost in your browser. The application should now be running!

## Development Commands

### Laravel Sail

Sail provides a convenient CLI for interacting with your Docker environment:

```bash
# Start containers
./vendor/bin/sail up -d

# Stop containers
./vendor/bin/sail down

# Run artisan commands
./vendor/bin/sail artisan [command]

# Run composer commands
./vendor/bin/sail composer [command]

# Access the application container
./vendor/bin/sail shell

# View logs
./vendor/bin/sail logs
```

### Running Tests

```bash
./vendor/bin/sail artisan test
```

### Code Formatting

This project uses Laravel Pint for code styling:

```bash
./vendor/bin/sail composer pint
```

## Technology Stack

### Backend

- **Framework**: Laravel 12.x
- **PHP**: 8.3+
- **Database**: MySQL 8.0

### Frontend

- **JavaScript Framework**: Vue.js 2.x
- **CSS Framework**: [Bulma](http://bulma.io/)
- **Icons**: [Font Awesome](http://fontawesome.io/)
- **Build Tool**: Laravel Mix

### Maps/Location Services

- **GeocoderLaravel** - [Documentation](https://github.com/geocoder-php/GeocoderLaravel)
- **Google Maps API** - [vue2-google-maps](https://github.com/xkjyeah/vue-google-maps)
- **Open Street Maps** - [Overpass API](http://wiki.openstreetmap.org/wiki/Overpass_API)

### Development Tools

- **Laravel Sail** - Docker development environment
- **Laravel Debugbar** - Debug toolbar (dev only)
- **Laravel IDE Helper** - IDE autocompletion (dev only)

## Troubleshooting

### Permission Issues

If you encounter permission issues with Laravel Sail:

```bash
sudo chown -R $USER:$USER .
```

### Database Connection Issues

Ensure Docker containers are running:

```bash
./vendor/bin/sail ps
```

### Frontend Build Issues

Clear node modules and reinstall:

```bash
rm -rf node_modules package-lock.json
npm install
```

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Sail Documentation](https://laravel.com/docs/sail)
- [Vue.js 2 Documentation](https://v2.vuejs.org/)
- [Bulma Documentation](https://bulma.io/documentation/)

## Production Secrets

Do not commit real secrets to the repository, including `.env.production`.

Use `.env.production.example` as a template and inject real values at runtime through AWS ECS task definitions:

- Non-secret values: task `environment`
- Secret values: task `secrets` from AWS Secrets Manager or SSM Parameter Store

Required production values include:

- `APP_KEY`
- `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_BUCKET`
- `GOOGLE_MAPS_API_KEY`

If any secret was ever committed, rotate it immediately even if the file is now ignored.
