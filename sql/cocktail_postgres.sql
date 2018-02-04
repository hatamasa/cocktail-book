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

insert into cocktails(id, name, search_name, glass, percentage, taste) values(nextval('cocktails_id_seq'), 'ジントニック', 'ｼﾞﾝﾄﾆｯｸ', 2, 1, 3);
insert into cocktails(id, name, search_name, glass, percentage, taste) values(nextval('cocktails_id_seq'), 'モスコミュール', 'ﾓｽｺﾐｭｰﾙ', 2, 1, 2);
insert into cocktails(id, name, search_name, glass, percentage, taste) values(nextval('cocktails_id_seq'), 'カルーアミルク', 'ｶﾙｰｱﾐﾙｸ', 3, 1, 1);
insert into cocktails(id, name, search_name, glass, percentage, taste) values(nextval('cocktails_id_seq'), 'カシスオレンジ', 'ｶｼｽｵﾚﾝｼﾞ', 2, 1, 1);


// カクテル要素
create table cocktails_elements (
  id serial,
  cocktail_id int not null,
  element_id int not null,
  amount varchar(20) not null,
  dt_create timestamp DEFAULT CURRENT_TIMESTAMP,
  primary key (id)
);
insert into cocktails_elements(id, cocktail_id, element_id, amount) values(nextval('cocktails_elements_id_seq'), 1, 2, '30ml');
insert into cocktails_elements(id, cocktail_id, element_id, amount) values(nextval('cocktails_elements_id_seq'), 1, 10, '適量');
insert into cocktails_elements(id, cocktail_id, element_id, amount) values(nextval('cocktails_elements_id_seq'), 2, 1 , '30ml');
insert into cocktails_elements(id, cocktail_id, element_id, amount) values(nextval('cocktails_elements_id_seq'), 2, 11, '適量');
insert into cocktails_elements(id, cocktail_id, element_id, amount) values(nextval('cocktails_elements_id_seq'), 3, 9, '30ml');
insert into cocktails_elements(id, cocktail_id, element_id, amount) values(nextval('cocktails_elements_id_seq'), 3, 13, '適量');
insert into cocktails_elements(id, cocktail_id, element_id, amount) values(nextval('cocktails_elements_id_seq'), 4, 7, '30ml');
insert into cocktails_elements(id, cocktail_id, element_id, amount) values(nextval('cocktails_elements_id_seq'), 4, 12, '適量');


// 要素マスタ
create table elements (
  id serial,
  category_kbn varchar(4) not null,
  name varchar(64) not null,
  dt_create timestamp DEFAULT CURRENT_TIMESTAMP,
  primary key (id)
);
comment on column elements.category_kbn is '1:スピリッツ 2:その他ベース 3:リキュール 4:ノンアルコール';

insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 1, 'ウォッカ');
insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 1, 'ジン');
insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 1, 'テキーラ');
insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 1, 'ラム');
insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 2, 'ウィスキー');
insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 2, 'バーボン');
insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 3, 'カシス');
insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 3, 'ピーチ');
insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 3, 'カルーア');
insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 4, 'トニックウォータ');
insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 4, 'ジンジャーエール');
insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 4, 'オレンジジュース');
insert into elements(id, category_kbn, name) values(nextval('elements_id_seq'), 4, '牛乳');


// カクテルタグ
create table cocktails_tags (
    id serial,
    cocktail_id int not null,
    tag_id int,
    dt_create timestamp DEFAULT CURRENT_TIMESTAMP,
    primary key (id)
);
insert into cocktails_tags(id, cocktail_id, tag_id) values(nextval('cocktails_tags_id_seq'), 1, 1);
insert into cocktails_tags(id, cocktail_id, tag_id) values(nextval('cocktails_tags_id_seq'), 1, 2);
insert into cocktails_tags(id, cocktail_id, tag_id) values(nextval('cocktails_tags_id_seq'), 2, 1);
insert into cocktails_tags(id, cocktail_id, tag_id) values(nextval('cocktails_tags_id_seq'), 3, 2);
insert into cocktails_tags(id, cocktail_id, tag_id) values(nextval('cocktails_tags_id_seq'), 3, 3);

// タグマスタ
create table tags (
    id serial,
    name varchar(30) not null,
    dt_create timestamp DEFAULT CURRENT_TIMESTAMP,
    primary key (id)
);
insert into tags(id, name) values(nextval('tags_id_seq'), '男らしい');
insert into tags(id, name) values(nextval('tags_id_seq'), '酔いたい日の');
insert into tags(id, name) values(nextval('tags_id_seq'), '夏らしい');
insert into tags(id, name) values(nextval('tags_id_seq'), '冬っぽい');
insert into tags(id, name) values(nextval('tags_id_seq'), '夜景が似合う');

// 管理者
create table admins (
  id serial not null,
  login_id varchar(32),
  password varchar(32),
  dt_create timestamp DEFAULT CURRENT_TIMESTAMP,
  primary key (id)
);
insert into admins(id, login_id, password) values(nextval('admins_id_seq'), 'admin', '');

// テーブル削除
drop table cocktails;
drop table cocktails_elements;
drop table cocktails_tags;
drop table elements;
drop table tags;
drop table admins;