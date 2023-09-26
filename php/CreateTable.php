<?php
//Referece the source code provided in the lecture to create needed tables

$server = "localhost";
$user = "root";
if (!empty($_POST['rootPW']))
	$pw = $_POST['rootPW'];
elseif ($_POST['server'] =="mamp")
	$pw = "root";
else 
	$pw = ""; // by default xammp root user has no password

$db = "lostandfound";

$connect=mysqli_connect($server, $user, $pw, $db);

if(!$connect) {
	die("ERROR: Cannot connect to database $db on server $server 
	using user name $user (".mysqli_connect_errno().
	", ".mysqli_connect_error().")");
}


$createAccount="GRANT ALL PRIVILEGES ON lostandfound.* TO 'wbip'@'localhost' IDENTIFIED BY 'wbip123' WITH GRANT OPTION";

$dropAccountTable = "DROP TABLE IF EXISTS Account";
$createAccountTable = "CREATE TABLE Account (
  ID varchar(64) NOT NULL,
  Password varchar(64) NOT NULL,
  Role varchar(64) NOT NULL,
  Token int,
  PRIMARY KEY (ID),
  UNIQUE KEY ID (ID)
 ) ENGINE='MyISAM'  DEFAULT CHARSET='latin1'";

$addAccountRecords ="REPLACE INTO Account VALUES
('1', '1', 0,null),
('2', '2', 0,null),
('3', '3', 0,null),
('4', '4', 0,null),
('5', '5', 0,null),
('6', '6', 0,null),
('123', '123', 0,null),
('admin','adminpass',1,null);";


$dropUserTable = "DROP TABLE IF EXISTS UserInfo";
$createUserTable = "CREATE TABLE UserInfo (
  UserID varchar(64) NOT NULL,
  NickName varchar(64) NOT NULL,
  Email varchar(64) NOT NULL, 
  ProfileImage varchar(64) NOT NULL,
  Gender int NOT NULL,
  Birthday date NOT NULL,
  PRIMARY KEY (UserID),
  UNIQUE KEY UserID (UserID),
  CONSTRAINT fk_UserID FOREIGN KEY (UserID)
  REFERENCES Account(ID)
  ON DELETE CASCADE
  ON UPDATE CASCADE
 ) ENGINE='MyISAM'  DEFAULT CHARSET='latin1'";

$addUserRecords ="REPLACE INTO UserInfo (UserID, NickName, Email, ProfileImage,Gender,Birthday) VALUES
('1', 'Jack', '571532474@qq.com', '../UploadImg/1.jpg',0,'1953-02-09'),
('2', 'Mike', '78912345@qq.com', '../UploadImg/2.jpg',0,'1962-01-19'),
('3', 'Joe', '5201314@qq.com', '../UploadImg/3.jpg',1,'1990-12-29'),
('4', 'Julie', '770625@qq.com', '../UploadImg/4.jpg',1,'1987-07-16'),
('5', 'Burton', '1149423@qq.com', '../UploadImg/5.jpg',0,'2012-04-09'),
('6', 'Mary', '87909213@qq.com', '../UploadImg/6.jpg',1,'2000-01-07'),
('123', 'Jay Chou', '20084595d@connect.polyu.hk', '../UploadImg/Jay.jpg',0,'2002-04-07');";

$dropNoticeTable = "DROP TABLE IF EXISTS Notice";
$createNoticeTable = "CREATE TABLE Notice (
  NoticeID varchar(20) NOT NULL,
  UserID varchar(64) NOT NULL,
  Type int NOT NULL,
  Date timestamp NOT NULL,
  Venue varchar(64) NOT NULL,
  Contact varchar(64) NOT NULL,
  Description varchar(200) NOT NULL,
  Image varchar(64) NOT NULL,
  Status int NOT NULL,
  PRIMARY KEY (NoticeID),
  UNIQUE KEY NoticeID (NoticeID),
  CONSTRAINT fk_UserID FOREIGN KEY (UserID)
  REFERENCES UserInfo(UserID)
  ON DELETE CASCADE
  ON UPDATE CASCADE
 ) ENGINE=MyISAM  DEFAULT CHARSET=latin1";

$addNoticeRecords ="REPLACE INTO Notice VALUES
('N1','1', 0, '2019-01-18', 'VA Canteen', '67759521', 'I left my brown wallet on the canteen desk at arround 6 p.m.','../UploadItemImg/1.jpg',0),
('N2','2', 1, '2020-02-18', 'Core A', '18520228726', 'I found a black wallet at Core A at arround 3 p.m.','../UploadItemImg/2.jpg',0),
('N3','3', 0, '2020-02-20', 'PAO Yue-kong Library', '12310228726', 'I left my black umbrella on the fifth floor of the library. ','../UploadItemImg/3.jpg',0),
('N4','4', 1, '2020-02-21', 'PAO Yue-kong Library', '58762302', 'I found a pair of glasses on a desk on the first floor of the library.','../UploadItemImg/4.jpg',0),
('N5','5', 0, '2020-09-18', 'Block M', '123452231', 'I left my necklace on the thrid floor of Block M.','../UploadItemImg/5.jpg',0),
('N6','6', 1, '2021-04-18', 'VA Canteen', '77089985', 'Whose green bottle? I found it when I was eating at the canteen. ','../UploadItemImg/6.jpg',0),
('N7','1', 0, '2021-02-14', 'CD512', '67759521', 'I forgot to take my earphone with me after the class in CD512.','../UploadItemImg/7.jpg',0),
('N8','2', 1, '2022-01-01', 'DE604', '18520228726', 'I found a cup in DE604 at arround 6 p.m.','../UploadItemImg/8.jpg',0),
('N9','3', 0, '2022-01-05', 'Li Ka Shing Tower', '12310228726', 'Is anyone see my watch? I lost it in the Li Ka Shing Tower.','../UploadItemImg/9.jpg',0),
('N10','4', 1, '2022-01-18', 'FJ304', '58762302', 'I found a blue bag in FJ304.','../UploadItemImg/10.jpg',0),
('N11','5', 0, '2022-01-19', 'FJ301', '123452231', 'I forgot to take my bottle after the lecture.','../UploadItemImg/11.jpg',0),
('N12','6', 1, '2022-05-16', 'PAO Yue-kong Library', '77089985', 'I found a lipstick on the table.','../UploadItemImg/12.jpg',0),
('N13','123', 0, '2022-06-12', 'Z302', '23145213', 'I lost a book named Milk And Honey.','../UploadItemImg/13.jpg',0),
('N14','123', 1, '2022-08-21', 'VA Canteen', '23145213', 'I found a pair of pink glasses at arround 1 p.m. when I was eating at the canteen','../UploadItemImg/14.jpg',0);";



$dropResponseTable = "DROP TABLE IF EXISTS Response";
$createResponseTable = "CREATE TABLE Response (
  NoticeID varchar(20) NOT NULL,
  Response varchar(200) NOT NULL,
  ToUserID varchar(64) NOT NULL,
  ByUserID varchar(64) NOT NULL,
  ResTime timestamp NOT NULL,
  PRIMARY KEY (NoticeID),
  UNIQUE KEY NoticeID (NoticeID),
  CONSTRAINT fk_ToUserID FOREIGN KEY (ToUserID)
  REFERENCES UserInfo(UserID)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  CONSTRAINT fk_ByUserID FOREIGN KEY (ByUserID)
  REFERENCES UserInfo(UserID)
  ON DELETE CASCADE
  ON UPDATE CASCADE
 ) ENGINE=MyISAM  DEFAULT CHARSET=latin1";

// $addResponseRecords ="REPLACE INTO Response VALUES
// ('12345','I found your pocket, please contact me:123456','123', '234', '2020-01-19:23:15:23');";


$result = mysqli_query($connect, $createAccount);
if (!$result) 
{
	die("Could not successfully run query ($createAccount) from $db: " .mysqli_error($connect) );
}
else{
	$result = mysqli_query($connect, $dropUserTable);
	if (!$result){
		die("Could not successfully run query ($dropUserTable) from $db: " . mysqli_error($connect) );
	}else  {
		$result = mysqli_query($connect, $createUserTable);
		if (!$result) {
			die("Could not successfully run query ($createUserTable) from $db: " .mysqli_error($connect) );
		}
		else{
			$result = mysqli_query($connect, $addUserRecords);
			if (!$result) {
				die("Could not successfully run query ($addUserRecords) from $db: " .mysqli_error($connect) );
			}else {
				$result = mysqli_query($connect, $dropNoticeTable);
				if (!$result) {
					die("Could not successfully run query ($dropNoticeTable) from $db: " .mysqli_error($connect) );
				}else {
					$result = mysqli_query($connect, $createNoticeTable);
					if (!$result) {
						die("Could not successfully run query ($createNoticeTable) from $db: " .mysqli_error($connect) );
					}else {
						$result = mysqli_query($connect, $addNoticeRecords);
						if (!$result) {
							die("Could not successfully run query ($addNoticeRecords) from $db: " .mysqli_error($connect) );
						}else {
							$result = mysqli_query($connect, $dropResponseTable);
							if(!$result){
								die("Could not successfully run query ($dropResponseTable) from $db: " .mysqli_error($connect) );
							}else{
								$result = mysqli_query($connect, $createResponseTable);
								if (!$result) {
									die("Could not successfully run query ($createResponseTable) from $db: " .mysqli_error($connect) );
								}else {
									// $result = mysqli_query($connect, $addResponseRecords);
									// if(!$result){
									// 	die("Could not successfully run query ($addResponseRecords) from $db: " .mysqli_error($connect) );
									// }else{
										$result = mysqli_query($connect, $dropAccountTable);
										if (!$result) {
											die("Could not successfully run query ($dropAccountTable) from $db: " .mysqli_error($connect) );
										}else{
											$result = mysqli_query($connect, $createAccountTable);
											if (!$result) {
												die("Could not successfully run query ($createAccountTable) from $db: " .mysqli_error($connect) );
											}else {
												$result = mysqli_query($connect, $addAccountRecords);
												if(!$result){
													die("Could not successfully run query ($addAccountRecords) from $db: " .mysqli_error($connect) );
												}else{
													print("<html><head><title>MySQL Setup</title></head>
													<body><h1>MySQL Setup: SUCCESS!</h1><p>Created MySQL user <strong>wbip</strong> with 
													password <strong>wbip123</strong>, with all privileges on the 
													<strong>lostandfound</strong> database.</p><p>Created tables <strong>User</strong> 
													and <strong>Notice</strong> in the 
													<strong>lostandfound</strong> database.</p>
													</body></html>");
												}
											}
										}
										
									// }
								}
							}
						}
					}
				}
			}
		}
	}
}

mysqli_close($connect);   // close the connection
 
?>

