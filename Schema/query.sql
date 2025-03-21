use hogwarts;

INSERT INTO houses (name) VALUES
('Gryffindor'),
('Hufflepuff'),
('Ravenclaw'),
('Slytherin');

ALTER TABLE professors DROP FOREIGN KEY fk_prof_user;

ALTER TABLE professors 
ADD CONSTRAINT fk_prof_user 
FOREIGN KEY (id) REFERENCES users(id) 
ON DELETE CASCADE;

ALTER TABLE professors
drop user_id;