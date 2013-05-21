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
	$mysql_cmd -e "select ID from inbox where Processed='false' order by ID desc limit 1;" | awk 'NR==2' > $log
	id_inbox="`cat $log | cut -f1`"
	curl http://localhost/rekayasa/gammu/index/$id_inbox	
	rm -r $log
	

}

get_inbox
