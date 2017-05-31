CREATE TABLE comments
(
  id        INT AUTO_INCREMENT
    PRIMARY KEY,
  user_id   INT                                 NOT NULL,
  post_id   INT                                 NOT NULL,
  text      VARCHAR(255)                        NOT NULL,
  upvotes   INT                                 NOT NULL,
  timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  CONSTRAINT comments_id_uindex
  UNIQUE (id)
);

CREATE TABLE posts
(
  id        INT AUTO_INCREMENT
    PRIMARY KEY,
  user_id   INT                                 NOT NULL,
  title     VARCHAR(255)                        NOT NULL,
  image     VARCHAR(255)                        NOT NULL,
  timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  upvotes   INT                                 NOT NULL,
  comments  INT                                 NOT NULL,
  CONSTRAINT posts_id_uindex
  UNIQUE (id),
  CONSTRAINT posts_timestamp_uindex
  UNIQUE (timestamp)
);

CREATE TABLE users
(
  id        INT AUTO_INCREMENT
    PRIMARY KEY,
  username  VARCHAR(255) NOT NULL,
  password  VARCHAR(255) NOT NULL,
  firstname VARCHAR(255) NOT NULL,
  lastname  VARCHAR(255) NOT NULL,
  token     VARCHAR(255) NULL,
  CONSTRAINT users_id_uindex
  UNIQUE (id),
  CONSTRAINT users_username_uindex
  UNIQUE (username)
);

