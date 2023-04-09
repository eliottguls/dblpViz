import csv

with open('scimagojr 2021.csv', newline='') as infile:
    reader = csv.DictReader(infile, delimiter=';')
    with open('scimagojr_title_categorie.csv', 'w', newline='') as outfile:
        writer = csv.writer(outfile, delimiter=';')
        writer.writerow(['Title','Category', 'rank'])
        for row in reader:
            title = row['Title']
            categories = row['Categories'].split(';')
            for category in categories:
                if category != '':
                    if category[0] == ' ':
                        category = category.lstrip()
                category_rank = category.replace(" (", ";").replace(")", "")
                category_rank = category_rank.replace(";", ";1")
                category_rank = category_rank.replace(";1Q", "; Q")
                category_rank = category_rank.replace(";1", ", ")
                writer.writerow([title, category_rank])
           
with open('scimagojr_title_categorie.csv', 'r') as file:
    text = file.read()
    
    text = text.replace('"', '').replace('&amp;', '&')

with open('scimagojr_title_categorie.csv', 'w') as file:
    file.write(text)