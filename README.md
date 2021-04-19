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
- AWS
 - VPC
 - EC2
 - Route53

## アプリのインストール
$: on terminal, [app]: on app container

$ git clone https://github.com/akinoringo/laravel-kiseki.git

$ docker-compose up -d

- コンテナの中に入る
$ docker-compose exec app bash

- composer インストール
[app] composer install

- キーの設定
[app] php artisan key:generate

- storageリンクの生成
[app] php artisan storage:link

- アクセスの確認
http://localhost:80


## 機能一覧
- ユーザー登録
 - プロフィール画像登録機能
 - 画像トリミング保存機能
- 目標投稿機能(CRUD)
- 軌跡投稿機能(CRUD)
- ページネーション機能
- 部分検索機能

<img width="600" alt="Screen Shot of kiseki's view of mypage" src="https://user-images.githubusercontent.com/73481750/115177084-6408ad80-a109-11eb-9538-c38553fcab55.png">

## インフラ構成図
<img width="600" alt="Cloud Image" src="https://user-images.githubusercontent.com/73481750/115180618-07a98c00-a111-11eb-92c1-638d96a9cdc6.png">