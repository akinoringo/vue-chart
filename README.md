# Kiseki
目標達成のための日々の頑張りを軌跡として記録するアプリです。<br>

### 使い方
1. 目標と目標達成に向けて継続したい時間を登録する
2. 日々の軌跡と継続時間を記録する
3. 目標時間に到達したらクリア。次の目標を登録しましょう！

## URL
http://app-kiseki.com

## 環境
- PHP 7.4.16
- Laravel 6.20.22
- MySQL 8.0.23
- Nginx 1.18.0
- Vue 2.6.12
- AWS
	- VPC
 	- EC2
 	- S3
	- Route53
	- ACM
	- CloudWatch
	- SNS
	- Chatbot

## アプリのインストール
$: on terminal, [app]: on app container

$ git clone https://github.com/akinoringo/laravel-kiseki.git

- ディレクトリへの移動
$ cd laravel-kiseki
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


## 機能一覧
- ユーザー登録
	- プロフィール画像登録機能
	- 画像トリミング保存機能
- 目標投稿機能(CRUD)
- 軌跡投稿機能(CRUD)
- ページネーション機能
- 部分検索機能
- フォロー機能(非同期通信)
- いいね機能(非同期通信)
- バッジの獲得機能(継続日数や時間に応じてバッジを獲得できる)


## アプリ使用画面

<img width="700" alt="Screen Shot of kiseki's view of mypage" src="https://user-images.githubusercontent.com/73481750/115630536-242b0b80-a33f-11eb-8e38-18333a4a977f.png">

## インフラ構成図
<img width="700" alt="Cloud Image" src="https://user-images.githubusercontent.com/73481750/117399222-019e1280-af3b-11eb-975b-fa5b89049446.png">