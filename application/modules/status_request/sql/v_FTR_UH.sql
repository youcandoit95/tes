CREATE OR REPLACE VIEW FTR_UH AS
SELECT request_id,CONCAT_WS(';', 
        ifnull(request_id,''),ifnull(request_based,''),
        ifnull((SELECT requestType_name FROM tbl_requesttype WHERE requestType_id=req.request_type),''),
        ifnull((SELECT requestCase_name FROM tbl_requestcase WHERE requestCase_id=req.request_case),''),
	      ifnull(request_modul,''),ifnull(request_desc,''),ifnull(request_statusReason,''),
        ifnull((SELECT tbl_user.user_name FROM tbl_user WHERE user_id=request_PIC),''),
        ifnull((SELECT tbl_user.user_fullName FROM tbl_user  WHERE user_id=request_PIC),''),
        ifnull((SELECT tbl_user.user_phonePersonal FROM tbl_user WHERE user_id=request_PIC),''),
        ifnull((SELECT tbl_user.user_phoneOffice FROM tbl_user WHERE user_id=request_PIC),''),
        ifnull(DATE_FORMAT(request_dateCreated, '%d-%m-%Y %h:%i:%s'),''),
        ifnull(request_status,''),
		ifnull(req.request_statusReason,''),
		ifnull(req.request_statusDate,'')) AS FTR_DATA
	   FROM tbl_request req; 