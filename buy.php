<?php
// buy.php - 商品購入ページ（CSV内蔵版）

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

// CSVを配列に変換
$lines  = explode("\n", trim($csvData));
$header = str_getcsv(array_shift($lines));
$rows   = array_map('str_getcsv', $lines);

// htmlspecialchars ラッパー
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// id取得
$id = $_GET['id'] ?? '';
$product = null;

// 商品検索
foreach ($rows as $row) {
    $data = array_combine($header, $row);
    if ($data['id'] === $id) {
        $product = $data;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <?php if ($product): ?>
        <title><?php echo h($product['name']); ?> - NNFNNF NetShop</title>
    <?php else: ?>
        <p>ObjectNotFound - NNFNNF NetShop</p>
    <?php endif; ?>
    <style>
        * {
    border-radius: 0 !important;
}

        body { font-family: sans-serif; margin: 40px; }
        .box {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 600px;
        }
        .price {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        a { text-decoration: none; }
    </style>
</head>
<body>

<h1>NNFNNF NetShop</h1>

<?php if ($product): ?>
    <div class="box">
        <h2><?php echo h($product['name']); ?></h2>
        <p>カテゴリ：<?php echo h($product['category']); ?></p>
        <p><?php echo h($product['description']); ?></p>
        <div class="price">¥<?php echo number_format($product['price']); ?></div>

        <button onclick="alert('購入処理は未実装です');">
            購入する
        </button>
    </div>

<?php else: ?>
    <p>商品が見つかりません。</p>
<?php endif; ?>

<p><a href="/search.php">← 検索に戻る</a></p>

</body>
</html>
