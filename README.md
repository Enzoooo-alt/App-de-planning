# Lyon Palme - Swimming Club Management System

## Project Status: Reset to Initial Development State

This application has been reset to a clean development state with:
- **Backend**: Fully functional with complete CRUD operations for swimmers, trainings, planning, materials, and competitions
- **Frontend**: Simplified to basic Tailwind CSS styling without complex animations or themes
- **Database**: Complete structure with seeders for development data

## About Lyon Palme

Lyon Palme is a swimming club management system built with Laravel. This application manages all aspects of a swimming club including:

- **Swimmer Management**: Registration and profile management for club members
- **Training Sessions**: Planning and tracking of training sessions
- **Competition Management**: Organization and results tracking for competitions  
- **Material Management**: Inventory and maintenance of swimming equipment
- **Planning System**: Scheduling of club activities and events

## Features

- Complete CRUD operations for all entities
- User authentication and authorization
- Dashboard with key metrics and information
- Responsive design with Tailwind CSS
- Database seeding for development data

## Technical Stack

- **Backend**: Laravel 11.x with PHP 8.2+
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: MySQL/SQLite with Eloquent ORM
- **Authentication**: Laravel Breeze
- **Build Tools**: Vite for asset compilation

## Installation

1. Clone the repository
2. Install dependencies: `composer install && npm install`
3. Copy environment file: `cp .env.example .env`
4. Generate application key: `php artisan key:generate`
5. Configure database in `.env`
6. Run migrations: `php artisan migrate`
7. Seed database: `php artisan db:seed`
8. Build assets: `npm run build`
9. Start server: `php artisan serve`

## Development Status

The application has been reset to a clean initial development state:

- ✅ **Backend**: Fully functional with all CRUD operations
- ✅ **Database**: Complete structure with relationships
- ✅ **Basic Views**: Simple, functional interface
- ✅ **Authentication**: User login/registration system
- 🔄 **Frontend**: Ready for UI/UX enhancement
- 🔄 **Testing**: Ready for comprehensive test suite

## Next Steps

This application provides a solid foundation for swimming club management. The backend is complete and functional, while the frontend uses basic styling that can be enhanced with:

- Custom design system and branding
- Advanced UI components and interactions
- Mobile-first responsive design improvements
- Performance optimizations
- Additional features and modules

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
