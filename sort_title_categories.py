import csv

with open('scimagojr 2021.csv', newline='') as infile:
    reader = csv.DictReader(infile, delimiter=';')
    with open('scimagojr_title_categorie.csv', 'w', newline='') as outfile:
        writer = csv.writer(outfile, delimiter=';')
        writer.writerow(['Title', 'Category'])
        for row in reader:
            title = row['Title']
            categories = row['Categories'].split(';')
            for category in categories:
                writer.writerow([title, category])
