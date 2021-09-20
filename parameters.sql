CREATE TABLE configurations (
  configuration_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title         VARCHAR(121) NOT NULL,
  copyright         VARCHAR(121) NOT NULL,
  author         VARCHAR(121) NOT NULL,
  description   longtext     NOT NULL,
  keywords    longtext     NOT NULL,
  preferences    longtext     NOT NULL,
  history      longtext     NOT NULL,
  date         TIMESTAMP        DEFAULT CURRENT_TIMESTAMP
)  ENGINE = innodb;


CREATE TABLE users (
  user_id    INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name_first VARCHAR(121) NOT NULL,
  name_last  VARCHAR(121) NOT NULL,
  date_birth DATE         NOT NULL,
  email      VARCHAR(121) NOT NULL,
  password   VARCHAR(121) NOT NULL,
  history    longtext     NOT NULL,
  date       TIMESTAMP        DEFAULT CURRENT_TIMESTAMP
)
  ENGINE = innodb;

CREATE TABLE situations (
  situation_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name         VARCHAR(121) NOT NULL,
  description  VARCHAR(121) NOT NULL,
  history      longtext     NOT NULL,
  date         TIMESTAMP        DEFAULT CURRENT_TIMESTAMP
)
  ENGINE = innodb;

CREATE TABLE highlighters (
  highlighter_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name           VARCHAR(121) NOT NULL,
  description    VARCHAR(121) NOT NULL,
  history        longtext     NOT NULL,
  date           TIMESTAMP        DEFAULT CURRENT_TIMESTAMP
)
  ENGINE = innodb;

CREATE TABLE content_categories (
  content_category_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  situation_id        INT UNSIGNED,
  user_id             INT UNSIGNED,
  name                VARCHAR(121) NOT NULL,
  description         VARCHAR(121) NOT NULL,
  history             longtext     NOT NULL,
  date                TIMESTAMP        DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (situation_id) REFERENCES situations (situation_id),
  FOREIGN KEY (user_id) REFERENCES users (user_id)
)
  ENGINE = innodb;

CREATE TABLE contents (
  content_id          INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  content_category_id INT(11) UNSIGNED,
  highlighter_id      INT(11) UNSIGNED,
  situation_id        INT(11) UNSIGNED,
  user_id             INT(11) UNSIGNED,
  position_content    INT(11) UNSIGNED,
  position_menu       INT(11) UNSIGNED,
  url                 LONGTEXT,
  title               VARCHAR(121) NOT NULL,
  title_menu          VARCHAR(121) NOT NULL,
  description         VARCHAR(121) NOT NULL,
  content_resume      VARCHAR(321) NOT NULL,
  content_complete    LONGTEXT,
  keywords    LONGTEXT,
  date_start          VARCHAR(121),
  date_closing        VARCHAR(121),
  history             longtext     NOT NULL,
  date                TIMESTAMP        DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (situation_id) REFERENCES situations (situation_id),
  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (content_category_id) REFERENCES content_categories (content_category_id),
  FOREIGN KEY (highlighter_id) REFERENCES highlighters (highlighter_id)
)
  ENGINE = innodb;

CREATE TABLE contents_files (
  content_file_id  INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  content_id       INT(11) UNSIGNED,
  highlighter_id   INT(11) UNSIGNED,
  situation_id     INT(11) UNSIGNED,
  user_id          INT(11) UNSIGNED,
  position_content INT(11) UNSIGNED,
  name             VARCHAR(121) NOT NULL,
  path             VARCHAR(121) NOT NULL,
  date             TIMESTAMP        DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (situation_id) REFERENCES situations (situation_id),
  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (content_id) REFERENCES contents (content_id) ON DELETE CASCADE,
  FOREIGN KEY (highlighter_id) REFERENCES highlighters (highlighter_id)
)
  ENGINE = innodb;

CREATE TABLE contents_subs (
  content_sub_id   INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  content_id       INT(11) UNSIGNED,
  highlighter_id   INT(11) UNSIGNED,
  situation_id     INT(11) UNSIGNED,
  user_id          INT(11) UNSIGNED,
  position_content INT(11) UNSIGNED,
  position_menu    INT(11) UNSIGNED,
  url              LONGTEXT,
  title            VARCHAR(121) NOT NULL,
  title_menu       VARCHAR(121) NOT NULL,
  description      VARCHAR(121) NOT NULL,
  content_resume   VARCHAR(321) NOT NULL,
  content_complete LONGTEXT,
  keywords    LONGTEXT,
  date_start       VARCHAR(121),
  date_closing     VARCHAR(121),
  history          longtext     NOT NULL,
  date             TIMESTAMP        DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (situation_id) REFERENCES situations (situation_id),
  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (content_id) REFERENCES contents (content_id)
    ON DELETE CASCADE,
  FOREIGN KEY (highlighter_id) REFERENCES highlighters (highlighter_id)
)
  ENGINE = innodb;

CREATE TABLE contents_subs_files (
  content_sub_file_id  INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  content_sub_id   INT(11) UNSIGNED,
  highlighter_id   INT(11) UNSIGNED,
  situation_id     INT(11) UNSIGNED,
  user_id          INT(11) UNSIGNED,
  position_content INT(11) UNSIGNED,
  name             VARCHAR(121) NOT NULL,
  path             VARCHAR(121) NOT NULL,
  date             TIMESTAMP        DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (situation_id) REFERENCES situations (situation_id),
  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (content_sub_id) REFERENCES contents_subs (content_sub_id) ON DELETE CASCADE,
  FOREIGN KEY (highlighter_id) REFERENCES highlighters (highlighter_id)
)
  ENGINE = innodb;