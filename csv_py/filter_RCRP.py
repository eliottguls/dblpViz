import csv


with open('csv_py/scimagojr 2021.csv', newline='') as infile:
    reader = csv.DictReader(infile, delimiter=';')
    with open('csv_py/scimagojr_RCRP.csv', 'w', newline='') as outfile:
        writer = csv.writer(outfile, delimiter=';')
        writer.writerow(['Title', 'Publisher', 'Rank', 'Country', 'Region'])
        for row in reader:
            title = row['Title']
            publisher = row['Publisher']
            rank = row['Rank']
            country = row['Country']
            region = row['Region']
            writer.writerow([title, publisher, rank, country, region])
            
with open('csv_py/scimagojr_RCRP.csv', 'r') as file:
    
    text = file.read()
    
    text = text.replace('"', '').replace('&amp;', '&').replace('&#x0300;', 'à')
    text = text.replace('; ', ', ').replace('&#x0308;', 'Ä').replace('&#x0301;', 'ý')
    text = text.replace('&#x0304', 'ē').replace('&#x00e9;', 'é').replace('&#x00e9', 'é')
    text = text.replace('&#x0303;', 'ñ').replace('&#x00e7;', 'ç').replace('l&#x00ed;', 'í')
    text = text.replace('&#x00f5;', 'õ').replace('Transfer; ', 'Transfer, ')


with open('csv_py/scimagojr_RCRP.csv', 'w') as file:
    file.write(text)