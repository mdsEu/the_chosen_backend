# **THE CHOSEN - BACKEND PROJECT**

## **Description**

This file has the instructions to launch the headless WordPress CMS within a docker container.

## **Installation**

1. Install a MySQL database with version 8.0 of the database engine on the DB system that you will be using (AWS RDS, Cloud SQL, etc.).

2. Before importing the database, you must replace the url = <https://tchos.devmds.com> to [the new backend url] into the database file located at `./database/db_031023.sql.`

3. Import the database from the `./database/db_031023.sql` file in the root of the project.

4. Copy the env.example file to .env and/or add the following variables as Docker environment variables and update their values accordingly:

   - DB_NAME=chos_db (**Name of the database within your environment**)
   - DB_HOST=localhost (**Host of the database location**)
   - DB_USER=chos_user (**Database user, must have at least read/write permissions**)
   - DB_PASSWORD=chos_password (**Database password**)
   - DB_PORT=3306 (**Database port**)
   - SITE_URL=<http://localhost> (**URL where the CMS admin tool will live. It must be publicly accessible**)
   - DEBUG=FALSE

5. Run Docker with the following commands:
   `docker-compose up` or `docker-compose build`.

6. If you ran `docker-compose build`, you must run `docker-compose up`.

7. The docker runs on port 80.

8. The proxy must be watching on port 80 to forward all requests through this port, even if the request comes from port 443.

9. The following folders must have write permissions:

   - `./wp-content/plugins`
   - `./wp-content/options`
   - `./wp-content/themes`
   - `./wp-content/languages`
   - `./wp-content/uploads`
