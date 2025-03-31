CREATE TABLE Equipments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    serial_number VARCHAR(255) NOT NULL,
    type ENUM('Tensão', 'Corrente', 'Óleo') NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Alarms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL,
    classification ENUM('Urgente', 'Emergente', 'Ordinário') NOT NULL,
    equipment_id INT,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (equipment_id) REFERENCES Equipments(id)
);

CREATE TABLE ActuatedAlarms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alarm_id INT,
    entry_date DATETIME,
    exit_date DATETIME,
    status ENUM('on', 'off') NOT NULL,
    FOREIGN KEY (alarm_id) REFERENCES Alarms(id)
);

CREATE TABLE SystemActions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    action_description TEXT
);

