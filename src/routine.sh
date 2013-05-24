#!/bin/bash

#MYSQL=/usr/bin/mysql
#LOGGER="logger -t rwsmsd --"
#CONFIG=${1-/etc/rw.conf}

#source $CONFIG || die "could not read config file"
#[ $sms_db ] || die "could not get sms_db option from config file"
#[ $sms_dbhost ] || die "could not get sms_dbhost option from config file"
#[ $sms_dbuser ] || die "could not get sms_dbuser option from config file"
#[ $sms_dbpassword ] || die "could not get sms_dbpassword option from config file"


### gammu interface ##
#gammu_cmd="$MYSQL \
#-h$sms_dbhost \
#-D$sms_db \
#-u$sms_dbuser \
#-p$sms_dbpassword "

### apps interface ###
#app_cmd="$MYSQL \  
#-h$sms_dbhost \  
#-D$sms_dbuser \    
#-u$sms_dbuser \    
#-p$sms_dbpassword "



#########################################################################################################################
#'SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error'
#########################################################################################################################

get_label(){
	
	local log=`mktemp log-sms-XXX`
	/usr/bin/mysql -s -udb_smsgwrwt -psmsgwrwt420420 -Ddb_smsgwrwt -e "select concat_ws(',',inbox.id_inbox,InsertIntoDB,number,id_label) from label join inbox on inbox.id_inbox = label.id_inbox where id_labelname = '3'" > $log
	datainbox="`cat $log | sed 's/ /_/g'`"
	for i in $datainbox
	do
		id_label=`echo $i | awk -F ',' '{print $4}'`
		number=`echo $i | awk -F ',' '{print $3}'`
		dum=`echo $i | awk -F ',' '{print $2}'`
		id=`echo $i | awk -F ',' '{print $1}'`
		date=` echo $dum | sed 's/_/ /g '`
		### get status ###
			status=`/usr/bin/mysql -s -udb_smsgwrwt -psmsgwrwt420420 -Ddb_smsgwrwt_gammu -e "select Status from sentitems where InsertIntoDB='$date' AND DestinationNumber='$number'"`
		if [ "$status" != "" ]
		then
			if [ "$status" ==  "SendingOK"  -o  "$status" == "DeliveryPending" ]
			then			
				/usr/bin/mysql -s -udb_smsgwrwt -psmsgwrwt420420 -Ddb_smsgwrwt -e "update inbox set send_status='$status' where id_inbox='$id'"
			else				
				/usr/bin/mysql -s -udb_smsgwrwt -psmsgwrwt420420 -Ddb_smsgwrwt -e "update inbox set send_status='$status' where id_inbox='$id'"
				/usr/bin/mysql -s -udb_smsgwrwt -psmsgwrwt420420 -Ddb_smsgwrwt -e "update label set id_labelname='2' where id_label='$id_label' and id_inbox='$id'"						
			fi			
		fi
		
	done
	rm -r $log

}
get_label

