categories = set()

with open('csv_py/scimagojr_2021_categories.csv', 'r') as file:
    for line in file:
        cats = line.strip().split(';')
        for cat in cats:
            categories.add(cat.strip())

with open('csv_py/scimagojr_2021_categories_output.csv', 'w') as file:
    file.write('Categorie')
    for cat in categories:
        file.write(cat + '\n')
