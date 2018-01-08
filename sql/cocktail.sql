// カクテル
create table cocktails (
  id int(4) not null auto_increment,
  name varchar(64),
  glass varchar(2) comment '1:ショート 2:ロング 3:ロックグラス 4:ビールグラス 5:ワイングラス 6:その他',
  percentage varchar(2) comment '1:弱い 2:普通 3:強い',
  color varchar(20),
  taste varchar(2) comment '1:甘口 2:どちらでもない 3:中辛 4:辛口',
  processes varchar(500) comment '作成手順',
  author_id varchar(4) comment 'users.id',
  dt_create datetime DEFAULT CURRENT_TIMESTAMP,
  dt_update datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  primary key (id)
);
insert into cocktails(id, name, glass, percentage, taste, author_id) values(1, 'ジントニック', 2, 1, 3, 1);
insert into cocktails(id, name, glass, percentage, taste, author_id) values(2, 'モスコミュール', 2, 1, 2, 1);
insert into cocktails(id, name, glass, percentage, taste, author_id) values(3, 'カルーアミルク', 3, 1, 1, 1);
insert into cocktails(id, name, glass, percentage, taste, author_id) values(4, 'カシスオレンジ', 2, 1, 1, 1);


// カクテル要素
create table cocktail_elements (
  id int(4) not null auto_increment,
  cocktail_id varchar(4) not null comment 'cocktails.id',
  element_id varchar(4) not null comment 'mst_elements.id',
  amount varchar(20) not null comment '分量',
  dt_create datetime DEFAULT CURRENT_TIMESTAMP,
  dt_update datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
create table mst_elements (
  id int(4) not null auto_increment,
  category_kbn varchar(4) not null comment '1:スピリッツ 2:その他ベース 3:リキュール 4:ノンアルコール',
  name varchar(64),
  dt_create datetime DEFAULT CURRENT_TIMESTAMP,
  dt_update datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  primary key (id)
);
insert into mst_elements(id, category_kbn, name) values(1, 1, 'ウォッカ');
insert into mst_elements(id, category_kbn, name) values(2, 1, 'ジン');
insert into mst_elements(id, category_kbn, name) values(3, 1, 'テキーラ');
insert into mst_elements(id, category_kbn, name) values(4, 1, 'ラム');
insert into mst_elements(id, category_kbn, name) values(5, 2, 'ウィスキー');
insert into mst_elements(id, category_kbn, name) values(6, 2, 'バーボン');
insert into mst_elements(id, category_kbn, name) values(7, 3, 'カシス');
insert into mst_elements(id, category_kbn, name) values(8, 3, 'ピーチ');
insert into mst_elements(id, category_kbn, name) values(9, 3, 'カルーア');
insert into mst_elements(id, category_kbn, name) values(10, 4, 'トニックウォータ');
insert into mst_elements(id, category_kbn, name) values(11, 4, 'ジンジャーエール');
insert into mst_elements(id, category_kbn, name) values(12, 4, 'オレンジジュース');
insert into mst_elements(id, category_kbn, name) values(13, 4, '牛乳');


// ユーザ
create table users (
  id int(4) not null auto_increment,
  name varchar(64),
  user_mail varchar(64),
  password varchar(64),
  dt_create datetime DEFAULT CURRENT_TIMESTAMP,
  dt_update datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  primary key (id)
);
insert into users(id, name, user_mail, password) values(1, 'masaya', '', '');
