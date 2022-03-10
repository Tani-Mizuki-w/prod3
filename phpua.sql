create table ww_login(
  uid serial primary key,
  uname text not null,
  email text not null,
  password text not null) without oids;

create table ww_profile(
  /*ユーザーid*/
  uid serial primary key,
  /*ユーザー名*/
  uname text,
  /*自己紹介・一言*/
  word text
)without oids;

create table ww_post(
  /*投稿id*/
  pid serial primary key,
  /*ユーザーid*/
  uid int,
  /*ユーザー名*/
  uname text,
  /*内容*/
  content text,
  /*投稿日時*/
  send_time timestamp
)without oids;

create table ww_message(
  message_id serial,
  pid int,
  message_text text,
  send_name text,
  receive_name text
)without oids;

create table ww_follow(
  fid serial primary key,
  my_id int,
  your_id int
)without oids;
