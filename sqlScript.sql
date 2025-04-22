-- Create the database
CREATE DATABASE personal_info;

-- Use the database
USE personal_info;

-- Table for personal information
CREATE TABLE personal_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    country VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL
);

-- Table for experience
CREATE TABLE experience (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_title VARCHAR(100) NOT NULL,
    company VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL
);

-- Table for education
CREATE TABLE education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    institute_name VARCHAR(100) NOT NULL,
    school_location VARCHAR(100) NOT NULL,
    degree VARCHAR(50) NOT NULL,
    field_of_study VARCHAR(100) NOT NULL,
    graduation_date DATE,
    still_enrolled BOOLEAN DEFAULT 0,
    year INT NOT NULL
);

-- Table for skills
CREATE TABLE skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(100) NOT NULL
);

-- Table for summary
CREATE TABLE summary (
    id INT AUTO_INCREMENT PRIMARY KEY,
    summary_text TEXT NOT NULL
);

-- Table for additional details
CREATE TABLE additional_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    certifications TEXT,
    languages TEXT,
    hobbies TEXT,
    other_details TEXT
);