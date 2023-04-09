import csv

with open('scimagojr 2021.csv', newline='') as infile:
    reader = csv.DictReader(infile, delimiter=';')
    with open('scimagojr_Conference_rank.csv', 'w', newline='') as outfile:
        writer = csv.writer(outfile, delimiter=';')
        writer.writerow(['Title', 'Rank'])
        for row in reader:
            title = row['Title']
            rank = row['Rank']
            writer.writerow([title, rank])

