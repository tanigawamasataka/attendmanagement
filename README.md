# PHP laravelのポートフォリオ

## 出欠管理システム

### 概要

1. 利用者は所属校を選び、タイムカードを打刻。
2. タイムカードの時刻は、出席ボタンが15分繰り上げ、退席ボタンが15分繰り下げで打刻。
3. 管理者はログインすることで、管理者ページにアクセスできる。
4. 管理者は利用者管理ページから利用者の新規登録と編集ができる。
5. 管理者は実績管理ページから実績を新規登録と編集ができ、利用者の実績表をExcel出力できる。

#### URL

#### テストアカウント

* ログイン名:　山田(全角スペース)一郎
* パスワード:　test1234

#### 画面一覧

##### 利用者用ページ

* トップページ→所属校を選択、利用者選択ページへ遷移
* 利用者選択ページ→所属校に準ずる利用者を選択、タイムカード打刻ページへ遷移
* タイムカード打刻ページ→出席、退席ボタンを打刻してタイムカードに時刻を記録(15分単位)

##### 管理者ページ

* トップページ→管理者ログインページへ遷移
* 管理者ログインページ→ログイン名とパスワードを入力してログイン(５回ログインに失敗するとロック)
* 管理者トップページ→管理する対象を選択

###### 利用者管理ページ

* 利用者管理ページ→新規利用者登録ページへ遷移、編集する利用者を選択して利用者編集ページへ遷移
* 新規利用者登録ページ→新規利用者登録処理
* 利用者編集ページ→利用者編集処理

###### 実績管理ページ

* 実績管理ページ→新規実績登録者選択ページへ遷移、日付別出席者表示ページへ遷移、実績編集ページへ遷移、利用者ごとの実績表ページへ遷移
* 新規実績登録者選択ページ→新規実績登録する利用者を選択して新規実績登録ページへ遷移
* 新規実績登録ページ→選択された利用者の新規実績登録処理
* 日付別出席者表示ページ→新規実績登録する利用者と日時をタイムカード打刻履歴より選択
* 日付別出席者新規実績登録ページ→選択された利用者のタイムカード打刻履歴をもとに新規実績登録処理
* 実績編集ページ→実績編集処理
* 利用者ごとの実績表ページ→選択された利用者の実績に該当する月の実績表を個別表示、Excel出力


