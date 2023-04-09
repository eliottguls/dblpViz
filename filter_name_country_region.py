import csv

with open('scimagojr 2021.csv', newline='') as infile:
    reader = csv.DictReader(infile, delimiter=';')
    with open('scimagojr_title_country_region.csv', 'w', newline='') as outfile:
        writer = csv.writer(outfile, delimiter=';')
        writer.writerow(['Title', 'Country', 'Region'])
        for row in reader:
            title = row['Title']
            country = row['Country']
            region = row['Region']
            writer.writerow([title, country, region])

