CREATE DATABASE IF NOT EXISTS hospital_appointment_system;
USE hospital_appointment_system;

CREATE TABLE UserType (
    usertype_id INT AUTO_INCREMENT PRIMARY KEY,
    usertype_name VARCHAR(50) NOT NULL 
);

CREATE TABLE User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL, 
    contact_number VARCHAR(11),
    usertype_id INT NOT NULL,
    FOREIGN KEY (usertype_id) REFERENCES UserType(usertype_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE Departments (
    department_id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(100) NOT NULL,
    location VARCHAR(100)
);

CREATE TABLE Doctor_Dept (
    doctor_dept_id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT NOT NULL,
    department_id INT NOT NULL,
    FOREIGN KEY (doctor_id) REFERENCES User(user_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (department_id) REFERENCES Departments(department_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Schedule (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT NOT NULL,
    day ENUM('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
    time TIME NOT NULL,
    FOREIGN KEY (doctor_id) REFERENCES User(user_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Appointment (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    schedule_id INT NOT NULL,
    date DATE NOT NULL,
    status ENUM('Pending', 'Confirmed', 'Completed', 'Cancelled') DEFAULT 'Pending',
    FOREIGN KEY (patient_id) REFERENCES User (user_id)
        ON UPDATE CASCADE 
        ON DELETE CASCADE,
    FOREIGN KEY (schedule_id) REFERENCES Schedule (schedule_id)
        ON UPDATE CASCADE 
        ON DELETE CASCADE
);
