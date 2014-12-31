CREATE OR REPLACE VIEW ar_concat AS 
	select request_id,
	concat_ws("+", ifnull(request_id,''),
	ifnull(request_based,''),ifnull(request_type,''),ifnull(request_case,''),ifnull(request_modul,''),ifnull(request_desc,''),ifnull(request_reason,''),ifnull(requested_FullName,''),ifnull(requested_email,'')) as detail_request1,
	ifnull(request_dateCreated,'') as request_dateCreated,
	concat_ws("+",ifnull(requested_UserPP,''),ifnull(requested_UserPO,''),ifnull(requested_userDept,''),ifnull(requested_userDeptName,''),ifnull(request_notification,''),ifnull(request_notificationRead,''),
	ifnull(PIC,''),ifnull(PIC_username,''),ifnull(PIC_fullname,'')
	)as detail_request2, 
	ifnull(request_estimateTime,'') as request_estimateTime,
	concat_ws("+", ifnull(request_status,''),ifnull(request_cancel,''),ifnull(request_statusReason,'')) as detail_request3,
	ifnull(request_dateDone,'') as request_dateDone,request_statusDate
from ar;

  req.request_estimateTime,
  req.request_status AS request_status,
  date_format(req.request_dateDone,'%d-%m-%Y %H:%i:%s') AS request_dateDone,
  req.request_cancel AS request_cancel,req.request_statusReason AS request_statusReason,
  date_format(req.request_statusDate,'%d-%m-%Y %H:%i:%s') AS request_statusDate