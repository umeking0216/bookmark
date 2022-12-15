<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ登録</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
        td{
            border-bottom: 1px solid #ccc;
            border-left: 1px solid #ccc;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <!-- <form method="post" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>ブックマーク</legend>
                <label>書籍名：<input type="text" name="book"></label><br>
                <label>書籍URL：<input type="text" name="book_url"></label><br>
                <label><textArea name="content" rows="4" cols="40"></textArea></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form> -->

        <div class="form_wrapper">
            <h2 class="course__title text-center">ブックマーク</h2>
            <p class="text-center">興味ある本を探してリストを作ろう</p>
        <form action="insert.php" method="POST">
            <table class="form-table">
                <tbody>
                  <tr>
                    <th>書籍名</th>
                    <td><input type="text" name="book" size="60" id="book_1" value="" placeholder="書籍名をかく">
                    </td>
                  </tr>
                  <tr>
                    <th>書籍URL</th>
                    <td><input type="text" name="book_url" size="60" id="book_2" value="">
                    </td>
                  </tr>
                  <tr>
                  <tr> 
                    <th>コメント</th>
                    <td><textarea name="content" cols="30" rows="10" placeholder="レビューを書く"></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
        
            
        <input type="submit" class="btn" value="ブックマークする">
      </form>  
      </div>  
      <div class="form_wrapper">
            <table class="form-table">
                <tbody>
                  <tr>
                    <th><input type="text" id="key"placeholder="検索する"></th>
                    <td><button id="send" class="btn">書籍を検索</button></td>
                  </tr>
                </tbody>
              </table>        
       </div>
        <div>  
            <table id="list"></table>
        </div>

       


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>




             
    //検索ボタンをクリックしたら
    $("#send").on("click",function(){
        const url = "https://www.googleapis.com/books/v1/volumes?q="+$("#key").val(); 
        $.ajax({
            url: url,
            dataType: "json"
        }).done(function(data) {
            //書籍名、出版社、サムネイル[リンク]
            console.log(data);             //オブジェクトの中を確認
            const len = data.items.length; //データの数を取得
            let html;
            
            html = `
            <tr>
                <td style="width:400px">書籍名</td>
                <td style="width:200px">出版社</td>
                <td style="width:400px">画像</td>
            </tr>`

            for(let i=0; i<len; i++){
                console.log(typeof data.items[i].volumeInfo.publisher);
                if(typeof data.items[i].volumeInfo.publisher=="undefined"){
                    data.items[i].volumeInfo.publisher="出版社（不明）";
                }
                html += `
                    <tr>
                        <td>${data.items[i].volumeInfo.title}</td>
                        <td>${data.items[i].volumeInfo.publisher}</td>
                        <td>
                            <a target="_blank" href="${data.items[i].volumeInfo.infoLink}">
                                <img src="${data.items[i].volumeInfo.imageLinks.thumbnail}">
                            </a>
                        </td>
                        <td>
                         <input type="submit" id="reg${[i+1]}" class="btn" value="この書籍を選択する">
                        </td>
                    </tr>
                `;
            }
            
            //table要素のid="list"に追加
            $("#list").empty().hide().append(html).fadeIn(1000);
            

            for(let i=0; i<len; i++){
            $("#reg1").on("click",function(){
               $("#book_1").val(data.items[0].volumeInfo.title)
               $("#book_2").val(data.items[0].volumeInfo.infoLink)
            });
            $("#reg2").on("click",function(){
               $("#book_1").val(data.items[1].volumeInfo.title)
               $("#book_2").val(data.items[1].volumeInfo.infoLink)
            });
            $("#reg3").on("click",function(){
               $("#book_1").val(data.items[2].volumeInfo.title)
               $("#book_2").val(data.items[2].volumeInfo.infoLink)
            });
            $("#reg4").on("click",function(){
               $("#book_1").val(data.items[3].volumeInfo.title)
               $("#book_2").val(data.items[3].volumeInfo.infoLink)
            });
            $("#reg5").on("click",function(){
               $("#book_1").val(data.items[4].volumeInfo.title)
               $("#book_2").val(data.items[4].volumeInfo.infoLink)
            });
            $("#reg6").on("click",function(){
               $("#book_1").val(data.items[5].volumeInfo.title)
               $("#book_2").val(data.items[5].volumeInfo.infoLink)
            });
            $("#reg7").on("click",function(){
               $("#book_1").val(data.items[6].volumeInfo.title)
               $("#book_2").val(data.items[6].volumeInfo.infoLink)
            });
            $("#reg8").on("click",function(){
               $("#book_1").val(data.items[7].volumeInfo.title)
               $("#book_2").val(data.items[7].volumeInfo.infoLink)
            });
            $("#reg9").on("click",function(){
               $("#book_1").val(data.items[8].volumeInfo.title)
               $("#book_2").val(data.items[8].volumeInfo.infoLink)
            });
            $("#reg10").on("click",function(){
               $("#book_1").val(data.items[9].volumeInfo.title)
               $("#book_2").val(data.items[9].volumeInfo.infoLink)
            });
        }
        });

       
    });

   




     
    </script>


</body>

</html>
