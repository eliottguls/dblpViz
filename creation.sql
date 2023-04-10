drop schema if exists appli_dblp cascade;
create schema appli_dblp;
set schema 'appli_dblp';

CREATE TABLE _Article(
    id_dblp INTEGER PRIMARY KEY,
    type VARCHAR(1000) not null,
    doi VARCHAR(255) not null,
    title VARCHAR(2000) not null,
    venue VARCHAR(100) not null,
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


-- DROP TABLE _Conference;
/*
CREATE TABLE _Conference(
    name_conference VARCHAR(255) PRIMARY KEY
);
*/

CREATE TABLE _Year(
    year VARCHAR(4) PRIMARY KEY
);

CREATE TABLE _Conference_Rank(
    name VARCHAR(255) not null,
    year VARCHAR(4) not null,
    rank VARCHAR(2) not null,
    PRIMARY KEY (name, year),
    FOREIGN KEY (year) REFERENCES _Year(year)
);

CREATE TABLE _Conference_Categories(
    id serial,
    name_categorie VARCHAR(255),
    PRIMARY KEY (name_categorie)
);

drop table _Conference_Subject_Rank;
CREATE TABLE _Conference_Subject_Rank(
    id serial,
    name_conference VARCHAR(255) not null,
    name_categorie VARCHAR(255),
    rank VARCHAR(2),
    year VARCHAR(4),
    PRIMARY KEY (id),
    --FOREIGN KEY (name_categorie) REFERENCES _Conference_Categories(name_categorie),
    FOREIGN KEY (year) REFERENCES _Year(year)
);

-- DROP TABLE _Conference_Acronym_Rank;
CREATE TABLE _Conference_Acronym_Rank(
    id int not null,
    name_conference VARCHAR(355) not null,
    acronym VARCHAR(50),
    rank VARCHAR(50),
    Primary KEY (id)
);

-- DROP TABLE _Country_rank;
CREATE TABLE _Country_rank(
    id int not null primary key,
    country varchar(100) not null,
    region varchar(100) not null,
    documents int not null,
    citable_documents int not null,
    citations int not null,
    self_citations int not null,
    citation_per_documents float,
    H_Index int not null
);

DROP TABLE appli_dblp._cited_by_articles CASCADE;
CREATE TABLE appli_dblp._cited_by_articles(
    cited_doi VARCHAR(1000),
    cited_by VARCHAR(1000),
    title VARCHAR(2000),
    year VARCHAR(10),
    journal_title VARCHAR(2000),
    FOREIGN KEY (cited_doi) REFERENCES _article(doi)
);

INSERT INTO _year (year) VALUES ('2021');

WbImport -file=./CORE_DATA.csv
         -header=false
         -delimiter=','
         -table=_Conference_Acronym_Rank
         -schema=appli_dblp
         -filecolumns=id,name_conference,acronym,?,rank;
;

WbImport -file=./scimagojr_country_rank.csv
         -header=true
         -delimiter=';'
         -table=_Country_rank
         -schema=appli_dblp
         -filecolumns=id,country,region,documents,citable_documents,citations,self_citations,citations_per_documents,H_Index;
;

WbImport -file=./scimagojr_2021_categories_output.csv
         -header=true
         -table=_conference_categories
         -schema=appli_dblp
         -filecolumns=name_categorie;
;

WbImport -file=./scimagojr_title_categorie.csv
         -header=true
         -delimiter=';'
         -table=_Conference_Subject_Rank
         -schema=appli_dblp
         -filecolumns=name_conference,name_categorie,rank,year;
         
select count(*) from appli_dblp._Conference_Subject_Rank where rank = 'Q4 ';
