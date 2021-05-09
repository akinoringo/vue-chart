# Kiseki
日々の頑張り(軌跡)を記録して、目標達成をサポートするアプリです。<br>

### こんな人におすすめ
- 達成したい目標はあるけれど、なかなか継続して頑張れない
- 目標達成に向けて日々頑張っているけれど、なかなか進歩が見られない
- 達成したい目標がたくさんあり、一つに集中して継続できない

### Kisekiの特徴
- 目標と目標達成に向けて継続して取り組みたい時間を登録して、日々の積み上げを記録するだけだから簡単
- ほかの人の目標や軌跡が確認できるからモチベーションが上がる
- 一度に登録できる目標は３つまでだから、本当に達成したい目標に向けて頑張れる

### 使い方
1. 目標と目標達成に向けて継続したい時間を登録する
2. 日々の軌跡と継続時間を記録する
3. 目標時間に到達したらクリア。次の目標を登録しましょう！

## URL
http://app-kiseki.com

## 使用技術
- フロントエンド
	- Vue.js 2.6.12
	- jQuery 3.4.1
	- HTML/CSS/MDBootstrap

- バックエンド
	- PHP 7.4.16
	- Laravel 6.20.22
	- PHPUnit 9.5.4

- インフラ
	- CircleCI
	- Docker 20.10.5 / docker-compose 1.28.5
	- Nginx 1.12
	- MySQL 8.0.20
 	- AWS
 		- EC2
 		- RDS
 		- S3
 		- CloudFormation
 		- Route53
 		- VPC
 		- IAM

- その他
	- Sublime Text(エディタ)
	- draw.io(画面設計)
	- Photoshop(画像編集)
	- Canva(ロゴ作成)

## 機能一覧
- ユーザー登録
	- 新規登録、プロフィール編集機能
	- プロフィール画像登録機能(AWS S3)
	-	画像トリミング、保存機能(Intervention/Image)
	- ゲストログイン機能
- 目標投稿機能(CRUD)
	- 目標の新規作成、詳細表示、削除機能
- 軌跡投稿機能(CRUD)
	- 目標達成に向けての頑張り(軌跡)の新規作成、一覧表示、削除
- ページネーション機能
- 部分検索機能
	- 軌跡のタイトルや内容による検索絞り込み
- フォロー機能(非同期通信)
- いいね機能(非同期通信)
- バッジの獲得機能
	- 継続日数や時間に応じてバッジを獲得できる機能
- フラッシュメッセージ表示機能
	- 目標や軌跡の新規作成、編集、削除、バッジの獲得時にフラッシュメッセージを表示		

## アプリのクローン / アクセスの確認
$: on terminal, [app]: on app container

$ git clone https://github.com/akinoringo/app-kiseki.git

- ディレクトリへの移動
$ cd app-kiseki
- 環境設定(docker-compose)ファイルのコピー
$ cp .env-example .env

- コンテナの立ち上げ
$ docker-compose up -d

- コンテナの中に入る
$ docker-compose exec app bash

- composer インストール
[app] composer install

- 環境設定(Laravel)ファイルのコピー
[app] cp .env.example .env 

- キーの設定
[app] php artisan key:generate

- マイグレーション
[app]	php artisan migrate --seed

- storageリンクの生成
[app] php artisan storage:link

- アクセスの確認
http://localhost


## アプリ使用画面

### トップページ
<img width="700" alt="Screen Shot of kiseki's view of mypage" src="https://user-images.githubusercontent.com/73481750/117590686-a6069b80-b16b-11eb-9add-c18b6fc58ab9.png">

<img width="700" alt="Screen Shot of kiseki's view of mypage" src="https://user-images.githubusercontent.com/73481750/117590745-c6365a80-b16b-11eb-97f2-c9ad731911ea.png">

### みんなの軌跡一覧
<img width="700" alt="Screen Shot of kiseki's view of mypage" src="https://user-images.githubusercontent.com/73481750/117590766-de0dde80-b16b-11eb-970d-6c74e05ca80e.png">

### マイページ
<img width="700" alt="Screen Shot of kiseki's view of mypage" src="https://user-images.githubusercontent.com/73481750/117590790-04337e80-b16c-11eb-8631-64eed630b504.png">

### 軌跡入力画面
<img width="700" alt="Screen Shot of kiseki's view of mypage" src="https://user-images.githubusercontent.com/73481750/117590808-1ad9d580-b16c-11eb-920b-9e7288e231a0.png">

## インフラ構成図
<img width="700" alt="Cloud Image" src="https://user-images.githubusercontent.com/73481750/117590129-ee708a00-b168-11eb-80be-ef54b3f64890.png">