
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

