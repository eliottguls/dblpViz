drop schema if exists Geographic_data cascade;
create schema Geographic_data;
set schema 'Geographic_data';

create table Geographic_data._continent_country(
  id_continent_country  serial,
  continent_name     varchar(100)   not null,
  country_name       varchar(100)  not null,
  constraint _continent_country_pk primary key (id_continent_country)
);

create table Geographic_data._cities(
  id varchar(100) not null,
  city_name varchar(100) not null,
  country_name varchar(100) not null,
  constraint city_pk primary key (id, city_name)
);

WbImport -file=./data/Countries-Continents.csv
         -header=true
         -delimiter=','
         -table=_continent_country
         -schema=Geographic_data
         -filecolumns=continent_name,country_name;
         
WbImport -file=./data/worldcities.csv
         -header=true
         -delimiter=','
         -table=_cities
         -schema=Geographic_data
         -filecolumns=city_name,?,?,?,country_name,?,?,?,?,?,id;


UPDATE Geographic_data._cities
SET country_name = REPLACE(country_name, '"', '');

UPDATE Geographic_data._cities
SET id = REPLACE(id, '"', '');

UPDATE Geographic_data._cities
SET city_name = REPLACE(city_name, '"', '');

--Vue pour lier les données
DROP VIEW Geographic_data.continent_country_cities;      
Create VIEW Geographic_data.continent_country_cities as(
  select continent_name, cc.country_name, city_name from Geographic_data._continent_country cc
  inner join Geographic_data._cities ct on ct.country_name = cc.country_name
);

-- Vérification que toutes les villes sont liés à un pays, et que ce pays soit dans la liste
select * from Geographic_data._cities where city_name = 'Myingyan';
select * from Geographic_data."_continent_country" where country_name = 'Myanmar';

-- Cas qui marche
select * from Geographic_data._cities where country_name = 'Andorra';
select * from Geographic_data._continent_country where country_name = 'Andorra';

-- vérification que toutes les villes ont un pays assigné
select * from Geographic_data._cities where city_name ='';


-- nb_ville par pays
select count(*) as nb_ville, country_name, continent_name from Geographic_data.continent_country_cities group by country_name;

-- nb_pays par continent
SELECT continent_name, COUNT(DISTINCT country_name) AS nb_pays
FROM Geographic_data.continent_country_cities
GROUP BY continent_name;

-- nb_ville par continent
SELECT continent_name, COUNT(DISTINCT city_name) AS nb_cities
FROM Geographic_data.continent_country_cities
GROUP BY continent_name;

--nb de villes par pays décroissant
SELECT country_name, COUNT(DISTINCT city_name) AS nb_villes
FROM Geographic_data.continent_country_cities
GROUP BY country_name
ORDER BY nb_villes DESC;

--nb de villes max par pays 
SELECT country_name, COUNT(DISTINCT city_name) AS nb_villes
FROM Geographic_data.continent_country_cities
GROUP BY country_name
HAVING COUNT(DISTINCT city_name) = (
    SELECT MAX(nb_villes)
    FROM (
        SELECT COUNT(DISTINCT city_name) AS nb_villes
        FROM Geographic_data.continent_country_cities
        GROUP BY country_name
    ) nb_ville
);

--nb moyen de ville par continent
SELECT continent_name, AVG(nb_villes) AS nb_villes_moyen
FROM (
    SELECT continent_name, country_name, COUNT(DISTINCT city_name) AS nb_villes
    FROM Geographic_data.continent_country_cities
    GROUP BY continent_name, country_name
) nb_ville_avec_pays_continent
GROUP BY continent_name;

--le nombre maximum de pays par continent;
SELECT continent_name, COUNT(country_name) AS nb_pays_max
FROM Geographic_data._continent_country
GROUP BY continent_name
HAVING COUNT(country_name) = (
    SELECT MAX(nb_pays)
    FROM (
        SELECT COUNT(country_name) AS nb_pays
        FROM Geographic_data._continent_country
        GROUP BY continent_name
    ) nb_villes
);

SELECT continent_name, COUNT(country_name) AS nb_pays
FROM Geographic_data._continent_country
GROUP BY continent_name
ORDER BY nb_pays DESC;
