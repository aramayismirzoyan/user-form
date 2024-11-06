<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/styles/bootstrap/index.css">
    <link rel="stylesheet" href="./public/styles/index.css">
    <title>Форма пользователей</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-5 mb-5 mt-md-3 mb-md-3 text-center">Форма добавления пользователя</h1>
            </div>
            <div class="col-12 col-lg-6">
                <!--       User form         -->
                <form class="user-form" action="/create">
                    <div class="mb-3">
                        <label for="userInputName" class="form-label">Имя</label>
                        <input type="text" name="name" class="form-control" id="userInputName">
                        <div id="userInputNameFeedback" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="userInputEmail" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="userInputEmail">
                        <div id="userInputEmailFeedback" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="userInputAge" class="form-label">Возраст</label>
                        <input type="text" name="age" class="form-control" id="userInputAge">
                        <div id="userInputAgeFeedback" class="invalid-feedback"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
                <!--       End user form         -->
            </div>
            <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                <div class="users-table">
                    <?php self::include('user_table', $params) ?>
                </div>
            </div>
        </div>
    </div>


    <script src="./public/js/jquery/index.js"></script>
    <script src="./public/js/index.js"></script>
</body>
</html>

