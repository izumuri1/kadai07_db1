<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Any ideas?</title>
</head>

<body>
    <div class="">
        
        <!-- header -->
        <div class="sticky">
            <header>
                <h1>Any ideas?</h1>
            </header>
        </div>

        <!-- div：Any ideas?（今度何する？） -->
        <div class="anyIdeas">
            <!-- ここに、今度何するの入力フォームを作成 -->
            <!-- ◆◆◆入力した情報が「anyIdeasSave.php」へ送信（POST）される -->
            <p>いつ誰と何をしたい</p>
            <form action="anyIdeasSave.php" class="" id="" method="post">
                <div class="inputBlk">
                    <input type="month" name="whenToDo">
                    <input type="text" name="whoWith" placeholder="誰と">
                </div>
                <div class="inputBlk">
                    <input type="text" name="whatToDo" placeholder="何をしたい">
                </div>
                <div class="inputBtn">
                    <input class="inputBtn" type="submit" value="送信">
                </div>
            </form>
        </div>

        <!-- div：Our ideas（やりたいことリスト） -->
        <h2>Our ideas</h2>
        <div class="ourIdeas">
            <!-- ここに、JavaScriptで動的にanyIdeasを表示 -->
        </div>

        <!-- div：Ideas we're thinking about（計画中リスト） -->
        <h2>Ideas we're thinking about</h2>
        <div class="ideasThinking">
            <!-- ここに、ユーザー自身で、やりたいことリストからやりたいことをドラッグアンドドロップで入れ込む -->
        </div>

        <!-- div：Ideas we're tried（実施済みリスト） -->
        <h2>Ideas we're tried</h2>
        <div class="ideasTried">
            <!-- ここに、ユーザー自身で、計画中リストから実施したことをドラッグアンドドロップで入れ込む -->
        </div>

        <!-- footer -->
        <div class="">
            <footer>&copy; 2025 izumuri</footer>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="module" src="js/main.js"></script>
</body>
</html>