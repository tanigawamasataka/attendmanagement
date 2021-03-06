# 出欠管理システム
PHPのフレームワークlaravelで作成したポートフォリオです。

## 概要
プログラミング特化の就労支援事業所の利用者の実績管理をするためのシステムです。

利用者は出席時、退席時に所属校、利用者名を選択しタイムカードを打刻。

管理者は利用者の利用に際し提供した支援内容をもとに支援実績を管理、実績表作成をします。

### システムURL
https://attendmanagesystem.herokuapp.com/

### 管理者ログインテストデータ
管理者名 : 鈴木 一郎

パスワード : test1234

### 使用技術
* PHP7.2
* Laravel6.0
* mysql
* Laravel Excel3.1

### 画面イメージ
#### 画面遷移図
https://docs.google.com/drawings/d/1fbuXCPVTCPS1xhkYKdgdgZK49b13ye0JrnkzbdbpFV0/edit?usp=sharing

#### 利用者ページ

![attendmanagement1](https://user-images.githubusercontent.com/73512554/110243434-ac2aa100-7f9d-11eb-8314-56c0ad0da682.JPG)

#### 管理者ページ

![attendmanagement2](https://user-images.githubusercontent.com/73512554/110243525-1d6a5400-7f9e-11eb-9968-359bddb96d81.JPG)

### 機能一覧
#### 利用者
* 所属校、利用者名を選択してタイムカードを打刻
#### 管理者
* 管理者ログイン
* 利用者の新規登録
* 既存利用者の編集、削除
* 指定日の出席者一覧を表示
* 支援実績の新規登録
* 既存支援実績の編集、削除
* 該当月の利用者の支援実績をExcel出力
