# Project Name

Applied Web Project (PART 2)

## Overview

This project is a database-backed web application. These instructions explain how to run it locally using XAMPP on Windows and Linux.

## Prerequisites

- XAMPP installed (Windows: https://www.apachefriends.org/download.html, Linux: https://www.apachefriends.org/download.html)
- Git (optional, for cloning)
- SQL dump file included in the project (example: database.sql or db/export.sql). If none, ask the maintainer for the dump.

## Quick steps (high level)

1. Copy or clone the project into XAMPP's htdocs.
2. Start Apache and MySQL.
3. Create a database and import the SQL dump (phpMyAdmin or mysql CLI).
4. Configure the project's DB connection (config file or .env).
5. Open the site in your browser at http://localhost/YourProjectFolder/

## Detailed instructions

### 1) Put project in XAMPP htdocs

- Windows (default):
  - Copy project folder to C:\xampp\htdocs\YourProjectFolder
  - Or clone directly:
    - Open PowerShell/CMD as Administrator:
      - git clone `<repo-url>` "C:\xampp\htdocs\YourProjectFolder"
- Linux (default XAMPP):
  - Copy to /opt/lampp/htdocs/YourProjectFolder
  - Or clone:
    - sudo git clone `<repo-url>` /opt/lampp/htdocs/YourProjectFolder

### 2) Start XAMPP (Apache + MySQL)

- Windows:
  - Start XAMPP Control Panel -> click Start for Apache and MySQL.
  - Or run C:\xampp\xampp-control.exe.
- Linux:
  - Start services:
    - sudo /opt/lampp/lampp start
  - Stop services:
    - sudo /opt/lampp/lampp stop

### 3) Create database and import SQL

Option A — phpMyAdmin (recommended):

- Open http://localhost/phpmyadmin
- Create a new database (e.g., project_db).
- Select the new database -> Import -> Choose the SQL dump file from your project (e.g., /opt/lampp/htdocs/YourProjectFolder/database.sql or C:\xampp\htdocs\YourProjectFolder\database.sql) -> Go.

Option B — mysql CLI:

- Windows (from Git Bash or CMD):
  - cd C:\xampp\mysql\bin
  - mysql -u root < "C:\xampp\htdocs\YourProjectFolder\database.sql"
  - Or specify DB name: mysql -u root -e "CREATE DATABASE project_db; USE project_db;" && mysql -u root project_db < "C:\xampp\htdocs\YourProjectFolder\database.sql"
- Linux:
  - sudo /opt/lampp/bin/mysql -u root < /opt/lampp/htdocs/YourProjectFolder/database.sql
  - Or:
    - sudo /opt/lampp/bin/mysql -u root -e "CREATE DATABASE project_db;"
    - sudo /opt/lampp/bin/mysql -u root project_db < /opt/lampp/htdocs/YourProjectFolder/database.sql

Note: XAMPP MySQL default user is `root` with no password unless you set one.

### 4) Configure DB credentials for the app

- Locate the project DB config file (common names): .env, config.php, db.php, settings.php.
- Typical values to set:
  - DB_HOST=127.0.0.1 or localhost
  - DB_PORT=3306
  - DB_USER=root
  - DB_PASS=         (blank for default XAMPP)
  - DB_NAME=project_db
- Example (if .env present):
  - Copy .env.example to .env and edit values:
    - cp .env.example .env
    - Edit DB_* values accordingly.

### 5) File permissions (Linux)

- Ensure files are readable by Apache and writable for uploads if needed:
  - sudo chown -R $USER:$USER /opt/lampp/htdocs/YourProjectFolder
  - sudo find /opt/lampp/htdocs/YourProjectFolder -type d -exec chmod 755 {} \;
  - sudo find /opt/lampp/htdocs/YourProjectFolder -type f -exec chmod 644 {} \;
- If Apache needs write access to specific folders (uploads, cache), give group write:
  - sudo chown -R $USER:daemon /opt/lampp/htdocs/YourProjectFolder/storage
  - sudo chmod -R 775 /opt/lampp/htdocs/YourProjectFolder/storage

### 6) Open the app

- In your browser:
  - http://localhost/YourProjectFolder/
  - If placed in a subfolder, navigate accordingly.

## Troubleshooting

- Port 80 or 443 conflicts:
  - Stop services using those ports (IIS, Skype) or change Apache ports in XAMPP Control Panel -> Config -> httpd.conf (change Listen 80 to another port).
- phpMyAdmin login fails:
  - If you set a root password, use it. Resetting root password requires using mysql CLI or XAMPP security page.
- Missing PHP extensions:
  - Enable extensions in php.ini (in XAMPP: C:\xampp\php\php.ini or /opt/lampp/etc/php.ini). Look for extension=pdo_mysql or extension=mysqli and restart Apache.
- Database import errors (foreign keys, encoding):
  - Ensure correct DB collation/charset; import via CLI if phpMyAdmin times out.
- Permission denied on Linux:
  - Adjust ownership/permissions as above or run `sudo /opt/lampp/lampp restart` after changes.

## Common commands summary

- Windows:
  - Start XAMPP: open XAMPP Control Panel
  - Import via CLI: C:\xampp\mysql\bin\mysql -u root project_db < "C:\path\to\database.sql"
- Linux:
  - Start services: sudo /opt/lampp/lampp start
  - Import via CLI: sudo /opt/lampp/bin/mysql -u root project_db < /opt/lampp/htdocs/YourProjectFolder/database.sql

## Notes

- If you prefer not to use XAMPP, you can use native Apache/MySQL/PHP or containers (Docker).

## License

MIT License

Copyright (c) 2025 majisticswin

Permission is hereby granted, free of charge, to any person obtaining a copy

of this software and associated documentation files (the "Software"), to deal

in the Software without restriction, including without limitation the rights

to use, copy, modify, merge, publish, distribute, sublicense, and/or sell

copies of the Software, and to permit persons to whom the Software is

furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all

copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR

IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,

FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE

AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER

LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,

OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE

SOFTWARE.
