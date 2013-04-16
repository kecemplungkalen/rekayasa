#!/bin/bash

MYSQL=/usr/bin/mysql
LOGGER="logger -t rwsmsd --"
CONFIG=${1-/etc/rw.conf}

source $CONFIG || die "could not read config file"
[ $sms_db ] || die "could not get sms_db option from config file"
[ $sms_dbhost ] || die "could not get sms_dbhost option from config file"
[ $sms_dbuser ] || die "could not get sms_dbuser option from config file"
[ $sms_dbpassword ] || die "could not get sms_dbpassword option from config file"


mysql_cmd="$MYSQL \
-h$sms_dbhost \
-D$sms_db \
-u$sms_dbuser \
-p$sms_dbpassword "


get_inbox(){
	
	local log=`mktemp log-sms-XXX`
	$mysql_cmd -e "select ID,SenderNumber,TextDecoded from inbox order by ID desc limit 1;" | awk 'NR==2' > $log
	id_inbox="`cat $log | cut -f1`"
	number="`cat $log | cut -f2`"
	isi="`cat $log | cut -f3`"
	if [[ -z $isi ]]
	then
	move_to_failed $number $id_inbox
	else
	move_to_proses $id_inbox
	fi	
	rm -r $log
	

}

move_to_failed(){
	

	id=$1
	$mysql_cmd -ss -e "insert into inbox_failed select * from inbox where ID=$id;"
	$mysql_cmd -e "delete from inbox where ID='$id';"
	#ganti ini
	curl http://localhost/smsgawe/sms_proses/inbox_failed/$id
	}


move_to_proses(){
	
	id=$1
	$mysql_cmd -ss -e "insert into inbox_proses select * from inbox where ID=$id;"
	$mysql_cmd -e "delete from inbox where ID='$id';"
	#ganti ini
	curl http://localhost/smsgawe/sms_proses/inbox_proses/$id
	}
	
#get inbox
get_inbox
