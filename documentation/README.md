# Documentation Index

Welcome to the Ola Arowolo Scholarship Management System documentation.

## 📚 Documentation Structure

### Core Documentation

-   **[API Documentation](./API.md)** - Complete API reference with endpoints, authentication, and examples
-   **[Database Documentation](./DATABASE.md)** - Database schema, relationships, migrations, and queries
-   **[Deployment Guide](./DEPLOYMENT.md)** - Step-by-step deployment instructions for production
-   **[Testing Documentation](./TESTING.md)** - Testing guide, coverage reports, and best practices

### System Documentation

-   **[How It Works](./HOW_IT_WORKS.md)** - System architecture and application workflow
-   **[Roles and Permissions](./ROLES_AND_PERMISSIONS.md)** - User roles, permissions, and access control
-   **[Email Flow Plan](./EMAIL_FLOW_PLAN.md)** - Email notifications and communication workflows
-   **[Field Mapping Update](./FIELD_MAPPING_UPDATE.md)** - Form field mappings and updates

### Project Management

-   **[TODO](./TODO.md)** - Development tasks and progress tracking
-   **[Users Guide](./USERS.md)** - User account information and guidelines

---

## 🚀 Quick Start

1. **For Developers**: Start with [How It Works](./HOW_IT_WORKS.md) and [Database Documentation](./DATABASE.md)
2. **For API Integration**: Read [API Documentation](./API.md)
3. **For Deployment**: Follow [Deployment Guide](./DEPLOYMENT.md)
4. **For Testing**: Check [Testing Documentation](./TESTING.md)

---

## 📖 Main Documentation Files

### [API Documentation](./API.md)

Complete API reference including:

-   Public endpoints (home, about, contact)
-   Authentication endpoints (register, login, logout, password reset)
-   Application submission endpoints
-   Admin endpoints (future)
-   Error handling and rate limiting
-   Security considerations
-   Testing examples with cURL and Postman

### [Database Documentation](./DATABASE.md)

Comprehensive database guide covering:

-   Entity Relationship Diagrams
-   Table structures and relationships
-   Migrations and seeders
-   Indexes and performance optimization
-   Backup and restore procedures
-   Common queries and examples
-   Security best practices

### [Deployment Guide](./DEPLOYMENT.md)

Full deployment instructions for:

-   Shared hosting (cPanel) deployment
-   VPS/Cloud server deployment
-   Domain and SSL configuration
-   Environment configuration
-   Database setup
-   File permissions
-   Troubleshooting
-   Maintenance procedures

### [Testing Documentation](./TESTING.md)

Complete testing guide including:

-   Test environment setup
-   Running tests (unit, feature, coverage)
-   Test structure and organization
-   Feature and unit test documentation
-   Testing best practices
-   Continuous integration
-   Troubleshooting test failures

---

## 🏗️ System Architecture

### Technology Stack

-   **Framework**: Laravel 11 (PHP 8.2+)
-   **Frontend**: Blade templates with Tailwind CSS
-   **Database**: MySQL 5.7+ / MariaDB 10.3+
-   **Authentication**: Laravel Breeze
-   **File Storage**: Laravel Storage (public disk)

### Key Features

-   User registration and authentication
-   Online scholarship application with file uploads
-   Email notifications
-   Role-based access control
-   Admin panel (planned)
-   Performance tracking (planned)

---

## 👥 User Roles

1. **Admin** - Full system access
2. **Review Team** - Application review access
3. **Applicant** - Can submit applications
4. **Verified Beneficiary** - Approved scholarship recipients
5. **Scholar** - Current scholars with additional features
6. **User** - Basic registered users

See [Roles and Permissions](./ROLES_AND_PERMISSIONS.md) for detailed information.

---

## 📧 Email Configuration

The system uses SMTP for email delivery:

-   **Technical Sender**: oatutors@gmail.com
-   **Public Address**: scholarship@olaarowolo.com
-   **Admin Notifications**: oatutors@gmail.com

See [Email Flow Plan](./EMAIL_FLOW_PLAN.md) for complete email workflows.

---

## 🔐 Security Features

-   CSRF protection on all forms
-   Password hashing (bcrypt)
-   Email verification required
-   Rate limiting on forms and API
-   File upload validation
-   SQL injection prevention (Eloquent ORM)
-   XSS protection (Blade escaping)

---

## 📊 Current Status

### Implemented Features ✅

-   User authentication system
-   Scholarship application form
-   File upload handling
-   Email notifications
-   Contact form
-   Terms acceptance
-   Basic role system

### Planned Features 🔄

-   Admin dashboard
-   Application review workflow
-   Beneficiary management
-   Performance tracking
-   Scholar portal
-   Advanced analytics
-   Community forum

---

## 🛠️ Development

### Prerequisites

-   PHP 8.2 or higher
-   Composer 2.0+
-   Node.js 18.x+
-   MySQL 5.7+ or MariaDB 10.3+

### Local Setup

```bash
# Clone repository
git clone https://github.com/olaarowolo/scholarship.olaarowolo.com.git

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate
php artisan db:seed

# Build assets
npm run build

# Start development server
php artisan serve
```

See [Deployment Guide](./DEPLOYMENT.md) for production setup.

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test suite
php artisan test --testsuite Feature
php artisan test --testsuite Unit
```

See [Testing Documentation](./TESTING.md) for comprehensive testing guide.

---

## 📝 Contributing

1. Read the documentation thoroughly
2. Follow Laravel coding standards
3. Write tests for new features
4. Update documentation as needed
5. Submit pull requests with clear descriptions

---

## 📞 Support

-   **Email**: scholarship@olaarowolo.com
-   **Technical Support**: oatutors@gmail.com
-   **GitHub**: [olaarowolo/scholarship.olaarowolo.com](https://github.com/olaarowolo/scholarship.olaarowolo.com)

---

## 📄 License

Copyright © 2025 Ola Arowolo Foundation. All rights reserved.

---

**Last Updated**: December 6, 2025  
**Version**: 1.0.0
