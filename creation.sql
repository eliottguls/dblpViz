DROP SCHEMA if exists appli_dblp CASCADE;
CREATE SCHEMA appli_dblp;
SET SCHEMA 'appli_dblp';
CREATE TABLE _article
(
  id_dblp    INTEGER PRIMARY KEY,
  type       VARCHAR(1000) NOT NULL,
  doi        VARCHAR(255) NOT NULL,
  title      VARCHAR(1000) NOT NULL,
  venue      VARCHAR(100) NOT NULL,
  year       INTEGER NOT NULL,
  pages      VARCHAR(20) NOT NULL,
  ee         VARCHAR(1000) NOT NULL,
  url_dblp   VARCHAR(1000) NOT NULL
);
CREATE TABLE _author
(
  id_author   SERIAL PRIMARY KEY,
  name        VARCHAR(255) NOT NULL
);
CREATE TABLE _written_by
(
  id_dblp     INTEGER NOT NULL,
  id_author   INTEGER NOT NULL,
  PRIMARY KEY (id_dblp,id_author),
  FOREIGN KEY (id_dblp) REFERENCES _article (id_dblp),
  FOREIGN KEY (id_author) REFERENCES _author (id_author)
);
CREATE TABLE _rank
(
  id_article   INT PRIMARY KEY,
  rank         VARCHAR(255),
  categorie    VARCHAR(255),
  FOREIGN KEY (id_article) REFERENCES _article(id_dblp)
);


