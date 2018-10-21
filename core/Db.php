<?php
include_once("config/config.php");
	/**
	* class to connect with database
	*/
	class Db extends DATABASE
	{
		var $con;
		public function connect()
		{
			$this->con = mysqli_connect($this->HOST,$this->MYSQL_USERNAME,$this->MYSQL_PASSWORD);
		}
		public function connect_db()
		{
			$this->con = mysqli_connect($this->HOST,$this->MYSQL_USERNAME,$this->MYSQL_PASSWORD,$this->DB_NAME);
		}
		public function disconnect_db()
		{
			mysqli_close($this->con);
		}
		public function db_student_list()
		{
			$this->connect_db();
			$sql="CREATE TABLE student_list(reg varchar(10) PRIMARY KEY,name varchar(30) NOT NULL)";
			mysqli_query($this->con,$sql);
			$this->disconnect_db();
		}
		public function db_create()
		{
			$this->connect();
			$sql="create database if not exists lab_management";
			mysqli_query($this->con,$sql);
			$this->disconnect_db();
		}
		public function db_conf_table()
		{
			$this->connect_db();
			$sql="create table if not exists conf_table(sys_name varchar(15) PRIMARY KEY,
			ip_addr varchar(16) UNIQUE NOT NULL,mac_addr varchar(20) UNIQUE NOT NULL,brand varchar(15) NOT NULL,
			ram varchar(6) NOT NULL,hdd varchar(6) NOT NULL,processor varchar(30) NOT NULL,os1 varchar(30) NOT NULL,
			os2 varchar(30) NOT NULL,purch_month int(2) NOT NULL,purch_year int(4) NOT NULL,user_type varchar(10) NOT NULL)";
            mysqli_query($this->con,$sql);
			$this->disconnect_db();
		}
		public function db_complaint_table()
		{
			$this->connect_db();
			$sql="create table if not exists complaint_info(complaint_id int(3) PRIMARY KEY AUTO_INCREMENT,sys_name varchar(15) NOT NULL,
			complaint_info varchar(20) NOT NULL,rec_date Date,solution varchar(30),retified_date Date,done_by varchar(16),
			status varchar(10) DEFAULT 'Not Solved',post_by varchar(10) NOT NULL,CONSTRAINT fk_sys_name FOREIGN KEY (sys_name) REFERENCES conf_table(sys_name))";
			mysqli_query($this->con,$sql);
			$this->disconnect_db();
		}
		public function db_users()
		{
			$this->connect_db();
			$sql="create table if not exists users(username varchar(10) PRIMARY KEY,name varchar(16),password varchar(16))";
			mysqli_query($this->con,$sql);
			$this->disconnect_db();
		}
		public function del_table()
		{
			$this->connect_db();
			$sql="create table if not exists del_table(sys_name varchar(15) PRIMARY KEY,
			ip_addr varchar(16) UNIQUE NOT NULL,mac_addr varchar(20) UNIQUE NOT NULL,brand varchar(15) NOT NULL,
			ram varchar(6) NOT NULL,hdd varchar(6) NOT NULL,processor varchar(30) NOT NULL,os1 varchar(30) NOT NULL,
			os2 varchar(30) NOT NULL,purch_month int(2) NOT NULL,purch_year int(4) NOT NULL,user_type varchar(10) NOT NULL)";
            mysqli_query($this->con,$sql);
			$this->disconnect_db();
		}
	};
	$create = new Db();
	$create->db_create();
	$create->db_conf_table();
	$create->db_complaint_table();
	$create->del_table();
	$create->db_users();
	$create->db_student_list();
?>
