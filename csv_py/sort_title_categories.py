import csv

with open('csv_py/scimagojr 2021.csv', newline='') as infile:
    reader = csv.DictReader(infile, delimiter=';')
    with open('csv_py/scimagojr_title_categorie.csv', 'w', newline='') as outfile:
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
           
with open('csv_py/scimagojr_title_categorie.csv', 'r') as file:
    text = file.read()
    
    text = text.replace('"', '').replace('&amp;', '&').replace('; Q', ';Q')
    text = text.replace('&#x0300;', 'à').replace('Evolution; ', 'Evolution, ')
    text = text.replace('; ', ', ').replace('&#x0308;', 'Ä').replace('&#x0301;', 'ý')
    text = text.replace('&#x0304', 'ē').replace('&#x00e9;', 'é').replace('&#x00e9', 'é')
    text = text.replace('&#x0303;', 'ñ').replace('&#x00e7;', 'ç').replace('l&#x00ed;', 'í')
    text = text.replace('&#x00f5;', 'õ').replace('Transfer; ', 'Transfer, ')
    
    
with open('csv_py/scimagojr_title_categorie.csv', 'w') as file:
    file.write(text)