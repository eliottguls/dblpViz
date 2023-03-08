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
            background-color: #e0f2e9;
        }
        h2 {
            color: #176d4b;
            text-align: center;
            margin-top: 40px;
        }

    .form-group {
        margin-bottom: 20px;
    }
    .container {
        margin-top: 40px;
    }


</style>
</head>
<body>
    <div class="container">
        <h2>Enter author</h2>
        <?php echo validation_errors();?>
        <?php echo form_open('publication/get_article_by_author')?>
            <div class="form-group">
                <label for="id">Author</label>
                <input type="input" class="form-control" name ="name"?><br/>
            </div>
            <button type="submit" name="submit" value ="Create" class="btn btn-primary">Search</button>
        </form>
    </div>
    <div class="container">
        <h2>Enter title</h2>
        <?php echo validation_errors();?>
        <?php echo form_open('publication/get_article_by_title')?>
            <div class="form-group">
                <label for="id">Title</label>
                <input type="input" class="form-control" name ="title"?><br/>
            </div>
            <button type="submit" name="submit" value ="Create" class="btn btn-primary">Search</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>