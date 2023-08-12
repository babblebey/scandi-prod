# Scandi-Prod

This repository contains an example project showcasing the development of a web application with a PHP-based API backend and a frontend built using ReactJS with TypeScript, ContextAPI, Axios, React Router, and Bootstrap for styling.

## Project Overview

Scandi-Prod is a web application that demonstrates the integration of a backend API with a modern frontend using various technologies and tools. The project aims to provide insights into building and connecting frontend and backend components for a seamless user experience, enhanced with Bootstrap's responsive and visually appealing styling.

## Features

- **API Backend**: The backend of the application is developed using plain PHP, offering endpoints for various functionalities.
- **Frontend**: The frontend is built using ReactJS and TypeScript, employing the ContextAPI for state management, Axios for making API requests, React Router for navigation, and Bootstrap for styling.
- **User Experience**: The project showcases how to create a user-friendly interface that communicates effectively with the backend API to provide a smooth experience for users.

## Getting Started

Follow these steps to get the project up and running on your local machine:

1. **Clone the Repository**: Clone this repository to your local machine using the following command:

   ```bash
   git clone https://github.com/babblebey/scandi-prod.git
   ```

2. **Backend Setup**:
   - Navigate to the `server` directory.
   - Install the Composer dependencie by running:

     ```bash
     composer install
     ```

   - Configure your PHP server to serve the backend code.
   - Make sure to set up the necessary database connections and configurations.
   - Import `db.sql` SQL dump file to populate database field and initial data.

3. **Frontend Setup**:
   - Navigate to the `client` directory.
   - Install the project dependencies by running:

     ```bash
     yarn install
     ```

   - Start the frontend development server with:

     ```bash
     yarn dev
     ```

4. **Access the Application**:
   - Open your web browser and navigate to the URL where your frontend server is running (usually `http://localhost:3000`).
   - Explore the various features and functionalities of the application.

## Project Structure

The project is organized into the following directories:

- **server**: Contains the PHP backend code and related files.
- **client**: Houses the ReactJS frontend code, along with the necessary components, styles, and assets.

## Acknowledgments

This project was developed by Olabode Lawal-Shittabey as an example of integrating a PHP-based backend with a modern ReactJS frontend. Special thanks to the open-source community for providing the tools and libraries that made this project possible.
