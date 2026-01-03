<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>NNFNNF NetShop</title>
    <style>
        * {
    border-radius: 0 !important;
}

        body { font-family: sans-serif; margin: 40px; }
      body {
  margin: 0;
  height: 100vh;
  display: flex;
  justify-content: center; /* 横中央 */
  align-items: center;     /* 縦中央 */
}
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #f0f0f0; }
        input[type="text"] { padding: 8px; width: 300px; font-size: 16px; }
        button { padding: 8px 16px; font-size: 16px; }
        input,
        button {
            background-color: #ffffff;
            border: 1px solid #ccc;
            padding: 8px 15px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 5px;
            transition: 0.15s;
        }

        input:hover,
        button:hover {
            background-color: #e9e9e9;
        }
        .buy {
            font-size: 20px;
            color: black;
            text-decoration: none;
        }

        .buy:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>NNFNNF NetShop</h1>
    
    <form method="get">
        <input type="text" name="word" value="" placeholder="Keyword..">
        <button type="submit">Search</button>
    </form>
</body>
</html>
