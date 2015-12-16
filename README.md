
# BaserCMS用　会員管理プラグイン

  1. ユーザーが新規登録する -> 仮登録  
  2. 認証メールを送る  
  3. 認証URLクリック -> 本登録  
  4. ログイン  
  
という流れの、新しいテーブルを追加して会員管理するタイプのプラグインです。  

BaserCMS  
https://github.com/baserproject/basercms


## Functions

### （ユーザー側）
  - アカウント登録
  - メール認証
  - ログイン、ログアウト、パスワード忘れた方はこちらへ
  - ユーザー編集
  - ユーザー限定ブログの回覧
  - ユーザー限定メールフォームの回覧

### （管理者側）
  - ユーザー一覧、編集
  - ログ一覧
  - ユーザー限定ブログの指定
  - ユーザー限定メールフォームの指定

## Usage

  1. ダウンロードまたは、git clone
  2. Membersフォルダを、app/Plugin/に投げ込む
  3. BaserCMSの管理画面から有効化

  - ログイン  
  http://xxx.xxx/members/Mypages/login

  - 新規登録  
  http://xxx.xxx/members/Mypages/signup

  - 管理画面  
  システムナビ -> Membersプラグイン
  

## Support BaserCMS Version

  - 3.0.9
  - 3.1.0-dev


## Roadmap

  - 0.0.1 クソ仕様のクソコードでもいい。とりあえず動かす。
  - 0.5.0 仕様固めて、テスト書きたい。
  - 0.6.0 リファクタリング
  - 1.0.0 一般的にも使えるようになるんだと思う。

## Issue

  - 限定メールフォームでMailFieldにも追従して、ほとんどの項目を自動入力
  - autozip使えるようにしたい
  - 都道府県リストをとりたい(ハック途中で挫折した)
  - sessionとcookieが同居してる?(いいのかこれ？)


## Anything Else

このプラグイン自体をカスタマイズして使うことを想定しています。  
会員管理って色んな形態があると思うのですが、そのベースになれば良いなーと思います。  
目標はBaserCMSのXOOPS化ですｗ  
需要があったらゆっくりやります。  

## Author

Hideichi Saito (binbin4649)

## License

BaserCMSのライセンスに従う。（よく分からないので、）