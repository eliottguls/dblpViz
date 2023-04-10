INSERT INTO appli_dblp_etoile.dim_article_type(type)
SELECT DISTINCT type FROM appli_dblp._article;

INSERT INTO appli_dblp_etoile.dim_pages(pages)
SELECT DISTINCT pages FROM appli_dblp._article;

INSERT INTO appli_dblp_etoile.dim_ee(ee)
SELECT DISTINCT ee FROM appli_dblp._article;

INSERT INTO appli_dblp_etoile.dim_url_dblp(url_dblp)
SELECT DISTINCT url_dblp FROM appli_dblp._article;

INSERT INTO appli_dblp_etoile.dim_conference_rank(rank)
SELECT DISTINCT rank FROM appli_dblp._conference_acronym_rank;

INSERT INTO appli_dblp_etoile.dim_conference_categorie(name_categorie)
SELECT DISTINCT name_categorie FROM appli_dblp._journal_sub_categories_rank;

INSERT INTO appli_dblp_etoile.dim_author(name, gender, probability)
SELECT name, gender, probability FROM appli_dblp._author;

INSERT INTO appli_dblp_etoile.dim_conference(name_conference)
SELECT DISTINCT venue FROM appli_dblp._article;

INSERT INTO appli_dblp_etoile.dim_year(year)
SELECT DISTINCT year FROM appli_dblp._article;

INSERT INTO appli_dblp_etoile.dim_id_dblp(id_dblp)
SELECT DISTINCT id_dblp FROM appli_dblp._article;

INSERT INTO appli_dblp_etoile.dim_cited_doi (cited_doi)
SELECT DISTINCT cited_doi FROM appli_dblp._cited_by_articles;

INSERT INTO appli_dblp_etoile.dim_journal_title (journal_title)
SELECT DISTINCT journal_title FROM appli_dblp._cited_by_articles ;

INSERT INTO appli_dblp_etoile.dim_year_cited (year_cited)
SELECT DISTINCT year FROM appli_dblp._cited_by_articles WHERE year IS NOT NULL;

INSERT INTO appli_dblp_etoile.fact_cited_by_articles (cited_doi_id, cited_by, title, year_id, journal_title_id)
SELECT c.cited_doi_id, c.cited_by, c.title, y.year_cited_id, j.journal_title_id
FROM appli_dblp._cited_by_articles c
  LEFT JOIN appli_dblp_etoile.dim_cited_doi cd ON c.cited_doi = cd.cited_doi
  LEFT JOIN appli_dblp_etoile.dim_journal_title j ON c.journal_title = j.journal_title
  LEFT JOIN appli_dblp_etoile.dim_year_cited y ON c.year = y.year_cited;



INSERT INTO appli_dblp_etoile.fact_article(id_dblp, type_id, venue_id, year_id, pages_id, ee_id, url_dblp_id)
SELECT a.id_dblp, t.id_type, v.venue_id, y.year_id, p.pages_id, e.ee_id, u.url_dblp_id
FROM appli_dblp._article a
  LEFT JOIN appli_dblp_etoile.dim_article_type t ON a.type = t.type
  LEFT JOIN appli_dblp_etoile.dim_conference v ON a.venue = v.name_conference
  LEFT JOIN appli_dblp_etoile.dim_year y ON a.year = y.year
  LEFT JOIN appli_dblp_etoile.dim_pages p ON a.pages = p.pages
  LEFT JOIN appli_dblp_etoile.dim_ee e ON a.ee = e.ee
  LEFT JOIN appli_dblp_etoile.dim_url_dblp u ON a.url_dblp = u.url_dblp;

INSERT INTO appli_dblp_etoile.fact_article_author(id_article, name_id, pos)
SELECT a.id_article, au.name_id, aa.pos
FROM appli_dblp.article_author aa
  LEFT JOIN appli_dblp_etoile.dim_author au ON aa.name = au.name
  LEFT JOIN appli_dblp_etoile.fact_article a ON aa.id_article = a.id_article;
  
