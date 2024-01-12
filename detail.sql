CREATE TABLE detail (
task_code INT(7) NOT NULL AUTO_INCREMENT,
task_category VARCHAR(20),
PRIMARY KEY(task_code),
FOREIGN KEY (task_code) REFERENCES task(task_code)
);