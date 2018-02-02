// DB作成
CREATE DATABASE "cocktail-com";

// ユーザ作成
CREATE USER cocktail@localhost IDENTIFIED BY 'cocktail';
CREATE USER cocktail@'127.0.0.1' IDENTIFIED BY 'cocktail';
// 権限付与
GRANT ALL ON cocktail.* TO cocktail@localhost;
GRANT ALL ON cocktail.* TO cocktail@'127.0.0.1';

// 確認
select user, host from mysql.user;



// カクテル
create table cocktails (
  id serial,
  name varchar(64),
  search_name varchar(64),
  glass varchar(2),
  percentage varchar(2),
  color varchar(20),
  taste varchar(2),
  processes varchar(500),
  dt_create timestamp DEFAULT CURRENT_TIMESTAMP,
  primary key (id)
);
comment on column cocktails.glass is '1:ショート 2:ロング 3:ロックグラス 4:ビールグラス 5:ワイングラス 6:その他';
comment on column cocktails.percentage is '1:弱い 2:普通 3:強い';
comment on column cocktails.taste is '1:甘口 2:どちらでもない 3:中辛 4:辛口';

insert into cocktails(id, name, search_name, glass, percentage, taste) values(1, 'ジントニック', 'ｼﾞﾝﾄﾆｯｸ', 2, 1, 3);
insert into cocktails(id, name, search_name, glass, percentage, taste) values(2, 'モスコミュール', 'ﾓｽｺﾐｭｰﾙ', 2, 1, 2);
insert into cocktails(id, name, search_name, glass, percentage, taste) values(3, 'カルーアミルク', 'ｶﾙｰｱﾐﾙｸ', 3, 1, 1);
insert into cocktails(id, name, search_name, glass, percentage, taste) values(4, 'カシスオレンジ', 'ｶｼｽｵﾚﾝｼﾞ', 2, 1, 1);


// カクテル要素
create table cocktail_elements (
  id serial,
  cocktail_id int not null references cocktails(id),
  element_id int not null references elements(id),
  amount varchar(20) not null,
  dt_create timestamp DEFAULT CURRENT_TIMESTAMP,
  primary key (id)
);
insert into cocktail_elements(cocktail_id, element_id, amount) values(1, 2, '30ml');
insert into cocktail_elements(cocktail_id, element_id, amount) values(1, 10, '適量');
insert into cocktail_elements(cocktail_id, element_id, amount) values(2, 1 , '30ml');
insert into cocktail_elements(cocktail_id, element_id, amount) values(2, 11, '適量');
insert into cocktail_elements(cocktail_id, element_id, amount) values(3, 9, '30ml');
insert into cocktail_elements(cocktail_id, element_id, amount) values(3, 13, '適量');
insert into cocktail_elements(cocktail_id, element_id, amount) values(4, 7, '30ml');
insert into cocktail_elements(cocktail_id, element_id, amount) values(4, 12, '適量');


// 要素マスタ
create table elements (
  id serial,
  category_kbn varchar(4) not null,
  name varchar(64),
  dt_create timestamp DEFAULT CURRENT_TIMESTAMP,
  primary key (id)
);
comment on column elements.category_kbn is '1:スピリッツ 2:その他ベース 3:リキュール 4:ノンアルコール';

insert into elements(id, category_kbn, name) values(1, 1, 'ウォッカ');
insert into elements(id, category_kbn, name) values(2, 1, 'ジン');
insert into elements(id, category_kbn, name) values(3, 1, 'テキーラ');
insert into elements(id, category_kbn, name) values(4, 1, 'ラム');
insert into elements(id, category_kbn, name) values(5, 2, 'ウィスキー');
insert into elements(id, category_kbn, name) values(6, 2, 'バーボン');
insert into elements(id, category_kbn, name) values(7, 3, 'カシス');
insert into elements(id, category_kbn, name) values(8, 3, 'ピーチ');
insert into elements(id, category_kbn, name) values(9, 3, 'カルーア');
insert into elements(id, category_kbn, name) values(10, 4, 'トニックウォータ');
insert into elements(id, category_kbn, name) values(11, 4, 'ジンジャーエール');
insert into elements(id, category_kbn, name) values(12, 4, 'オレンジジュース');
insert into elements(id, category_kbn, name) values(13, 4, '牛乳');


// カクテルタグ
create table cocktail_tags (
    id serial,
    cocktail_id int not null references cocktails(id),
    tag_id varchar(20),
    dt_create timestamp DEFAULT CURRENT_TIMESTAMP,
    primary key (id)
);
insert into cocktail_tags(id, cocktail_id, tag_id) values(1, 1, 1);
insert into cocktail_tags(id, cocktail_id, tag_id) values(2, 1, 2);
insert into cocktail_tags(id, cocktail_id, tag_id) values(3, 2, 1);
insert into cocktail_tags(id, cocktail_id, tag_id) values(4, 3, 2);
insert into cocktail_tags(id, cocktail_id, tag_id) values(5, 3, 3);

// タグマスタ
create table tags (
    id serial,
    name varchar(30),
    dt_create timestamp DEFAULT CURRENT_TIMESTAMP,
    primary key (id)
);
insert into tags(id, name) values(1, '男らしい');
insert into tags(id, name) values(2, '酔いたい日の');
insert into tags(id, name) values(3, '夏らしい');
insert into tags(id, name) values(4, '冬っぽい');
insert into tags(id, name) values(5, '夜景が似合う');

// 管理者
create table admins (
  id serial not null,
  login_id varchar(32),
  password varchar(32),
  dt_create timestamp DEFAULT CURRENT_TIMESTAMP,
  primary key (id)
);
insert into admins(id, login_id, password) values(1, 'admin', '');
