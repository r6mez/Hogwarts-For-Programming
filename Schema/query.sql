-- Insert Users (Students and Professors)
INSERT INTO users (name, email, password, type) VALUES
('Harry Potter', 'harry@hogwarts.com', 'gryffindor123', 'Student'),
('Hermione Granger', 'hermione@hogwarts.com', 'leviosa456', 'Student'),
('Ron Weasley', 'ron@hogwarts.com', 'scabbers789', 'Student'),
('Draco Malfoy', 'draco@hogwarts.com', 'slytherin666', 'Student'),
('Luna Lovegood', 'luna@hogwarts.com', 'ravenclaw999', 'Student'),
('Neville Longbottom', 'neville@hogwarts.com', 'herbology101', 'Student'),
('Albus Dumbledore', 'dumbledore@hogwarts.com', 'phoenix123', 'Professor'),
('Severus Snape', 'snape@hogwarts.com', 'potions456', 'Professor'),
('Minerva McGonagall', 'mcgonagall@hogwarts.com', 'transfig789', 'Professor'),
('Remus Lupin', 'lupin@hogwarts.com', 'moony555', 'Professor');

-- Insert Houses
INSERT INTO Houses (name, points) VALUES
('Gryffindor', 500),
('Slytherin', 450),
('Ravenclaw', 480),
('Hufflepuff', 470);

-- Insert Students
INSERT INTO students (id, points, house_id) VALUES
(1, 100, 1),
(2, 120, 1),
(3, 90, 1),
(4, 80, 2),
(5, 110, 3),
(6, 95, 1);

-- Insert Professors
INSERT INTO professors (id, experience) VALUES
(7, '50 years of teaching'),
(8, '30 years of Potions'),
(9, '40 years of Transfiguration'),
(10, '20 years of Defense Against the Dark Arts');

-- Insert Magical Items

INSERT INTO MagicalItem (price, Type, stud_id, imag) VALUES
(50, 'Invisibility Cloak', null, 'cloak.png'),
(30, 'Crystal Ball', null, 'ball.png'),
(60, 'Marauder’s Map', null, 'map.png'),
(30, 'Potion', NULL, 'potion.png'),
(75, 'Flying Broom', NULL, 'broom.png'),
(75, 'Spell Book', NULL, 'book.png');

-- Insert Wands
INSERT INTO wand (woodtype, coretrpe, stud_id) VALUES
('Holly', 'Phoenix Feather', 1),
('Vine', 'Dragon Heartstring', 2),
('Willow', 'Unicorn Hair', 3),
('Hawthorn', 'Dragon Heartstring', 4),
('Cherry', 'Unicorn Hair', 5);

-- Insert Courses
INSERT INTO course (name, id_prof) VALUES
('Defense Against the Dark Arts', 10),
('Potions', 8),
('Transfiguration', 9),
('Herbology', 7),
('Charms', 9),
('Astronomy', 7),
('Divination', 9),
('Arithmancy', 8),
('Care of Magical Creatures', 10),
('History of Magic', 7);

-- Insert Enrollments
INSERT INTO enroll (id_stud, id_cour) VALUES
(1, 1), (2, 1), (3, 2), (4, 2), (5, 3);

-- Insert Quizzes
INSERT INTO quiz (id_cour, id_prof, id_stud, score) VALUES
(1, 10, 1, 90), (2, 8, 2, 85), (3, 9, 3, 88);

-- Insert Messages
INSERT INTO message (sender_id, resiever_id, connent) VALUES
(1, 2, 'Did you finish the homework?'),
(2, 3, 'Yes, just reviewing now.'),
(4, 5, 'Let’s meet in the library.');

-- Insert Questions
INSERT INTO question (answer, body, quiz_id) VALUES
(TRUE, 'What spell repels Dementors?', 1),
(FALSE, 'Is Snape a Death Eater?', 2);