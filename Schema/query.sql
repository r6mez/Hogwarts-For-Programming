-- Insert Users (Students and Professors)
INSERT INTO users (name, email, password, type) VALUES
('Harry Potter', 'harry@hogwarts.com', '$2y$12$8SDZVOpTlgjgEXq5SumwG.QVk5JRHXZ7Pj9ozqQiTprAGz5Qic5Ae', 'Student'),
('Hermione Granger', 'hermione@hogwarts.com', '$2y$12$8SDZVOpTlgjgEXq5SumwG.QVk5JRHXZ7Pj9ozqQiTprAGz5Qic5Ae', 'Student'),
('Ron Weasley', 'ron@hogwarts.com', '$2y$12$8SDZVOpTlgjgEXq5SumwG.QVk5JRHXZ7Pj9ozqQiTprAGz5Qic5Ae', 'Student'),
('Draco Malfoy', 'draco@hogwarts.com', '$2y$12$8SDZVOpTlgjgEXq5SumwG.QVk5JRHXZ7Pj9ozqQiTprAGz5Qic5Ae', 'Student'),
('Luna Lovegood', 'luna@hogwarts.com', '$2y$12$8SDZVOpTlgjgEXq5SumwG.QVk5JRHXZ7Pj9ozqQiTprAGz5Qic5Ae', 'Student'),
('Neville Longbottom', 'neville@hogwarts.com', '$2y$12$8SDZVOpTlgjgEXq5SumwG.QVk5JRHXZ7Pj9ozqQiTprAGz5Qic5Ae', 'Student'),
('Albus Dumbledore', 'dumbledore@hogwarts.com', '$2y$12$8SDZVOpTlgjgEXq5SumwG.QVk5JRHXZ7Pj9ozqQiTprAGz5Qic5Ae', 'Professor'),
('Severus Snape', 'snape@hogwarts.com', '$2y$12$8SDZVOpTlgjgEXq5SumwG.QVk5JRHXZ7Pj9ozqQiTprAGz5Qic5Ae', 'Professor'),
('Minerva McGonagall', 'mcgonagall@hogwarts.com', '$2y$12$8SDZVOpTlgjgEXq5SumwG.QVk5JRHXZ7Pj9ozqQiTprAGz5Qic5Ae', 'Professor'),
('Remus Lupin', 'lupin@hogwarts.com', '$2y$12$8SDZVOpTlgjgEXq5SumwG.QVk5JRHXZ7Pj9ozqQiTprAGz5Qic5Ae', 'Professor');

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
(50, 'Invisibility Cloak', null, 'cloak.jpg'),
(30, 'Crystal Ball', null, 'ball.jpg'),
(60, 'Marauder’s Map', null, 'map.jpg'),
(30, 'Potion', NULL, 'potion.jpg'),
(75, 'Flying Broom', NULL, 'broom.jpg'),
(75, 'Spell Book', NULL, 'book.jpg');

-- Insert Wands
INSERT INTO wand (woodtype, coretype, stud_id) VALUES
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
INSERT INTO quiz (id_cour, score) VALUES
(1, 85), (1, 90), (1, 95), -- Quizzes for "Defense Against the Dark Arts"
(2, 80), (2, 85),          -- Quizzes for "Potions"
(3, 88), (3, 92),          -- Quizzes for "Transfiguration"
(4, 75), (4, 80), (4, 85), -- Quizzes for "Herbology"
(5, 78), (5, 82),          -- Quizzes for "Charms"
(6, 70), (6, 75),          -- Quizzes for "Astronomy"
(7, 88), (7, 90),          -- Quizzes for "Divination"
(8, 85), (8, 87),          -- Quizzes for "Arithmancy"
(9, 92), (9, 95),          -- Quizzes for "Care of Magical Creatures"
(10, 80), (10, 85);        -- Quizzes for "History of Magic"

-- Insert Questions
INSERT INTO question (answer, body, quiz_id) VALUES
(TRUE, 'What is the incantation for the Disarming Charm?', 1),
(FALSE, 'Is the Killing Curse reversible?', 1),
(TRUE, 'What does a Patronus charm repel?', 1),
(FALSE, 'Can a Muggle cast a spell?', 1),

(TRUE, 'What is the main ingredient in Polyjuice Potion?', 2),
(FALSE, 'Is Felix Felicis a love potion?', 2),
(TRUE, 'What is the antidote for most poisons?', 2),
(FALSE, 'Can a potion be brewed without a wand?', 2),

(TRUE, 'What is the spell to transform an object into a goblet?', 3),
(FALSE, 'Can Transfiguration be used on humans?', 3),
(TRUE, 'What is the Gamp’s Law of Elemental Transfiguration?', 3),
(FALSE, 'Is Transfiguration permanent?', 3),

(TRUE, 'What plant is used to cure petrification?', 4),
(FALSE, 'Is Devil’s Snare harmless in the dark?', 4),
(TRUE, 'What is the effect of Mandrake root?', 4),
(FALSE, 'Can a Mandrake kill a wizard?', 4),

(TRUE, 'What is the incantation for the Levitation Charm?', 5),
(FALSE, 'Can the Summoning Charm summon living beings?', 5),
(TRUE, 'What is the effect of the Silencing Charm?', 5),
(FALSE, 'Is the Shield Charm offensive?', 5),

(TRUE, 'What is the brightest star in the night sky?', 6),
(FALSE, 'Is the moon a planet?', 6),
(TRUE, 'What is the name of the North Star?', 6),
(FALSE, 'Can constellations change over time?', 6),

(TRUE, 'What is the purpose of a crystal ball?', 7),
(FALSE, 'Can Divination predict the future with certainty?', 7),
(TRUE, 'What is the significance of tea leaves in Divination?', 7),
(FALSE, 'Is palmistry a form of Divination?', 7),

(TRUE, 'What is the magical number in Arithmancy?', 8),
(FALSE, 'Is Arithmancy related to Astronomy?', 8),
(TRUE, 'What is the significance of the number seven?', 8),
(FALSE, 'Can Arithmancy predict the future?', 8),

(TRUE, 'What is the diet of a Hippogriff?', 9),
(FALSE, 'Can a dragon be tamed?', 9),
(TRUE, 'What is the habitat of a Niffler?', 9),
(FALSE, 'Is a Phoenix immortal?', 9),

(TRUE, 'What is the name of the first wizarding school?', 10),
(FALSE, 'Is the Goblin Rebellion still ongoing?', 10),
(TRUE, 'What is the significance of the Statute of Secrecy?', 10),
(FALSE, 'Can Muggles see Hogwarts?', 10);

-- Insert Messages
INSERT INTO message (sender_id, resiever_id, connent, isread) VALUES
(1, 2, 'Hello, how are you?', TRUE),
(2, 1, 'I am fine, thank you!', FALSE),
(3, 4, 'Did you complete the assignment?', TRUE),
(4, 3, 'Yes, I did. What about you?', FALSE),
(5, 6, 'Let\'s meet in the library.', TRUE),
(6, 5, 'Sure, see you there!', FALSE),
(7, 8, 'Can you help me with Potions?', TRUE),
(8, 7, 'Of course, let\'s discuss it tomorrow.', FALSE),
(9, 10, 'Great job in the last class!', TRUE),
(10, 9, 'Thank you, Professor!', FALSE),
(1, 3, 'Are you coming to the Quidditch match?', TRUE),
(3, 1, 'Yes, I wouldn\'t miss it!', FALSE),
(2, 4, 'Can you lend me your notes?', TRUE),
(4, 2, 'Sure, I\'ll bring them tomorrow.', FALSE),
(5, 7, 'What time is the Herbology class?', TRUE),
(7, 5, 'It\'s at 10 AM.', FALSE),
(6, 8, 'Do you have the Transfiguration book?', TRUE),
(8, 6, 'Yes, I can lend it to you.', FALSE),
(9, 1, 'Don\'t forget about the quiz.', TRUE),
(1, 9, 'Thanks for the reminder!', FALSE),
(2, 5, 'Can we study together?', TRUE),
(5, 2, 'Sure, let\'s meet in the common room.', FALSE),
(3, 6, 'Did you understand the last lecture?', TRUE),
(6, 3, 'Not really, can you explain it to me?', FALSE),
(4, 7, 'What\'s the homework for Charms?', TRUE),
(7, 4, 'We need to practice the Levitation spell.', FALSE),
(8, 10, 'Can you review my essay?', TRUE),
(10, 8, 'Yes, I\'ll do it tonight.', FALSE),
(9, 2, 'Are you ready for the exam?', TRUE),
(2, 9, 'Almost, just need to revise a bit more.', FALSE),
(1, 4, 'Let\'s form a study group.', TRUE),
(4, 1, 'Good idea, let\'s invite others too.', FALSE),
(3, 5, 'Do you have a spare quill?', TRUE),
(5, 3, 'Yes, I\'ll bring it to class.', FALSE),
(6, 7, 'What\'s your favorite spell?', TRUE),
(7, 6, 'I love the Patronus charm.', FALSE),
(8, 9, 'Can you teach me that spell?', TRUE),
(9, 8, 'Sure, it\'s not that hard.', FALSE),
(10, 1, 'Did you hear about the new professor?', TRUE),
(1, 10, 'Yes, everyone is talking about it.', FALSE),
(2, 3, 'What\'s your favorite subject?', TRUE),
(3, 2, 'I love Defense Against the Dark Arts.', FALSE),
(4, 5, 'Can you help me with the potion recipe?', TRUE),
(5, 4, 'Yes, let\'s work on it together.', FALSE),
(6, 8, 'Do you want to join the Quidditch team?', TRUE),
(8, 6, 'I\'m thinking about it.', FALSE),
(7, 9, 'What\'s the next topic in Astronomy?', TRUE),
(9, 7, 'We\'ll be studying constellations.', FALSE),
(10, 2, 'Can you lend me your wand for practice?', TRUE),
(2, 10, 'Sorry, I can\'t. It\'s too personal.', FALSE);