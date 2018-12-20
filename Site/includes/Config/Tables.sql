-- Query for Posts Table.
CREATE TABLE posts(
    p_id int (255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    p_date DATE NOT NULL,
    p_content TEXT NOT NULL,
    p_author int (255) NOT NULL,
    FOREIGN KEY (p_author) REFERENCES users(u_id)
);

-- Query for Users Table

CREATE TABLE users(
    u_id int (255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar (255) NOT NULL,
    password varchar (255) NOT NULL,
    status varchar (255),
    location varchar (255) NOT NULL,
    profile_image TEXT
);

-- SQL For Posts-User Relationship

CREATE TABLE post_user(
    p_id int (255) NOT NULL,
    u_id int (255) NOT NULL,
    p_status varchar (255) NOT NULL,
    FOREIGN KEY (p_id) REFERENCES posts(p_id),
    FOREIGN KEY (u_id) REFERENCES users(u_id)
);

-- SQL FOR Requests TABLE

CREATE TABLE requests(
    req_from int (255) NOT NULL,
    req_to int (255) NOT NULL,
    req_id int (255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    FOREIGN KEY (req_from) REFERENCES users(u_id),
    FOREIGN KEY (req_to) REFERENCES users(u_id)
);

-- SQL FOR FRIENDSHIP Table

CREATE TABLE friendship(
    u_id int (255) NOT NULL,
    f_id int (255) NOT NULL,
    FOREIGN KEY (u_id) REFERENCES users(u_id),
    FOREIGN KEY (f_id) REFERENCES users(u_id)
);
