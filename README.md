# School Management Program

Welcome to the School Management Program repository. This application is designed to manage various aspects of a school, including localization, CRUD operations, seeding, form wizard using Livewire, real-time validation, file management, attendance and absence system, relationships, fee processing, accounting, indirect Zoom meetings, multi-authentication, dashboards for admin, teacher, student, and parent, calendar and events, and a quiz system.

## Features

- **Mcamera Localization Package:** Provides localization features for the program.
- **Spatie translatable Package:** Provides multiple languages features for the program.
- **CRUD Operations:** Create, Read, Update, and Delete operations for managing school data.
- **Seeding:** Initial data seeding for the application.
- **Form Wizard with Livewire:** Interactive form wizard using Livewire for a smooth user experience.
- **Real-Time Validation:** Validate forms in real-time to enhance user input accuracy.
- **File Management:** Upload, download, and delete files from both the database and the server.
- **Attendance and absence system:**Building an attendance and absence system for students involves tracking their attendance in classes.
- **Relationships:** Handles one-to-one, one-to-many and many-to-many  relationships in the database.
- **Fee Processing and Accounting:** Manages fees and accounting processes within the school.
- **Indirect Zoom Meeting:** indirect Integration with Zoom for meetings.
- **Multi Auth and Dashboards:** Multi-authentication system with separate dashboards for admin, teacher, student, and parent.
- **Calendar and Events:** Keep track of school events and manage the academic calendar.
- **Quiz System:** Teachers can create quizzes for students, and students can answer them to receive marks.

## Getting Started

Follow these steps to set up and run the School Management Program:

1. Clone the repository: `git clone https://github.com/your-username/school-management-program.git`
2. Install dependencies: `composer install`
3. Configure your environment variables: Copy `.env.example` to `.env` and set up your database and other configuration settings.
4. Run migrations: `php artisan migrate`
5. Seed the database: `php artisan db:seed`
6. Generate application key: `php artisan key:generate`
7. Start the development server: `php artisan serve`

## Contributing

If you would like to contribute to the project, please follow our [contribution guidelines](CONTRIBUTING.md).

## License

This project is licensed under the [MIT License](LICENSE).
