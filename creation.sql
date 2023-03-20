DROP SCHEMA if exists appli_dblp CASCADE;
CREATE SCHEMA appli_dblp;
SET SCHEMA 'appli_dblp';
CREATE TABLE _article 
(
  id_dblp    INTEGER PRIMARY KEY,
  TYPE VARCHAR(1000),
  doi        VARCHAR(255),
  title      VARCHAR(1000),
  venue      VARCHAR(100),
  year       INTEGER,
  pages      VARCHAR(20),
  ee         VARCHAR(1000),
  url_dblp   VARCHAR(1000)
);
CREATE TABLE _author 
(
  name        VARCHAR(255) PRIMARY KEY,
  id_author   SERIAL,
  affilliation VARCHAR(1000)
);
CREATE TABLE _written_by 
(
  id_dblp     INTEGER NOT NULL,
  id_author   INTEGER NOT NULL,
  PRIMARY KEY (id_dblp,id_author),
  FOREIGN KEY (id_dblp) REFERENCES _article (id_dblp),
  FOREIGN KEY (id_author) REFERENCES _rank (id_author)
);
CREATE TABLE _rank_article
(
  id_article   INT PRIMARY KEY,
  rank         VARCHAR(255),
  categorie    VARCHAR(255),
  FOREIGN KEY (id_article) REFERENCES _article (id_dblp)
);
