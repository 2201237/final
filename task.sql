CREATE TABLE Task (
task_code INT(7) NOT NULL AUTO_INCREMENT,
task_name VARCHAR(20) NOT NULL,
task_detail VARCHAR(1000) NOT NULL,
category_code INT(7),
task_color VARCHAR(20),
task_starttime VARCHAR(20),
PRIMARY KEY(task_code),
FOREIGN KEY (category_code) REFERENCES Category(category_code)
);