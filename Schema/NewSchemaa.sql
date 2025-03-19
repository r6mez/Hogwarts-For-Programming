create database Hogwarts;

use Hogwarts;
create table user(
id int primary key AUTO_INCREMENT,
Name varchar(30) not null,
email varchar(50) not null ,
password varchar(20) not null,
gender varchar(30) not null,
type ENUM('Student', 'Professor') NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table House(
id int primary key AUTO_INCREMENT,
Name varchar(30) NOT NULL UNIQUE,
points int
);

create table student (
id int primary key,
country varchar(30),
phone varchar(30),
points int ,
house_id int NOT NULL ,
constraint fk_house_stud foreign key student(house_id) references House(id),
constraint fk_stud_user foreign key student(id)  references user(id) ON DELETE CASCADE
);

create table professor (
id int primary key,
experience varchar(30),
user_id int not null ,
constraint fk_prof_user foreign key professor(user_id)  references user(id) ON DELETE CASCADE
);

create table MagicalItem (
id int primary key auto_increment,
price decimal ,
Type varchar(30),
stud_id int ,
constraint fk_student_item foreign key MagicalItem(id) references student(id)
); 

create table wand (
id int primary key auto_increment ,
woodtype varchar(30) ,
coretrpe varchar(30) ,
stud_id int ,
constraint fk_wand_wood foreign key wand(id) references student(id)
);

create table course (
id int primary key auto_increment,
name varchar(50) not null,
id_prof int not null ,
constraint fk_prof_cour foreign key course(id_prof) references professor(id)
);

create table enroll (
id int auto_increment primary key ,
id_stud int not null ,
id_cour int not null ,
constraint fk_enroll_stud  foreign key  enroll(id_stud) references student(id),
constraint fk_enroll_cou   foreign key  enroll(id_cour) references course(id)
);


create table quiz (
id int auto_increment primary key ,
id_cour int not null,
id_prof int not null,
id_stud int not null,
score int ,
constraint fk_quiz_cour foreign key  quiz(id_cour) references course(id),
constraint fk_quiz_prof foreign key  quiz(id_prof) references professor(id),
constraint fk_quiz_stud foreign key  quiz(id_stud) references student(id)
);

create table message (
id  int auto_increment primary key,
sender_id int not null,
resiever_id int not null,
connent varchar(255) not null,
sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
constraint fk_mess_sender foreign key message(sender_id) references user(id),
constraint fk_mess_reciev foreign key message(resiever_id) references user(id) 
);

DELIMITER $$
CREATE TRIGGER before_delete_student 
BEFORE DELETE ON student 
FOR EACH ROW 
BEGIN
    
    DELETE FROM wand WHERE stud_id = OLD.id;

    
    DELETE FROM MagicalItem WHERE stud_id = OLD.id;

    
    DELETE FROM message WHERE sender_id = OLD.id OR resiever_id = OLD.id;

    
    DELETE FROM quiz WHERE id_stud = OLD.id;
END $$
DELIMITER ;

