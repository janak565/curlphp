CREATE TABLE `curlphp`.`employee` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `emp_name` VARCHAR(100) NOT NULL , `emp_email` VARCHAR(100) NOT NULL , `emp_mobile_number` VARCHAR(12) NOT NULL , `emp_profile_image` TEXT NOT NULL , `emp_gender` ENUM('M','F') NOT NULL DEFAULT 'M'  COMMENT 'M=Male, F = Female', `emp_country_id` INT(11) NOT NULL, `emp_state_id` INT(11) NOT NULL , `emp_city_name` VARCHAR(50) NOT NULL , `emp_reporting_manager` INT(11) NOT NULL COMMENT 'reporting manager is emp id' , `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_date` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`) ENGINE = InnoDB;



ALTER TABLE emp_subject_relation
ADD FOREIGN KEY (emp_id) REFERENCES employee(id);


ALTER TABLE employee
ADD FOREIGN KEY (emp_state_id ) REFERENCES state(id);

ALTER TABLE employee
ADD FOREIGN KEY (emp_reporting_manager) REFERENCES employee(id); 




Select e.*, s.name,


select e.id,e.emp_name,group_concr	 from employee e, subject s inner join emp_subject_relation es ON es.id=es.emp.id 

select e.id,e.emp_name,s.name ,GROUP_CONCAT(CONCAT(s.id,":::",s.name)),count(id) as subjects from employee e inner join emp_subject_relation es ON e.id=es.emp_id inner join subjects s ON s.id=es.subject_id group by e.id 


select e.id,e.emp_name,s.name, ed.emp_name, GROUP_CONCAT(s.name) as SubjectNames from employee e inner join emp_subject_relation es ON e.id=es.emp_id inner join subjects s ON s.id=es.subject_id Left JOIN employee ed ON e.id=ed.emp_reporting_manager group by e.id
