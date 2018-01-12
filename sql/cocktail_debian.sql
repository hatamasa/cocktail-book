// DB作成
CREATE DATABASE cocktail;

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
  id int(4) not null auto_increment,
  name varchar(64),
  search_name varchar(64),
  glass varchar(2),
  percentage varchar(2),
  color varchar(20),
  taste varchar(2),
  processes varchar(500),
  author_id varchar(4),
  dt_create datetime DEFAULT CURRENT_TIMESTAMP,
  dt_update datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  primary key (id)
);
insert into cocktails(id, name, search_name, glass, percentage, taste, author_id) values(1, 'gintonic', '', 2, 1, 3, 1);
insert into cocktails(id, name, search_name, glass, percentage, taste, author_id) values(2, 'mosco', '', 2, 1, 2, 1);
insert into cocktails(id, name, search_name, glass, percentage, taste, author_id) values(3, 'khala', '', 3, 1, 1, 1);
insert into cocktails(id, name, search_name, glass, percentage, taste, author_id) values(4, 'casis', '', 2, 1, 1, 1);


// カクテル要素
create table cocktail_elements (
  id int(4) not null auto_increment,
  cocktails_id int(4) not null,
  elements_id int(4) not null,
  amount varchar(20) not null,
  dt_create datetime DEFAULT CURRENT_TIMESTAMP,
  dt_update datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  primary key (id),
  constraint foreign key(cocktails_id) references cocktails(id),
  constraint foreign key(elements_id) references elements(id)
);
insert into cocktail_elements(cocktails_id, elements_id, amount) values(1, 2, '30ml');
insert into cocktail_elements(cocktails_id, elements_id, amount) values(1, 10, 'just');
insert into cocktail_elements(cocktails_id, elements_id, amount) values(2, 1 , '30ml');
insert into cocktail_elements(cocktails_id, elements_id, amount) values(2, 11, 'just');
insert into cocktail_elements(cocktails_id, elements_id, amount) values(3, 9, '30ml');
insert into cocktail_elements(cocktails_id, elements_id, amount) values(3, 13, 'just');
insert into cocktail_elements(cocktails_id, elements_id, amount) values(4, 7, '30ml');
insert into cocktail_elements(cocktails_id, elements_id, amount) values(4, 12, 'just');


// 要素マスタ
create table elements (
  id int(4) not null auto_increment,
  category_kbn varchar(4) not null,
  name varchar(64),
  dt_create datetime DEFAULT CURRENT_TIMESTAMP,
  dt_update datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  primary key (id)
);
insert into elements(id, category_kbn, name) values(1, 1, 'vocha');
insert into elements(id, category_kbn, name) values(2, 1, 'gin');
insert into elements(id, category_kbn, name) values(3, 1, 'techela');
insert into elements(id, category_kbn, name) values(4, 1, 'rum');
insert into elements(id, category_kbn, name) values(5, 2, 'vische');
insert into elements(id, category_kbn, name) values(6, 2, 'barbon');
insert into elements(id, category_kbn, name) values(7, 3, 'casis');
insert into elements(id, category_kbn, name) values(8, 3, 'peche');
insert into elements(id, category_kbn, name) values(9, 3, 'kaluha');
insert into elements(id, category_kbn, name) values(10, 4, 'tonicwater');
insert into elements(id, category_kbn, name) values(11, 4, 'gingierale');
insert into elements(id, category_kbn, name) values(12, 4, 'orangejuice');
insert into elements(id, category_kbn, name) values(13, 4, 'milk');


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
