// ◆◆◆ anyIdeasDisplay.phpからJSONデータを取得し、ourIdeas内にテーブルを動的に生成

async function fetchIdeas() {
    // このブロック内でエラーが発生した場合、catchで処理する
    try {
        // fetch()を使ってanyIdeasDisplay.phpへHTTPリクエストを送り、レスポンスをresponseに代入
        // awaitにより、レスポンスが返るまで処理は一時停止
        const response = await fetch('anyIdeasDisplay.php');
        // responseオブジェクトのステータスコードが200番台ではない（つまりエラー）の場合の処理を記載
        if (!response.ok) {
            // 例外を投げるthrowでプログラムの実行を中断し、catch に処理を進める
            // new ErrorでError オブジェクトの新しいインスタンスを作る
            throw new Error('ネットワークエラー');
        }

        const data = await response.json();
        // クラス名がourIdeasのDOM要素を取得し、ourIdeasに代入➡ourIdeas.innerHTML = html;で動的に生成したhtmlをourIdeasに代入する
        const ourIdeas = document.querySelector('.ourIdeas');
        let html = '<div class="ourIdeas-wrapper">';
        // dataに中身があれば、処理する
        if (data.length > 0) {
            html += '<table class="ourIdeas-table">';
            html += '<thead><tr><th class="tableSticky">いつ</th><th class="tableSticky">誰と</th><th class="tableSticky">何をしたい</th></tr></thead>';
            html += '<tbody>';
            // dataの各要素を仮引数のentryとして、繰り返し処理
            data.forEach(entry => {
                // テンプレートリテラル（`・・・`）を活用
                html += `<tr class="ourIdeasTr">
                    <td>${entry.whenToDo}</td>
                    <td>${entry.whoWith}</td>
                    <td>${entry.whatToDo}</td>
                </tr>`;
            });
            html += '</tbody></table>';
        } else {
            html += '<p>登録データがありません</p>';
        }
        html += '</div>';
        // ourIdeas要素のHTMLを、構築した文字列で置き換え
        ourIdeas.innerHTML = html;

    } catch (error) {
        console.error('Error:', error);
    }
}

fetchIdeas();

