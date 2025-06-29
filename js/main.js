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
        // カード群を表示するための場所として、ourIdeasにDOM要素（ourIdeas）を代入する
        const ourIdeas = document.querySelector('.ourIdeas');
        // ourIdeas要素の中身を置き換えるためのhtml変数を設定
        let html = '<div class="ourIdeas-cards">';
        // ループ変数entryを使って、dataを繰り返し処理
        data.forEach((entry, idx) => {
            // テンプレートリテラルで簡単に文字列と変数などを連結
            // カスタムデータ属性：data-〇〇="値" という形で、任意のデータをHTML要素に持たせることができる
            // ドラッグ＆ドロップやクリックなどのイベント時に、「どのデータか」を特定するためによく使う

            html += `
                <div class="ideaCard"
                    draggable="true"
                    data-index="${idx}"
                    >
                <div>いつ: ${entry.whenToDo}</div>
                <div>誰と: ${entry.whoWith}</div>
                <div>何を: ${entry.whatToDo}</div>
                </div>
            `;
        });
        html += '</div>';
        // ourIdeas要素の中身を、html変数に入っているHTMLにまるごと置き換える
        ourIdeas.innerHTML = html;

        // ideaCardの要素全てを取得し、cardsに代入する（カード全体を扱いやすくする）
        const cards = document.querySelectorAll('.ideaCard');
        const dropArea = document.querySelector('.ideasThinking');

        // ◆◆◆PC用ドラッグ&ドロップ
        cards.forEach(card => {
        // カードがドラッグされたら、ドロップ先で正しく処理するため、このカードは何番目か（data-index）という情報をドラッグデータとしてセットする
        card.addEventListener('dragstart', (e) => {
            e.dataTransfer.setData('text/plain', card.dataset.index);
            // ドラッグして移動中と分かるよう透明化
            card.style.opacity = '0.4';
        });
        // ドラッグ操作が終わった時の処理
        card.addEventListener('dragend', (e) => {
            card.style.opacity = '';
            });
        });

        // ドロップエリアにカードが載っている時の処理
        dropArea.addEventListener('dragover', (e) => {
            // デフォルト動作（ドロップ禁止）をキャンセルし、ドロップを可能とする
            e.preventDefault();
            dropArea.style.background = '#eef';
        });
            // ドロップエリアからドラッグ中の要素が離れた時の処理
            dropArea.addEventListener('dragleave', (e) => {
            dropArea.style.background = '';
        });
        // ドロップエリアにカードがドロップされた時の処理
        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.style.background = '';
            // ドラッグ元でセットしたdata-index（何番目のカードか）を取得する
            const idx = e.dataTransfer.getData('text/plain');
            // data配列から該当するデータ（カードの内容）を取得する
            const entry = data[idx];
            dropArea.innerHTML += `
                <div class="ideaCard">
                    <div>いつ: ${entry.whenToDo}</div>
                    <div>誰と: ${entry.whoWith}</div>
                    <div>何を: ${entry.whatToDo}</div>
                </div>
            `;
        });

    } catch (error) {
        console.error('Error:', error);
    }
}

fetchIdeas();

