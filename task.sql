CREATE TABLE task (
task_code INT(7) NOT NULL AUTO_INCREMENT,
task_name VARCHAR(20) NOT NULL,
task_detail VARCHAR(1000) NOT NULL,
task_color VARCHAR(20),
task_starttime VARCHAR(20),
PRIMARY KEY(task_code)
);