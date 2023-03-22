drop schema if exists appli_dblp cascade;
create schema appli_dblp;
set schema 'appli_dblp';

CREATE TABLE _Article(
    id_dblp INTEGER PRIMARY KEY,
    type VARCHAR(1000) not null,
    doi VARCHAR(255) not null,
    title VARCHAR(2000) not null,
    venue VARCHAR(1000) not null,
    year VARCHAR(4) not null,
    pages VARCHAR(20) not null,
    ee VARCHAR(1000) not null,
    url_dblp VARCHAR(1000) not null
);

CREATE TABLE _Conference_article(
    id_dblp INTEGER PRIMARY KEY,
    FOREIGN KEY (id_dblp) REFERENCES _Article(id_dblp)
);

CREATE TABLE _Journal_article(
    id_dblp INTEGER PRIMARY KEY,
    volume VARCHAR(50) not null,
    number_journal VARCHAR(20) not null,
    FOREIGN KEY (id_dblp) REFERENCES _Article(id_dblp)
);

CREATE TABLE _author(
    id_author INTEGER PRIMARY KEY,
    name VARCHAR(255) not null,
    gender VARCHAR(10) not null,
    probability FLOAT
);

CREATE TABLE _written_by(
    id_dblp INTEGER not null,
    id_author INTEGER not null,
    PRIMARY KEY (id_dblp, id_author),
    FOREIGN KEY (id_dblp) REFERENCES _Conference_article(id_dblp),
    FOREIGN KEY (id_dblp) REFERENCES _Journal_article(id_dblp),
    FOREIGN KEY (id_author) REFERENCES _author(id_author)
);



CREATE TABLE _Conference(
    name_conference VARCHAR(255) PRIMARY KEY
);

CREATE TABLE _Year(
    year VARCHAR(4) PRIMARY KEY
);

CREATE TABLE _Conference_Rank(
    name VARCHAR(255) not null,
    year VARCHAR(4) not null,
    rank VARCHAR(2) not null,
    PRIMARY KEY (name, year),
    FOREIGN KEY (name) REFERENCES _Conference(name_conference),
    FOREIGN KEY (year) REFERENCES _Year(year)
);

CREATE TABLE _Conference_Categories(
    name_categorie VARCHAR(255) PRIMARY KEY
);

CREATE TABLE _Conference_Subject_Rank(  
    name_categorie VARCHAR(255) not null,
    name_conference VARCHAR(255) not null,
    year VARCHAR(4) not null,
    rank VARCHAR(2) not null,
    PRIMARY KEY (name_categorie, name_conference, year),
    FOREIGN KEY (name_categorie) REFERENCES _Conference_Categories(name_categorie),
    FOREIGN KEY (name_conference) REFERENCES _Conference(name_conference),
    FOREIGN KEY (year) REFERENCES _Year(year)
);
