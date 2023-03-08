drop schema if exists appli_dblp cascade;
create schema appli_dblp;
set schema 'appli_dblp';

CREATE TABLE _article(
    id_dblp INTEGER PRIMARY KEY,
    type VARCHAR(1000) not null,
    doi VARCHAR(255) not null,
    title VARCHAR(1000) not null,
    venue VARCHAR(100) not null,
    year date not null,
    pages VARCHAR(20) not null,
    ee VARCHAR(1000) not null,
    url_dblp VARCHAR(1000) not null
);

CREATE TABLE _author(
    id_author INTEGER PRIMARY KEY,
    name VARCHAR(255) not null,
    last_name VARCHAR(255) not null
);

CREATE TABLE _written_by(
    id_dblp INTEGER not null,
    id_author INTEGER not null,
    PRIMARY KEY (id_dblp, id_author),
    FOREIGN KEY (id_dblp) REFERENCES _article(id_dblp),
    FOREIGN KEY (id_author) REFERENCES _author(id_author)
);


