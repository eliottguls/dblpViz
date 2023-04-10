DROP SCHEMA IF EXISTS appli_dblp_etoile CASCADE;
CREATE SCHEMA appli_dblp_etoile;
SET search_path = 'appli_dblp_etoile';



CREATE TABLE dim_article_type (
  id_type SERIAL PRIMARY KEY,
  type VARCHAR(1000) NOT NULL
);

CREATE TABLE dim_pages (
  pages_id SERIAL PRIMARY KEY,
  pages VARCHAR(20)
);

CREATE TABLE dim_ee (
  ee_id SERIAL PRIMARY KEY,
  ee VARCHAR(1000)
);

CREATE TABLE dim_url_dblp (
  url_dblp_id SERIAL PRIMARY KEY,
  url_dblp VARCHAR(1000)
);

CREATE TABLE dim_conference_rank (
  rank_id SERIAL PRIMARY KEY,
  rank VARCHAR(100)
);

CREATE TABLE dim_conference_categorie (
    name_categorie VARCHAR(1000) PRIMARY KEY
);

CREATE TABLE dim_author (
    author_id SERIAL PRIMARY KEY,
    name VARCHAR(1000),
    gender VARCHAR(10),
    probability FLOAT
);

CREATE TABLE dim_conference (
    venue_id SERIAL PRIMARY KEY,
    name_conference VARCHAR(1000) UNIQUE
);



CREATE TABLE dim_year (
    year_id SERIAL PRIMARY KEY,
    year VARCHAR(4) 
);

CREATE TABLE dim_doi(
    doi_id SERIAL PRIMARY KEY,
    doi VARCHAR(1000)
);

CREATE TABLE dim_id_dblp(
  id_id_dblp SERIAL PRIMARY KEY,
  id_dblp INTEGER
);

CREATE TABLE dim_cited_doi (
    cited_doi_id SERIAL PRIMARY KEY,
    cited_doi VARCHAR(1000) NOT NULL
);

CREATE TABLE dim_journal_title (
    journal_title_id SERIAL PRIMARY KEY,
    journal_title VARCHAR(2000) NOT NULL
);

CREATE TABLE dim_year_cited (
    year_cited_id SERIAL PRIMARY KEY,
    year_cited VARCHAR(10) NOT NULL
);
  

CREATE TABLE fact_article (
    id_article SERIAL NOT NULL PRIMARY KEY,
    id_dblp INTEGER NOT NULL,
    doi_id INTEGER NOT NULL,
    type_id INTEGER NOT NULL,
    venue_id INTEGER NOT NULL,
    year_id INTEGER NOT NULL,
    pages_id INTEGER NOT NULL,
    ee_id INTEGER NOT NULL,
    url_dblp_id INTEGER NOT NULL,
    FOREIGN KEY (type_id) REFERENCES dim_article_type(id_type),
    FOREIGN KEY (id_dblp) REFERENCES dim_id_dblp(id_id_dblp),
    FOREIGN KEY (doi_id) REFERENCES dim_doi(doi_id),
    FOREIGN KEY (venue_id) REFERENCES dim_conference(venue_id),
    FOREIGN KEY (year_id) REFERENCES dim_year(year_id),
    FOREIGN KEY (pages_id) REFERENCES dim_pages(pages_id),
    FOREIGN KEY (ee_id) REFERENCES dim_ee(ee_id),
    FOREIGN KEY (url_dblp_id) REFERENCES dim_url_dblp(url_dblp_id)
);

CREATE TABLE fact_article_author (
    id_written_by SERIAL PRIMARY KEY,
    id_article INTEGER NOT NULL,
    name_id INTEGER NOT NULL,
    pos INTEGER NOT NULL,
    FOREIGN KEY (id_article) REFERENCES fact_article(id_article),
    FOREIGN KEY (name_id) REFERENCES dim_author(author_id)
);

CREATE TABLE fact_article_conference (
    id_article INTEGER NOT NULL,
    conference_id INTEGER NOT NULL,
    PRIMARY KEY (id_article, conference_id),
    FOREIGN KEY (id_article) REFERENCES fact_article(id_article),
    FOREIGN KEY (conference_id) REFERENCES dim_conference(venue_id)
);

CREATE TABLE fact_article_journal (
    id_article INTEGER NOT NULL,
    volume_id INTEGER NOT NULL,
    number_journal_id INTEGER NOT NULL,
    PRIMARY KEY (id_article),
    FOREIGN KEY (id_article) REFERENCES fact_article(id_article)
);

CREATE TABLE fact_article_year (
    id_article INTEGER NOT NULL,
    year_id INTEGER NOT NULL,
    PRIMARY KEY (id_article),
    FOREIGN KEY (id_article) REFERENCES fact_article(id_article),
    FOREIGN KEY (year_id) REFERENCES dim_year(year_id)
);

CREATE TABLE fact_conference_rank (
    conference_id INTEGER NOT NULL,
    year_id INTEGER NOT NULL,
    rank_id INTEGER NOT NULL,
    name_categorie VARCHAR(1000),
    PRIMARY KEY (conference_id, year_id),
    FOREIGN KEY (name_categorie) REFERENCES dim_conference_categorie(name_categorie),
    FOREIGN KEY (conference_id) REFERENCES dim_conference(venue_id),
    FOREIGN KEY (year_id) REFERENCES dim_year(year_id),
    FOREIGN KEY (rank_id) REFERENCES dim_conference_rank(rank_id)
);

CREATE TABLE appli_dblp_etoile.fact_cited_by_articles (
    cited_doi_id INTEGER REFERENCES appli_dblp_etoile.dim_cited_doi(cited_doi_id),
    cited_by VARCHAR(1000),
    title VARCHAR(2000),
    year_id INTEGER REFERENCES appli_dblp_etoile.dim_year_cited(year_cited_id),
    journal_title_id INTEGER REFERENCES appli_dblp_etoile.dim_journal_title(journal_title_id)
);

CREATE TABLE fact_author_prob (
    name_id INTEGER NOT NULL,
    year_id INTEGER NOT NULL,
    probability FLOAT NOT NULL,
    PRIMARY KEY (name_id, year_id),
    FOREIGN KEY (name_id) REFERENCES dim_author(author_id),
    FOREIGN KEY (year_id) REFERENCES dim_year(year_id)
);
