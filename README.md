# Task Manager with Laravel Breeze & Spatie Permission

A simple Task Manager built with Laravel 12 to revise CRUD operations, authentication, role-based access control (RBAC), and permissions using the Spatie Laravel Permission package.

---

# Features

- User Authentication (Laravel Breeze)
- CRUD Operations for Tasks
- Task Status Update
- Role Management (Admin, Manager, User)
- Group Rights (Role Permissions)
- Middleware Protected Routes
- User Role Assignment
- Permission Based Authorization
- Tailwind CSS UI

---

# Technologies Used

- PHP 8.2+
- Laravel 12
- Laravel Breeze
- Spatie Laravel Permission
- MySQL
- Blade
- Tailwind CSS

---

# Project Structure

```
Authentication
        │
        ▼
User Login
        │
        ▼
Assigned Role
(Admin / Manager / User)
        │
        ▼
Role Permissions
        │
        ▼
Middleware checks permission
        │
        ▼
Access Granted / Denied
```

---

# Installation

Clone the project

```bash
git clone <repository-url>
```

Go inside project

```bash
cd task-manager
```

Install dependencies

```bash
composer install
```

Install frontend packages

```bash
npm install
```

Generate application key

```bash
php artisan key:generate
```

Create environment file

```bash
cp .env.example .env
```

Configure database inside `.env`

```
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations and seeders

```bash
php artisan migrate:fresh --seed
```

Start development server

```bash
php artisan serve
```

Compile assets

```bash
npm run dev
```

---

# Default Users

| Role | Email | Password |
|-------|-------|----------|
| Admin | admin@test.com | password |
| Manager | manager@test.com | password |
| User | user@test.com | password |

---

# Laravel Breeze

Laravel Breeze provides a simple authentication system.

Installed using

```bash
composer require laravel/breeze --dev
```

Install Blade stack

```bash
php artisan breeze:install
```

Run

```bash
npm install
npm run dev
php artisan migrate
```

Breeze provides

- Login
- Register
- Forgot Password
- Email Verification
- Profile Page
- Authentication Middleware

---

# Spatie Laravel Permission

Installed using

```bash
composer require spatie/laravel-permission
```

Publish files

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Run migration

```bash
php artisan migrate
```

Add trait inside User model

```php
use HasRoles;

class User extends Authenticatable
{
    use HasRoles;
}
```

---

# Database Tables

Spatie creates the following tables.

## roles

Stores all available roles.

Example

| id | name |
|----|------|
|1|admin|
|2|manager|
|3|user|

---

## permissions

Stores all permissions.

Example

| id | name |
|----|--------------------|
|1|create tasks|
|2|edit tasks|
|3|delete tasks|
|4|update task status|
|5|manage users|
|6|manage group rights|

---

## role_has_permissions

Maps permissions to roles.

Example

Admin

```
create tasks
edit tasks
delete tasks
update task status
manage users
manage group rights
```

Manager

```
create tasks
edit tasks
update task status
```

User

```
create tasks
```

---

## model_has_roles

Assigns a role to a user.

Example

```
User #1 → Admin

User #2 → Manager

User #3 → User
```

---

## model_has_permissions

Assigns permissions directly to a user.

This table is **empty** in this project because permissions are assigned through roles instead of individual users.

---

# Role Hierarchy

## Admin

- Create Task
- Edit Task
- Delete Task
- Update Status
- Manage Users
- Manage Group Rights

---

## Manager

- Create Task
- Edit Task
- Update Status

---

## User

- Create Task

---

# User Rights

Admin can assign roles to users.

Example

```
John

▼ Manager
```

Selecting another role automatically updates

```php
$user->syncRoles($request->role);
```

---

# Group Rights

Admin can assign permissions to each role.

Example

Manager

```
☑ Create Task

☑ Edit Task

☑ Update Status

☐ Delete Task
```

Saving executes

```php
$role->syncPermissions($request->permissions ?? []);
```

This updates the

```
role_has_permissions
```

table.

---

# Important Spatie Functions

## Create Role

```php
Role::create([
    'name' => 'manager'
]);
```

---

## Create Permission

```php
Permission::create([
    'name' => 'edit tasks'
]);
```

---

## Assign Role

```php
$user->assignRole('admin');
```

---

## Replace User Role

```php
$user->syncRoles('manager');
```

---

## Remove Role

```php
$user->removeRole('manager');
```

---

## Assign Permission

```php
$role->givePermissionTo('edit tasks');
```

---

## Replace Permissions

```php
$role->syncPermissions([
    'create tasks',
    'edit tasks'
]);
```

---

## Check Role

```php
$user->hasRole('admin')
```

---

## Check Permission

```php
$user->can('edit tasks')
```

---

## Get User Roles

```php
$user->getRoleNames();
```

---

## Get Permissions

```php
$user->getPermissionNames();
```

---

# Middleware Protection

Routes are protected using Spatie middleware.

Example

```php
Route::middleware([
    'auth',
    'permission:manage users'
])->group(function () {

    Route::get('/users',
        [UserController::class, 'index']
    );

});
```

Flow

```
User

↓

Logged In?

↓

Yes

↓

Permission Exists?

↓

Yes

↓

Controller

↓

View

↓

No

↓

403 Forbidden
```

---

# Seeders

Seeder creates

- Roles
- Permissions
- Users
- Role Assignments
- Permission Assignments

Run

```bash
php artisan migrate:fresh --seed
```

---

# Useful Artisan Commands

Generate key

```bash
php artisan key:generate
```

Serve project

```bash
php artisan serve
```

Fresh migration

```bash
php artisan migrate:fresh
```

Fresh migration with seed

```bash
php artisan migrate:fresh --seed
```

Clear cache

```bash
php artisan optimize:clear
```

Reset Spatie permission cache

```bash
php artisan permission:cache-reset
```

Create Controller

```bash
php artisan make:controller UserController
```

Create Seeder

```bash
php artisan make:seeder RolePermissionSeeder
```

---

# Learning Outcomes

This project helped revise

- Laravel CRUD
- MVC Architecture
- Blade Templates
- Route Model Binding
- Form Validation
- Authentication with Breeze
- Authorization
- RBAC (Role-Based Access Control)
- Middleware
- Route Protection
- Laravel Seeders
- Database Migrations
- Spatie Laravel Permission
- User Role Management
- Group Permission Management

---

# Future Improvements

- Permission middleware for CRUD buttons
- Dashboard analytics
- Search and filtering
- Pagination
- Task ownership
- Audit logs
- Soft Deletes
- Activity Log using another Spatie package
- REST API
- Unit Tests
- Email Notifications

---

# License

This project is created for learning Laravel authentication, authorization, and role-based access control using Laravel Breeze and Spatie Permission.