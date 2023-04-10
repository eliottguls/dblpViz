# DBLPViz

## Contributors :
- Eliott GUILLOSSOU
- Axel MICHELO
- Lucas THETIOT

## Context :
DBLP is a popular computer science bibliography website that provides open bibliographic information on major computer science conferences and journals. The DBLPViz project aims to collect a large amount of data from DBLP, APIs, and other websites related to computer science research, and present it in a user-friendly way. The project uses the CodeIgniter PHP framework for its website, and the PostgreSQL database to store all the data.

## Tools used :
- CodeIgniter: PHP framework
- PostgreSQL: database
- DBLP: data source and API
- Semantic Scholar: data source and API for articles
- Core API: API for conferences
- Scimago: data source for journals
- Genderize.io: API to determine gender from a name

## Functionality :
The DBLPViz website offers the following functionalities:
- Search for an article by title: enter a title and the website will return all the articles that have the same title
- Search for an article by author: available soon
- Add an article to the database: select between "Article journal" and "Conference and Workshop Papers"
- Search Conference rank: by using name or acronym of the conference and you can use a "Restrictive button" to just select exactly the title or acronym used
- Set genders to author: 2 functionalities
    - first search: enter a name and the website will return their gender and the probability of the result, with a restrict button to just select the name used
    - second set: to set a gender using Genderize API at the 1000th author in the database (due to API limits)
- Search Country by title: enter a journal title and get the country of the journal
- Search Categories rank of a journal: enter a journal title or a name of a category and get the rank of the journal, with a restrict button to just select the title used or categories
- Set doi to article: **to be added**

## Usage
To use the DBLPViz website:
1. Clone the repository on your computer: 
```bash
git clone https://github.com/eliottguls/dblpViz.git
```
2. Start the server at the main directory of the project: `dblpViz/`
3. Configure the database by updating the `database.php` file in the `dblpViz/app/config` directory.
4. Launch the database with the SQL script located at the root of the project: `dblpViz/creation.sql`
5. Access the main page at the URL: `http://localhost/app/`

## Technologies used
The technologies used in the DBLPViz project are:
- PHP version 7.4
- PostgreSQL version 12.7

## Scope and limitations
The DBLPViz project covers computer science research articles from DBLP, Semantic Scholar, Core API, and Scimago. However, it may not include all articles in these sources, and some data may be incomplete or outdated.

## Documentation
The DBLPViz website offers multiple forms that return a lot of data about articles in DBLP.

## Our database
We have set up a PostgreSQL Server on Azure, thanks to Github Education offers that allow us to store 256 GB of data for free with 1 GB of free processing calculation.

## Design phase
We initially designed a "normal" relational schema as taught. Later, we received training on star and snowflake schema, resulting in SQL scripts to create an equivalent database using these two schemas. Additionally, we migrated most of the data into our database through our PHP app using different APIs as previously mentioned. Therefore, we also created an SQL script to insert data from the "normal" schema into the other schema.

## Development phase
The controllers contain multiple if statements, which can be improved for optimization. We developed an algorithmic part to maximize the amount of data we retrieve from our database.

## Difficulties
The most challenging part of the project was obtaining data from different sources, which required the use of multiple APIs. Unfortunately, some of these APIs were not well documented, and we encountered incomplete or missing data. Additionally, our Wi-Fi connection was unstable, making it difficult to work on the project and insert data into the database.

