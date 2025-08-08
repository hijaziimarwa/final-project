
CREATE DATABASE blog;
USE blog;
CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email  VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) 
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id) 
);

INSERT INTO users (name, email) VALUES
('Marwa ', 'marwa@gmail.com'),
('Jad', 'jad@gmail.com'),
('Sami', 'sami@gmail.com');

INSERT INTO posts (title, content, user_id) VALUES
('Welcome to My Blog', 'This is the first post in my blog. Excited to start!', 1),
('My Second Post', 'Here is some more interesting content.', 1),
('Jad Travel Adventures', 'I love traveling and sharing my stories.', 2),
('Sami Tech Tips', 'Sharing some useful tech tips and tricks.', 3);

INSERT INTO comments (content, post_id, user_id) VALUES
('Great first post, Marwa!', 1, 2),
('Thanks for sharing!', 1, 3),
('Can you share more travel photos?', 3, 1),
('Very helpful tips, thanks Sami!', 4, 2);