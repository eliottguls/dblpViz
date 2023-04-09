# DBLPViz

## Contributors :
- Eliott GUILLOSSOU
- Axel MICHELO
- Lucas THETIOT

## Context : 

We start a big DATA project about the dblp articles and data related to them. We decide to use the framework CodeIgniter to make our website. We also use a PostGreSQL database to store all the data. The objective of the project was to collect a large amount of data from dblp, api's and other website that i will list below. The second step was to do an interface for the user to be able to do lots of researches with the data collected before like also listed below. 

## Tools used :

- CodeIgniter : php framework
- PostGreSQL : database
- Dblp : data source and api
- Semantic Scholar : data source and api for the articles
- Core api : api for the conferences
- Scimago : data source for the journals
- genderize.io : api to determine gender from a name

## Fonctionnalities :

- Search for an article by title : enter a title and the website will return all the articles that have the same title
- Search for an article by author : available soon
- Add an article to the database : select beetwen "Article journal" and "Conference and Workshop Papers"
- Search Conference rank : by using name or acronym of the conference and u can use a "Restrictive button" to just select exactly the title or acronym used
- Set genders to author : 2 fonctionnalities
    - first Search : enter a name and the website will return his gender and the probability of the result with also a restrict button to just select the name used
    - second Set : to set a gender by using genderize at 1000st of author in the database ( 1000st because of the limit of the api )

- Search Country by title : enter a journal title and get the country of the journal
- Search Categories rank of a journal : enter a journal title or a name of a category and get the rank of the journal, also a restrict button to just select the title used or categories
- Set doi to article : **jsp eliott ecrit**


## Utilisation

- First you need to clone the repository on your computer. 
```bash
git clone https://github.com/eliottguls/dblpViz.git
```

- After you need to start the server at the main directory of the project : dblpViz/

- The database mustbe configurate, you can find the file in the folder : dblpViz/app/config/database.php

- You need to launch the database with the sql script at the root of the project : dblpViz/creation.sql

- Now you can start to use the website. You can find the main page at the url : http://localhost/app/

## Documentation

- Multiple form that return a lot of data about the articles in dblp




