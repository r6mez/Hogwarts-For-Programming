-- Insert Users (Students and Professors)
INSERT INTO users (name, email, password, type) VALUES
('Harry Potter', 'harry@hogwarts.com', '123456', 'Student'),
('Hermione Granger', 'hermione@hogwarts.com', '123456', 'Student'),
('Ron Weasley', 'ron@hogwarts.com', '123456', 'Student'),
('Draco Malfoy', 'draco@hogwarts.com', '123456', 'Student'),
('Luna Lovegood', 'luna@hogwarts.com', '123456', 'Student'),
('Neville Longbottom', 'neville@hogwarts.com', '123456', 'Student'),
('Albus Dumbledore', 'dumbledore@hogwarts.com', '123456', 'Professor'),
('Severus Snape', 'snape@hogwarts.com', '123456', 'Professor'),
('Minerva McGonagall', 'mcgonagall@hogwarts.com', '123456', 'Professor'),
('Remus Lupin', 'lupin@hogwarts.com', '123456', 'Professor');

-- Insert Houses
INSERT INTO Houses (name) VALUES
('Gryffindor'),
('Slytherin'),
('Ravenclaw'),
('Hufflepuff');

-- Insert Students
INSERT INTO students (id, points, house_id) VALUES
(1, 100, 1),
(2, 120, 2),
(3, 90, 2),
(4, 80, 4),
(5, 110, 3),
(6, 95, 4);

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
(4, 5, 'Let’s meet in the library.'),
(1, 3, 'Are you coming to the Quidditch match?'),
(2, 4, 'Can you help me with Potions?'),
(3, 5, 'Do you have the Herbology notes?'),
(4, 1, 'Let’s practice spells together.'),
(5, 2, 'Did you see the notice board?'),
(1, 4, 'What time is the Astronomy class?'),
(2, 5, 'Can you lend me your wand for a bit?'),
(3, 1, 'Do you want to study together?'),
(4, 2, 'Have you seen my pet toad?'),
(5, 3, 'Let’s meet at the Great Hall.'),
(1, 5, 'Do you know the password to the common room?'),
(2, 1, 'Can you help me with the quiz?'),
(3, 4, 'What’s the homework for Transfiguration?'),
(4, 3, 'Do you want to join the Dueling Club?'),
(5, 1, 'Have you read the Daily Prophet today?'),
(1, 2, 'What’s your favorite spell?'),
(2, 3, 'Can you teach me how to brew a potion?'),
(3, 4, 'Do you want to visit Hogsmeade this weekend?'),
(4, 5, 'Have you seen the new broomstick model?'),
(5, 2, 'What’s your favorite magical creature?'),
(1, 3, 'Do you want to play wizard chess?'),
(2, 4, 'Can you help me with my essay?'),
(3, 5, 'What’s the best way to repel a Boggart?'),
(4, 1, 'Do you want to explore the Forbidden Forest?'),
(5, 2, 'Have you tried the new Butterbeer flavor?'),
(1, 4, 'What’s your favorite class?'),
(2, 5, 'Can you help me with my spell pronunciation?'),
(3, 1, 'Do you want to join the Quidditch team?'),
(4, 2, 'What’s the best way to memorize spells?'),
(5, 3, 'Have you seen the new Defense Against the Dark Arts book?'),
(1, 5, 'Do you want to visit the library together?'),
(2, 1, 'What’s your favorite magical item?'),
(3, 4, 'Can you help me with my wand movements?'),
(4, 3, 'Do you want to attend the Yule Ball?'),
(5, 1, 'What’s your favorite potion?'),
(1, 2, 'Have you seen the Gryffindor common room?'),
(2, 3, 'Do you want to practice dueling?'),
(3, 4, 'What’s the best way to care for a Hippogriff?'),
(4, 5, 'Do you want to join the Herbology Club?'),
(5, 2, 'What’s your favorite magical plant?'),
(1, 3, 'Can you help me with my Charms homework?'),
(2, 4, 'Do you want to visit the Owlery?'),
(3, 5, 'What’s the best way to tame a dragon?'),
(4, 1, 'Do you want to explore the castle together?'),
(5, 2, 'Have you tried the new Chocolate Frog cards?');

-- Insert Questions
INSERT INTO question (answer, body, quiz_id) VALUES
(TRUE, 'What spell repels Dementors?', 1),
(FALSE, 'Is Snape a Death Eater?', 2);