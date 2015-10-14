# woofem

## Getting started

1. Fork this repo
2. Clone your fork locally
3. Create a config.json file in the repository root <br>
Here's an example:
    <code>
      {
        "site": {
          "title": "Woofem.com",
          "subtitle": "A place where pets can pet pets."
        },
        "database": {
          "db_name": "woofdb",
          "db_user": "root",
          "db_password": "root",
          "db_host": "127.0.0.1",
          "db_port": 3306
        },
        "template": {
          "template_directory": "templates",
          "partials_directory": "templates/partials"
        }
      }
    </code>
4. Use PHP's local development server to serve from the docroot directory
    <code>
      cd docroot
      php -S localhost:9000
    </code>
5. Visit localhost:9000 in your favorite web browser.