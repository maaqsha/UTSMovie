# MovieList

A Laravel-based movie listing application.

## Structure

- `movie/` - Main Laravel application for movie management

## Getting Started

### Prerequisites
- PHP 8.1+
- Composer
- MySQL

### Installation

1. Navigate to the movie folder:
```bash
cd movie
```

2. Install dependencies:
```bash
composer install
```

3. Create environment file:
```bash
copy .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Configure database in `.env` file (set `DB_DATABASE=dbmovie`)

6. Run migrations:
```bash
php artisan migrate
```

7. Seed the database (optional):
```bash
php artisan db:seed
```

8. Start the development server:
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## License

This project is open source.
