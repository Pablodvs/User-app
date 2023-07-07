# Installation Guide - Docker
This guide provides instructions on how to install and set up the application using Docker. Docker allows for easy and consistent deployment of the application in a containerized environment.

## Prerequisites
Docker and Docker Compose are installed on your machine.

## Installation Steps
Clone the repository:

```
git clone <repository-url>
```
Navigate to the project directory:

```
cd <project-directory>
```

Configure the email settings in the .env.example file:

- Set MAIL_MAILER=smtp
- Set MAIL_HOST=<-mail-host->
- Set MAIL_PORT=<-mail-port->
- Set MAIL_USERNAME=<-mail-username->
- Set MAIL_PASSWORD=<-mail-password->
- Set MAIL_ENCRYPTION=tls
- Set MAIL_FROM_ADDRESS="user-app@assignment.com"
- Set MAIL_FROM_NAME="${APP_NAME}" (replace ${APP_NAME} with your desired name)


Build and run the Docker containers:

```
docker-compose up
```
Once the containers are up and running, open a new terminal window and enter the application container:

```
docker exec -it <container-name> bash
```
In the application container, run the following command to execute database migrations:

```
php artisan migrate
```

You are now ready to use the application through Docker.

Access it in your web browser at http://localhost/8000/public/index.php.

## Additional Notes
Ensure that the required ports (e.g., port 80) are not being used by other applications on your machine.
If you make any changes to the Docker configuration or dependencies, rebuild the Docker containers using docker-compose up --build.

### Remember to keep your .env file secure and not share any sensitive information.
