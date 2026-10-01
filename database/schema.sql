CREATE DATABASE IF NOT EXISTS hospital_system CHARACTER SET utf8mb4;
USE hospital_system;

CREATE TABLE appointments (
  appointment_id INT AUTO_INCREMENT PRIMARY KEY,
  appointment_number VARCHAR(15) NOT NULL UNIQUE,
  national_id VARCHAR(10),
  iqama_number VARCHAR(10),
  appointment_time DATETIME NOT NULL,
  clinic_name VARCHAR(100)
);

CREATE TABLE patients (
  patient_id INT AUTO_INCREMENT PRIMARY KEY,
  appointment_number VARCHAR(15) NOT NULL,
  attendance_time DATETIME NOT NULL,
  queue_number INT NOT NULL,
  status VARCHAR(20) DEFAULT \"Attended\",
  clinic_name VARCHAR(100)
);

CREATE TABLE admin (
  admin_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);
-- Create your admin user manually. Never commit real credentials.
