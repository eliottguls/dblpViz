<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create or modify a task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <style>
        body {
            background-color: grey;
        }
        h2 {
            color: white;
            text-align: center;
            margin-top: 40px;
        }

    .form-group {
        margin-bottom: 20px;
    }
    .container {
        margin-top: 40px;
    }
    .change_form {
        display: flex;
        justify-content: space-between;
    }

    .ghost{
        display: none;
    }

    label{
        color: white;
    }


</style>
</head>
<body>
    <div class="container">
        <h2>Enter Author</h2>
        <?php echo validation_errors();?>
        <?php echo form_open('publication/get_article_by_author')?>
            <div class="form-group">
                <label for="id">Author</label>
                <input type="input" class="form-control" name ="name" placeholder="Author name" ><br/>
            </div>
            <button type="submit" name="submit" value ="Search" class="btn btn-primary">Search</button>
        </form>
    </div>
    <div class="container">
        <h2>Enter Title</h2>
        <?php echo validation_errors();?>
        <?php echo form_open('publication/get_article_by_title')?>
            <div class="form-group">
                <label for="id">Title</label>
                <input type="input" class="form-control" name ="title" placeholder="Article Title"><br/>
            </div>
            <button type="submit" name="submit" value ="Search" class="btn btn-primary">Search</button>
        </form>
    </div>

    <div class="container">
        <h2> Enter a Name or an Acronym Conference </h2>
        <?php echo validation_errors();?>
        <?php echo form_open('conference_rank/get_rank')?>
        <div class="form-group">
                <label for="name_id">NAME / ACRONYM &nbsp | &nbsp</label>
                <label for="restict_id">Restrictive </label>
                <input type="checkbox" name="Restrictive"><br/>
                <input type="input" class="form-control" name ="name_acronym" placeholder="name or acronym of Conference"><br/>
                
            </div>
            <button type="submit" name="submit" value ="Search" class="btn btn-primary">Search</button>
        </form>
    </div>

    <div id="to_journal" class="container">
    <h2> Add an Article : Conference</h2>
        <?php echo validation_errors();?>
        <?php echo form_open('add_article/new_conference')?>
        <div class="form-group">
        <label for="type"> TYPE : </label>
            <select class="form-control" name="type" id="select-type">
                <option value=""> - Select an option - </option>
                <option value="Conference and Workshop Papers"> Conference and Workshop Papers </option>
            </select></br>
            <label for="title_id"> TITLE : </label><input class="form-control" type="text" id="title_id" name="title_name" placeholder="Title max length 2000 characters"></br>
            <label for="venue_id"> VENUE : </label><input class="form-control" type="text" id="venue_id" name="venue" placeholder="Venue max length 100 characters"></br>
            <label for="year_id"> YEAR : </label><input class="form-control" type="year" id="year_id" name="year_name" placeholder="Year max length 4 characters"></br>
            <label for="pages_id"> PAGES NUMBER : </label><input class="form-control" type="number" id="pages_id" name="pages" min="1" max="100000" placeholder="Pages max length 20 characters"></br>
            <label for="doi_id"> DOI : </label><input class="form-control" type="text" id="doi_id" name="doi" placeholder="DOI max length 255 characters"> </br><div class="change_form">
            <button type="submit" name="submit" value ="ADD" class="btn btn-primary"> ADD </button>
            </div>
        </div>
        </form>
        <button id="btn_to_journal" class="btn btn-primary"> TURN INTO JOURNAL </button>
    </div>

    <div id="to_conference" class="ghost container">
    <h2 > Add an Article : Journal</h2>
        <?php echo validation_errors();?>
        <?php echo form_open('add_article/new_journal')?>
        <div class="form-group">
        <label for="type"> TYPE : </label>
            <select class="form-control" name="type" id="select-type">
                <option value=""> - Select an option - </option>
                <option value="Journal Article"> Journal Article</option>
            </select></br>
            <label for="title_id"> TITLE : </label><input class="form-control" type="text" id="title_id" name="title_name" placeholder="Title max length 2000 characters"></br>
            <label for="venue_id"> VENUE : </label><input class="form-control" type="text" id="venue_id" name="venue" placeholder="Venue max length 100 characters"></br>
            <label for="year_id"> YEAR : </label><input class="form-control" type="year" id="year_id" name="year_name" placeholder="Year max length 4 characters"></br>
            <label for="pages_id"> PAGES NUMBER : </label><input class="form-control" type="number" id="pages" name="pages" min="1" max="100000" placeholder="Pages max length 20 characters"></br>
            <label for="doi_id"> DOI : </label><input class="form-control" type="text" id="doi_id" name="doi" placeholder="DOI max length 255 characters"> </br>
            <label for="volume_id"> VOLUME : </label><input class="form-control" type="text" id="volume_id" name="volume" placeholder="Volume max length 50 characters"></br>
            <label for="number_journal_id"> NUMBER JOURNAL : </label><input class="form-control" type="text" id="number_jorunal_id" name="number_journal" placeholder="Number Journal max length 20 characters"></br>
            <div class="change_form">
                <button type="submit" name="submit" value ="ADD" class="btn btn-primary"> ADD </button>
                
            </div>
        </div>
        </form>
        <button id="btn_to_conference" class="btn btn-primary"> TURN INTO CONFERENCE </button>
    </div>

    <script>
            var form_to_journal = document.getElementById('btn_to_journal');
            var form_to_conference = document.getElementById('btn_to_conference');
            form_to_journal.addEventListener('click', function(){
                document.getElementById('to_conference').classList.remove('ghost');
                document.getElementById('to_journal').classList.add('ghost');
            
            });
            form_to_conference.addEventListener('click', function(){
                document.getElementById('to_conference').classList.add('ghost');
                document.getElementById('to_journal').classList.remove('ghost');
            });
    </script>

    <div class="container">
        <h2> Set Gender to Authors</h2>
        <?php echo validation_errors();?>
        <?php echo form_open('gender/gender_display')?>
            <div class="form-group">
                <label for="id">Name | Restrictive </label>
                <input type="checkbox" name="Restrictive"><br/>
                <input type="input" class="form-control" name ="name" placeholder="Author name" ?><br/>
            <button type="submit" name="submit" value ="Search" class="btn btn-primary">Search</button>
            </div>
        </form>
        <?php echo validation_errors();?>
        <?php echo form_open('gender/gender_probability')?>
            <button type="submit" name="submit" value ="Set Genders" class="btn btn-primary">Set Genders</button>
        </form>
    </div>

    <div class="container">
        <h2> Search Country / Region by Title </h2>
        <?php echo validation_errors();?>
        <?php echo form_open('Country/display_country')?>
            <div class="form-group">
                <label for="id">Name | Restrictive </label>
                <input type="checkbox" name="Restrictive"><br/>
                <input type="input" class="form-control" name ="name" placeholder="Journal title" ?><br/>
            <button type="submit" name="submit" value ="Search" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>


    <div class="container">
        <h2> DOI Crossref</h2>
        <?php echo validation_errors();?>
        <?php echo form_open('publication/get_cited_by')?>
        <div class="form-group">
                <label for="id">DOI</label>
                <input type="input" class="form-control" name ="doi" placeholder="doi" ><br/>
            </div>
            <button type="submit" name="submit" value ="Search" class="btn btn-primary">Search</button>
        </form>
    </div>

    <div class="container">
        <h2> Search Jouranl Categories rank </h2>
        <?php echo validation_errors();?>
        <?php echo form_open('Journal/get_rank_title')?>
        <div class="form-group">
                <label for="id"> Journal | Restrictive </label>
                <input type="checkbox" name="Restrictive"><br/>
                <input type="input" class="form-control" name ="name" placeholder="Journal name"><br/>
            </div>
            <button type="submit" name="submit" value ="Search" class="btn btn-primary">Search</button>
        </form>

        <?php echo validation_errors();?>
        <?php echo form_open('Journal/get_rank_categorie')?>
        <div class="form-group">    
                <label for="id"> Categorie | Restrictive </label>
                <input type="checkbox" name="Restrictive"><br/>
                <input type="input" class="form-control" name ="name" placeholder="Categorie name"><br/>
            </div>
            <button type="submit" name="submit" value ="Search" class="btn btn-primary">Search</button>
        </form>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>