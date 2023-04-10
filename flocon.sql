drop schema if exists appli_dblp_flocon cascade;
create schema appli_dblp_flocon;
set schema 'appli_dblp_flocon';


-- Création des tables dimensionnelles

CREATE TABLE _author_dim (
    author_id SERIAL PRIMARY KEY,
    name VARCHAR(1000) NOT NULL,
    gender VARCHAR(10),
    probability FLOAT
);

CREATE TABLE _conference_dim (
    conference_id SERIAL PRIMARY KEY,
    name_conference VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE _year_dim (
    year_id SERIAL PRIMARY KEY,
    year VARCHAR(4) NOT NULL
);

CREATE TABLE _conference_rank_dim (
    conference_rank_id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    year_id INTEGER NOT NULL,
    rank VARCHAR(2) NOT NULL,
    CONSTRAINT fk_conference_rank_year FOREIGN KEY (year_id) REFERENCES _year_dim (year_id),
    CONSTRAINT fk_conference_rank_conference FOREIGN KEY (name) REFERENCES _conference_dim (name_conference)
);

CREATE TABLE _conference_categories_dim (
    conference_category_id SERIAL PRIMARY KEY,
    name_categorie VARCHAR(255) NOT NULL
);

CREATE TABLE _conference_subject_rank_dim (
    conference_subject_rank_id SERIAL PRIMARY KEY,
    name_categorie_id INTEGER NOT NULL,
    name_conference_id INTEGER NOT NULL,
    year_id INTEGER NOT NULL,
    rank VARCHAR(2) NOT NULL,
    CONSTRAINT fk_conference_subject_rank_category FOREIGN KEY (name_categorie_id) REFERENCES _conference_categories_dim (conference_category_id),
    CONSTRAINT fk_conference_subject_rank_conference FOREIGN KEY (name_conference_id) REFERENCES _conference_dim (conference_id),
    CONSTRAINT fk_conference_subject_rank_year FOREIGN KEY (year_id) REFERENCES _year_dim (year_id)
);

-- Création de la table de faits

CREATE TABLE _article_fact (
    article_id SERIAL PRIMARY KEY,
    id_dblp INTEGER NOT NULL,
    type VARCHAR(1000) NOT NULL,
    doi VARCHAR(255) NOT NULL UNIQUE,
    title VARCHAR(2000) NOT NULL,
    venue VARCHAR(1000) NOT NULL,
    year_id INTEGER NOT NULL,
    pages VARCHAR(20) NOT NULL,
    ee VARCHAR(1000) NOT NULL,
    url_dblp VARCHAR(1000) NOT NULL,
    conference_id INTEGER,
    journal_volume VARCHAR(500),
    journal_number VARCHAR(20),
    CONSTRAINT fk_article_year FOREIGN KEY (year_id) REFERENCES _year_dim (year_id),
    CONSTRAINT fk_article_conference FOREIGN KEY (conference_id) REFERENCES _conference_dim (conference_id)
);

CREATE TABLE _written_by_fact (
    article_id INTEGER NOT NULL,
    author_id INTEGER NOT NULL,
    pos INTEGER NOT NULL,
    CONSTRAINT fk_written_by_article FOREIGN KEY (article_id) REFERENCES _article_fact (article_id),
    CONSTRAINT fk_written_by_author FOREIGN KEY (author_id) REFERENCES _author_dim (author_id)
);

CREATE TABLE _cited_by_fact (
    article_id INTEGER NOT NULL,
    cited_by_doi VARCHAR(255) NOT NULL,
    cited_by_title VARCHAR(2000) NOT NULL,
    cited_by_year VARCHAR(10),
    cited_by_journal_title VARCHAR(255),
    CONSTRAINT fk_cited_by_article FOREIGN KEY (article_id) REFERENCES _article_fact (article_id),
    CONSTRAINT fk_cited_by_article_cited_doi FOREIGN KEY (cited_by_doi) REFERENCES _article_fact (doi)
);
