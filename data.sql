/*--------- users -----------*/
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INTEGER(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(256) NOT NULL,
    password VARCHAR(256) NOT NULL
);

INSERT INTO users(username, password) VALUES 
('admin', '$2y$10$m7rUJj.09l/FakHctFWnUOmd97DHisP2WnZsK8KGWxePu1em7hcby'), -- 'AdminPassword'
('alice', '$2y$10$4Spv8p0LuUHBeU.49.6fXu3hIRB/YTnqY0nca35pVi0FuG7GSczEe'), -- 'pass1234'
('bob', '$2y$10$tugW1SrXDF4lIDIzV.7/zesjzLMgz.cOzUHPTZbDfoDUsBzvoY.sm');   -- 'pass1234'

/*--------- posts -----------*/
DROP TABLE IF EXISTS posts;

CREATE TABLE posts (
    id INTEGER(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    owner VARCHAR(256) NOT NULL,
    title VARCHAR(256) NOT NULL,
    message TEXT NOT NULL,
    created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP 
);

INSERT INTO posts(owner, title, message, created_date) VALUES 
('admin', 'Welcome', 'Welcome to OWASP Thailand Workshop 2', '2017-05-01 01:23:45'),
('alice', 'Test', 'Alice Test', '2017-05-12 03:45:11'),
('bob', 'Hi', 'Hello World!', '2017-05-20 09:09:09');

/*--------- messages -----------*/
DROP TABLE IF EXISTS messages;

CREATE TABLE messages (
    id INTEGER(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sender   VARCHAR(256) NOT NULL,
    receiver VARCHAR(256) NOT NULL,
    message  TEXT NOT NULL,
    created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP 
);

INSERT INTO messages(sender, receiver, message, created_date) VALUES 
('alice', 'admin', 'How to post a message?', '2017-05-02 12:34:56'),
('alice', 'admin', 'Got it!', '2017-05-02 12:55:55');

