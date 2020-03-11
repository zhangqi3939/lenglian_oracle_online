<?php
namespace app\datasys\controller;
use think\Controller;
use think\Db;
use app\datasys\model\DatasysModel;
/**
 * 
 */
class Datasys extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	function getDataFromMysql(){

		$dm = new DatasysModel();

		$latestId = $dm->getLatestId();
		// echo $latestId;
		// die();
		$mysqlDataStr = curl_post(
			'http://thtest.qianbitou.com/s/device_data_by_id',
			['id'=>$latestId+1]
		);
		$dataJson = json_decode($mysqlDataStr);
		
		if(empty($dataJson) || $dataJson->code != "200"){
			var_export($dataJson);
			die();
		}
		$dm->saveToOracle($dataJson->result);
		//var_dump($dataJson->result);
		echo '传输数据：',count($dataJson->result),'条,最新ＩＤ：';
		echo $dm->getLatestId('latestId');
	}
	function test(){
		//$redis = new \Redis();
		//$redis->connect("127.0.0.1",6379);
		//$redis->geoadd('cityGeo','116.405285', '39.904989',"beijing");
		//$redis->geoadd('cityGeo','121.472644', '31.231706',"shanghai");
		//$redis->geoadd('cityGeo','116.405285', '39.804989',"beijing");
		// geoadd cityGeo 116.405285 39.904989 "北京"
		// geoadd cityGeo 121.472644 31.231706 "上海"
		//var_dump($redis->geopos('cityGeo','beijing'));
		// echo '<br/>';
		// echo $redis->hget('hash1','key2');
		//echo 'aaa<br/>';
		$sql = 'CREATE SEQUENCE SCOTT.DATA_20191101_SEQ MINVALUE 1 MAXVALUE 99999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER NOCYCLE';
		$sql2='
CREATE TABLE "SCOTT"."ZJ_DATA_20191101" 
   (
	"ID" NUMBER(10,0),
	"BOX_ID" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"PROJECT_ID" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"LONGITUDE" FLOAT(30) DEFAULT 0 NOT NULL ENABLE, 
	"LATITUDE" FLOAT(30) DEFAULT 0 NOT NULL ENABLE, 
	"SPEED" FLOAT(30) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_OFF_FLAG" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"AMBIENT_TEMP" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_VOLTAGE" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_OIL_LEVEL" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"RE_AIR_TEMP" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"OUT_AIR_TEMP" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"OIL_TEMP" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_SET_TEMP" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"ZONE_STATUS_USED" NUMBER(11,0) DEFAULT 0 NOT NULL ENABLE, 
	"ZONE_STATUS" NUMBER(11,0) DEFAULT 0 NOT NULL ENABLE, 
	"ZONE_ALARM_CODE" NUMBER(11,0) DEFAULT 0 NOT NULL ENABLE, 
	"ZONE_OTHER_INFO" NUMBER(11,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_CNT" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE1" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL1" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE2" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL2" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE3" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL3" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE4" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL4" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE5" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL5" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE6" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL6" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE7" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL7" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE8" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL8" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE9" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL9" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE10" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL10" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE11" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL11" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE12" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL12" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_VALUE13" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_ALARM_LEVEL13" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_MID" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"COOLER_MAKE_NUM" VARCHAR2(10) DEFAULT NULL, 
	"COOLER_MODEL_NUM" VARCHAR2(15) DEFAULT NULL, 
	"COOLER_SERIAL_NUM" VARCHAR2(15) DEFAULT NULL, 
	"SOFTWARE" VARCHAR2(15) DEFAULT NULL, 
	"POWER_ON_HOUR" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"WORK_HOUR" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"ENGINE_HOUR" NUMBER(10,0) DEFAULT 0 NOT NULL ENABLE, 
	"REEFEE_INFO" VARCHAR2(15) DEFAULT NULL, 
	"COOLER_IDENTIFY" VARCHAR2(10) DEFAULT NULL, 
	"GPS_VOLTAGE" NUMBER(10,0) DEFAULT 0, 
	"GPS_OIL_LEVEL" NUMBER(10,0) DEFAULT 0, 
	"GPS_HUMI" NUMBER(10,0) DEFAULT 0, 
	"GPS_TEMP1" NUMBER(10,0) DEFAULT 0, 
	"GPS_TEMP2" NUMBER(10,0) DEFAULT 0, 
	"GPS_TEMP3" NUMBER(10,0) DEFAULT 0, 
	"GPS_TEMP4" NUMBER(10,0) DEFAULT 0, 
	"GPS_DOOR1" NUMBER(10,0) DEFAULT 0, 
	"GPS_DOOR2" NUMBER(10,0) DEFAULT 0, 
	"GPS_RELAY1" NUMBER(10,0) DEFAULT 0, 
	"GPS_RELAY2" NUMBER(10,0) DEFAULT 0, 
	"GPS_TIME" NUMBER(10,0) DEFAULT 0, 
	"INSERT_TIME" NUMBER(10,0) DEFAULT 0, 
	"IS_VALID" NUMBER(10,0) DEFAULT 0, 
	"BUF_LATI" VARCHAR2(20) DEFAULT \'\', 
	"BUF_LONTI" VARCHAR2(20) DEFAULT \'\', 
	"COOLER_RPM" NUMBER(10,0) DEFAULT NULL NOT NULL ENABLE, 
	"TEMP_ALARM" NUMBER(10,0) DEFAULT NULL NOT NULL ENABLE, 
	"RESERVE2" NUMBER(10,0) DEFAULT NULL, 
	"CURRENT" NUMBER(10,0) DEFAULT NULL NOT NULL ENABLE, 
	"WATER_TEMP" NUMBER(10,0) DEFAULT NULL NOT NULL ENABLE, 
	"SUCTION_PRESS" NUMBER(10,0) DEFAULT NULL NOT NULL ENABLE, 
	"DISCHARGE_PRESS" NUMBER(10,0) DEFAULT NULL NOT NULL ENABLE, 
	"RESERVE3" NUMBER(10,0) DEFAULT NULL NOT NULL ENABLE, 
	"RESERVE4" NUMBER(10,0) DEFAULT NULL NOT NULL ENABLE, 
	"RESERVE5" NUMBER(10,0) DEFAULT NULL NOT NULL ENABLE, 
	"RESERVE6" NUMBER(10,0) DEFAULT NULL NOT NULL ENABLE, 
	"RESERVE7" NUMBER(10,0) DEFAULT NULL NOT NULL ENABLE, 
	"RESERVE8" NUMBER(10,0) DEFAULT NULL NOT NULL ENABLE
   )
';
$sql3='
CREATE INDEX "SCOTT"."BOX_TIME_20191101" ON "SCOTT"."ZJ_DATA_20191101" ("BOX_ID", "INSERT_TIME") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" 
 
';
$sql4='
CREATE INDEX "SCOTT"."BOX_TIME_VALID_20191101" ON "SCOTT"."ZJ_DATA_20191101" ("BOX_ID", "INSERT_TIME", "IS_VALID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"';
$sql5='
CREATE OR REPLACE TRIGGER "SCOTT"."DATA_ID_20191101" BEFORE INSERT ON "SCOTT"."ZJ_DATA_20191101" FOR EACH ROW 
begin
select  DATA_20191101_SEQ.nextval into :new."ID" from dual;
end';
$sql6='ALTER TRIGGER "SCOTT"."DATA_ID_20191101" ENABLE';
	//var_export($sql);

	var_export(Db::execute($sql));
	var_export(Db::execute($sql2));
	var_export(Db::execute($sql3));
	var_export(Db::execute($sql4));
	var_export(Db::execute($sql5));
	var_export(Db::execute($sql6));
	}
}