import csv

with open('scimagojr 2021.csv', newline='') as infile:
    reader = csv.DictReader(infile, delimiter=';')
    with open('scimagojr_publisher.csv', 'w', newline='') as outfile:
        writer = csv.writer(outfile, delimiter=';')
        writer.writerow(['Title', 'Publisher'])
        for row in reader:
            title = row['Title']
            publisher = row['Publisher']
            writer.writerow([title, publisher])

