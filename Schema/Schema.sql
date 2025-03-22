create database Hogwarts;

use Hogwarts;
create table users(
id int primary key AUTO_INCREMENT,
name varchar(255) ,
email varchar(255)  ,
password varchar(255) ,

type ENUM('Student', 'Professor') ,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table Houses(
id int primary key AUTO_INCREMENT,
name varchar(255)  UNIQUE,
points int
);

create table students (
id int primary key,
points int ,
house_id int  ,
constraint fk_house_stud foreign key students(house_id) references Houses(id),
constraint fk_stud_user foreign key students(id)  references users(id) ON DELETE CASCADE
);

create table professors (
id int  primary key,
experience varchar(255),

constraint fk_prof_user foreign key professors(id)  references users(id) ON DELETE CASCADE
);

create table MagicalItem (
id int primary key auto_increment,
price decimal ,
Type varchar(255),
stud_id int,
imag varchar(255),
constraint fk_student_item foreign key MagicalItem(stud_id) references students(id)
); 

create table wand (
id int primary key auto_increment ,
woodtype varchar(255) ,
coretrpe varchar(255) ,
stud_id int ,
constraint fk_wand_wood foreign key wand(id) references students(id)
);

create table course (
id int primary key auto_increment,
name varchar(255) ,
id_prof int,
constraint fk_prof_cour foreign key course(id_prof) references professors(id)
);

create table enroll (
id int auto_increment primary key ,
id_stud int  ,
id_cour int  ,
constraint fk_enroll_stud  foreign key  enroll(id_stud) references students(id),
constraint fk_enroll_cou   foreign key  enroll(id_cour) references course(id)
);


create table quiz (
id int auto_increment primary key ,
id_cour int ,
id_prof int ,
id_stud int ,
score int ,
constraint fk_quiz_cour foreign key  quiz(id_cour) references course(id),
constraint fk_quiz_prof foreign key  quiz(id_prof) references professors(id),
constraint fk_quiz_stud foreign key  quiz(id_stud) references students(id)
);

create table message (
id  int auto_increment primary key,
sender_id int ,
resiever_id int ,
connent varchar(255) ,
sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
constraint fk_mess_sender foreign key message(sender_id) references users(id),
constraint fk_mess_reciev foreign key message(resiever_id) references users(id) 
);

create table question (
id int auto_increment primary key ,
answer bool ,
body varchar(255),
quiz_id int ,
constraint fk_ques_quiz foreign key question(quiz_id) references quiz(id) 
);

DELIMITER $$
CREATE TRIGGER before_delete_student 
BEFORE DELETE ON students 
FOR EACH ROW 
BEGIN
    
    DELETE FROM wand WHERE stud_id = OLD.id;

    
    DELETE FROM MagicalItem WHERE stud_id = OLD.id;

    
    DELETE FROM message WHERE sender_id = OLD.id OR resiever_id = OLD.id;

    
    DELETE FROM quiz WHERE id_stud = OLD.id;
END $$
DELIMITER ;
