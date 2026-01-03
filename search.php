<?php
// search.php - CSVデータ内蔵版（php-wasm対応・Deprecated警告対策済み）

$csvData = <<<CSV
id,name,category,description,price
1,ノートパソコン,電子機器,15インチの高性能ノートPC,128000
2,ワイヤレスマウス,周辺機器,静音クリックのBluetoothマウス,3500
3,コーヒーメーカー,家電,全自動で豆から挽ける高級モデル,25000
4,革製ノートカバー,文房具,A5サイズの本革カバー（ブラウン）,6800
5,ワイヤレスイヤホン,電子機器,ノイズキャンセリング対応,18000
6,デスクチェア,家具,人間工学に基づいたオフィスチェア,45000
7,ステンレスボトル,キッチン用品,500mlの真空断熱ボトル,4200
8,メカニカルキーボード,周辺機器,赤軸で打ち心地抜群,12000
9,LEDデスクライト,照明,調光・調色可能なクリップ式ライト,5500
10,ポータブルSSD,ストレージ,1TBの高速外付けSSD,15800
CSV;

// CSV文字列を配列に変換
$lines = explode("\n", trim($csvData));
$header = str_getcsv(array_shift($lines));
$rows = array_map('str_getcsv', $lines);

$results = [];
$keyword = '';

if (isset($_GET['word'])) {
    $keyword = trim($_GET['word']);
}

foreach ($rows as $row) {
    $data = array_combine($header, $row);

    if ($keyword === '' || preg_grep('/' . preg_quote($keyword, '/') . '/i', $row)) {
        $results[] = $data;
    }
}

// htmlspecialcharsのラッパー関数を定義（推奨）
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>

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
        <input type="text" name="word" value="<?php echo h($keyword); ?>" placeholder="Keyword..">
        <button type="submit">Search</button>
    </form>

    <?php if (!empty($results)): ?>
        <h2>検索結果（<?php echo count($results); ?>件）</h2>
        <table>
            <thead>
                <tr>
                    <?php foreach ($header as $col): ?>
                        <th><?php echo h($col); ?></th>
                    <?php endforeach; ?>
                    <th>details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <?php foreach ($header as $col): ?>
                            <td><?php echo h($row[$col] ?? ''); ?></td>
                        <?php endforeach; ?>
                        <td>
                            <a class="buy" href="/buy.php?id=<?php echo h($row[$header[0]] ?? ''); ?>">
                                <strong>details</strong>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($keyword !== ''): ?>
        <p>「<?php echo h($keyword); ?>」に該当する商品はありませんでした。</p>
    <?php else: ?>
        <p>全<?php echo count($results); ?>件を表示中です。</p>
    <?php endif; ?>
</body>
</html>
