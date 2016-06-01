DROP DATABASE IF EXISTS pis;
CREATE DATABASE pis CHARACTER SET = utf8mb4;

USE pis;

CREATE TABLE track_device (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  sn CHAR(32) NOT NULL COMMENT '单据编号',
  device_type CHAR(16) NOT NULL DEFAULT '' COMMENT '设备类型',
  device_name CHAR(128) NOT NULL DEFAULT '' COMMENT '设备名称',
  device_model CHAR(128) NOT NULL DEFAULT '' COMMENT '设备型号',
  device_sn CHAR(128) NOT NULL DEFAULT '' COMMENT '设备编号',
  device_amount CHAR(32) NOT NULL DEFAULT '' COMMENT '设备数量',
  owner_inc CHAR(64) NOT NULL DEFAULT '' COMMENT '业主公司',
  owner_contact VARCHAR(256) NOT NULL DEFAULT '' COMMENT '(业主公司)联系人及电话',
  work_order CHAR(128) NOT NULL DEFAULT '' COMMENT '工令号',
  setup_address CHAR(128) NOT NULL DEFAULT '' COMMENT '安装地址',
  use_person_contact VARCHAR(256) NOT NULL DEFAULT '' COMMENT '(使用人)联系人及电话',
  company_principle CHAR(128) NOT NULL DEFAULT '' COMMENT '公司负责人',
  insite_time CHAR(64) NOT NULL DEFAULT '' COMMENT '进场时间',
  start_time CHAR(64) NOT NULL DEFAULT '' COMMENT '动工时间',
  use_time CHAR(64) NOT NULL DEFAULT '' COMMENT '使用时间',
  accept_time CHAR(64) NOT NULL DEFAULT '' COMMENT '验收时间',
  UNIQUE KEY uk_device_type_device_sn(device_type, device_sn)
) ENGINE = Innodb DEFAULT CHARACTER SET = UTF8MB4;

CREATE TABLE track_user (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name CHAR(32) NOT NULL DEFAULT '' COMMENT '用户名',
  passwd CHAR(32) NOT NULL DEFAULT '' COMMENT '密码',
  role CHAR(16),
  INDEX idx_uname(name)
) ENGINE = Innodb DEFAULT CHARACTER SET = UTF8MB4;

CREATE TABLE track_setup_record (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  device_id INT NOT NULL COMMENT '关联的设备',
  company CHAR(128) NOT NULL DEFAULT '' COMMENT '参与单位',
  job_content VARCHAR(1024) NOT NULL DEFAULT '' COMMENT '工作内容',
  locale_owner_contact VARCHAR(256) NOT NULL DEFAULT '' COMMENT '现场负责人及电话',
  remark VARCHAR(1024) NOT NULL DEFAULT '' COMMENT '备注',
  INDEX idx_device_id(device_id)
) ENGINE = Innodb DEFAULT CHARACTER SET = UTF8MB4;

CREATE TABLE track_product_record (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  device_id INT NOT NULL COMMENT '关联的设备',
  name CHAR(128) NOT NULL DEFAULT '' COMMENT '名称',
  specification CHAR(128) NOT NULL DEFAULT '' COMMENT '规格/型号',
  amount CHAR(32) NOT NULL DEFAULT '' COMMENT '数量',
  company CHAR(128) NOT NULL DEFAULT '' COMMENT '生产厂家',
  contact VARCHAR(256) NOT NULL DEFAULT '' COMMENT '联系人及电话',
  remark VARCHAR(1024) NOT NULL DEFAULT '' COMMENT '备注',
  INDEX idx_device_id(device_id)
) ENGINE = Innodb DEFAULT CHARACTER SET = UTF8MB4;

CREATE TABLE track_service_record (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  device_id INT NOT NULL COMMENT '关联的设备',
  report_time CHAR(64) NOT NULL DEFAULT '' COMMENT '报修时间',
  issue VARCHAR(1024) NOT NULL DEFAULT '' COMMENT '问题描述',
  owner VARCHAR(128) NOT NULL DEFAULT '' COMMENT '责任人',
  fix_time CHAR(64) NOT NULL DEFAULT '' COMMENT '修复时间',
  result VARCHAR(1024) NOT NULL DEFAULT '' COMMENT '判定结果',
  INDEX idx_device_id(device_id)
) ENGINE = Innodb DEFAULT CHARACTER SET = UTF8MB4;

CREATE TABLE track_process_record (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  device_id INT NOT NULL COMMENT '关联的设备',
  time CHAR(64) NOT NULL DEFAULT '' COMMENT '时间',
  content VARCHAR(1024) NOT NULL DEFAULT '' COMMENT '工作内容',
  issue VARCHAR(1024) NOT NULL DEFAULT '' COMMENT '困难及问题',
  remark VARCHAR(1024) NOT NULL DEFAULT '' COMMENT '备注',
  sign CHAR(128) NOT NULL DEFAULT '' COMMENT '签字',
  INDEX idx_device_id(device_id)
) ENGINE = Innodb DEFAULT CHARACTER SET = UTF8MB4;

INSERT INTO track_user VALUES(1, 'admin', 'admin', '管理员');
