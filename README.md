# XML Training Procedures – Admin Panel

Small Laravel application to manage **training / procedure descriptions** stored in a structured **XML file**.

The app was built as a learning project around:

- Working with **XML data** in PHP
- Creating a clean **admin dashboard**
- Implementing **search, filters, pagination and charts**
- Adding a **contact form** with Mailtrap integration
- Basic **session-based authentication** without a database

---

## Features

### Public site

- **Home page** with a short intro to the platform  
- **How it works** page explaining the XML-based workflow  
- **About** page  
- **Contact** page with a working form:
  - Validates input
  - Sends email to a Mailtrap inbox using SMTP
  - Shows success / error feedback to the user

### Admin area

Accessible only after login.

- **Admin login**
  - Credentials stored in `.env` (`ADMIN_USERNAME` + `ADMIN_PASSWORD_HASH`)
  - Session based (no users table)
  - **Inactivity timeout middleware** (`admin.timeout`) – auto-logout after a period of inactivity
- **Fixed navbar** that changes when the admin is logged in (Create Procedure / Admin Panel / Logout)
- **Procedures table**
  - Data loaded from an XML file (`storage/app/xml/procedures.xml`)
  - Clean table layout with Tailwind styles
  - **Pagination** (10 procedures per page)
  - **Create / Edit / Delete** procedures
  - **Upload XML** block to replace the XML file from the browser
- **Search & filters**
  - Free-text search across **code, title and category**
  - Filter by **category**
  - Filter by **minimum duration**
  - Filter by **maximum duration**
  - Table, stats and charts all respect the current filters
  - “Reset” link to clear all filters
- **Dashboard stats**
  - Total number of procedures
  - Average duration
  - Number of categories
- **Charts (Chart.js)**
  - Doughnut chart: **procedures by category**
  - Line chart: **duration over time** (based on `updated_at`)

---

## Tech Stack

- **Laravel** (latest version at development time)
- **PHP** 8.4+
- **Tailwind CSS** via Vite
- **Chart.js** for data visualisation
- **Mailtrap** for email testing (SMTP)

No database is required for this project – all domain data lives in the XML file.

---

## Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install
```

### 4. Create your .env file

```bash
cp .env.example .env
```

Then generate the application key:

```bash
php artisan key:generate
```

Open **.env** and set:

```env
ADMIN_USERNAME=admin             # or another username
ADMIN_PASSWORD_HASH=...         # bcrypt hash (see next section)

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls

MAIL_FROM_ADDRESS="no-reply@xml-project.com"
MAIL_FROM_NAME="XML Project"
```

### 5. Generate an admin password hash

Pick a password (for example admin123) and hash it with Laravel:

```bash
php artisan tinker
>>> bcrypt('password123')
=> "$2y$12$..."
```

Copy the full hash into **.env**:

```env
ADMIN_PASSWORD_HASH="$2y$12$..."
```

You’ll now be able to log in with:

- **Username:** admin (or the one you configured)
- **Password:** the plain password you used in `bcrypt(...)`

### 6. Build assets & run the dev server

In one terminal:

```bash
npm run dev
```

In another terminal:

```bash
php artisan serve
```

Open the app at:
	•	http://127.0.0.1:8000

## XML Data

The XML file with procedures is stored at:

```text
storage/app/xml/procedures.xml
```

Each **<procedure>** contains fields such as:

```xml
<procedure>
    <code>TRN001</code>
    <title>Basic Safety Training</title>
    <category>Safety</category>
    <duration>30</duration>
    <description>...</description>
    <requirements>...</requirements>
    <level>Beginner</level>
    <equipment>Safety goggles</equipment>
    <updated_at>2025-02-01</updated_at>
</procedure>
```

The admin UI lets you:

- Add new procedures
- Edit existing ones
- Delete procedures
- Upload a new XML file to replace the existing one


## Security Notes

•	Admin login is handled via sessions, no database users.
•	Credentials are stored in .env:
•	Plain username
•	Bcrypt hash for password
•	AdminTimeout middleware logs the admin out after a period of inactivity.
•	Do not commit your .env file or real Mailtrap credentials to Git.

## Contact form behaviour

•	Form is available at /contact
•	Uses Laravel validation
•	Sends a raw text email to MAIL_FROM_ADDRESS (ending up in your Mailtrap inbox)
•	On success, the user is redirected back with a success flash message

Make sure your Mailtrap SMTP credentials in .env are correct before testing.

## Useful Commands

```bash
# Clear config / route / view caches if something looks weird
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

## License

This project is built on top of the Laravel framework, which is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).
You’re free to adapt this README text to your needs for example, to add screenshots or your name as the author.