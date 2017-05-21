USE team1;

/*--------- book data -----------*/
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
