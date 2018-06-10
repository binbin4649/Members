
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

### （管理者側）
  - ユーザー一覧、編集
  - ログ一覧
  - ユーザー限定ブログの指定
  - ユーザー限定メールフォームの指定

## Usage

  1. ダウンロードまたは、git clone
  2. Membersフォルダを、app/Plugin/に投げ込む
  3. BaserCMSの管理画面から有効化
  4. 送信メール設定  
システム管理、サイトの基本設定のオプションを開き、メール設定関連のSMTP送信に必要事項を入力。


  - ログイン  
  http://xxx.xxx/members/mypages/login

  - 新規登録  
  http://xxx.xxx/members/mypages/signup

  - 管理画面  
  システムナビ -> Membersプラグイン
  
## Attention

  - テーマ変更で初期データ読み込むと、会員（メンバー）が全部削除されます。

## Issue

記法がバラバラだったりしてます。ごめんなさい。追々直していきます。  
基本的にはCakePHP、baserCMSの記法に従うことにします。  
見つけてプルリク貰えると嬉しいです。  


## Author

[https://dubmilli.com/](dubmilli LLC. )

## License

MIT