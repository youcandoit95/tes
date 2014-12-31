SELECT 
	sg.THN_BLN,IFNULL(X.JML,0) AS JML_DONE,IFNULL(X.STATUS,'DONE') AS ST_DONE,
	IFNULL(WCD.JML,0) AS JML_WCD,IFNULL(WCD.STATUS,'WCD') AS ST_WCD, 
	IFNULL(H.JML,0) AS JML_HOLD,IFNULL(H.STATUS,'HOLD') AS ST_HOLD, 
	IFNULL(R.JML,0) AS JML_REV,IFNULL(R.STATUS,'REVISION') AS ST_REV, 
	IFNULL(OP.JML,0) AS JML_REV,IFNULL(OP.STATUS,'REVISION') AS ST_OP,
	IFNULL(WR.JML,0) AS JML_WR,IFNULL(WR.STATUS,'WR') AS ST_WR,
	IFNULL(Y.JML,0) AS JML_CANCEL,IFNULL(Y.STATUS,'CANCEL') AS ST_CANCEL
FROM tbl_support_graph sg LEFT  JOIN (
				SELECT 
					COUNT(d.request_id) AS JML, 
					d.request_status AS STATUS,
					DATE_FORMAT( d.request_dateCreated, "%Y-%m") AS BLN
				FROM tbl_request d
				WHERE d.request_status="DONE"  
				AND DATE_FORMAT( d.request_dateCreated, "%Y-%m") BETWEEN "2013-06" AND  "2014-06"
				GROUP BY d.request_status,DATE_FORMAT( d.request_dateCreated, "%Y-%m")) AS X 
				ON (sg.THN_BLN=X.BLN)
				
				LEFT JOIN (
					SELECT 
						COUNT(rc.request_id) AS JML, 
						rc.request_status AS STATUS ,
						DATE_FORMAT( rc.request_dateCreated, "%Y-%m") AS BLN
					FROM tbl_request rc
					WHERE rc.request_cancel="Y" 
					AND DATE_FORMAT( rc.request_dateCreated, "%Y-%m") BETWEEN "2013-06" AND  "2014-06"
					GROUP BY rc.request_status,DATE_FORMAT( rc.request_dateCreated, "%Y-%m")) AS Y 
				ON (sg.THN_BLN=Y.BLN)
				
				LEFT JOIN (
					SELECT 
						COUNT(rwd.request_id) AS JML, 
						rwd.request_status AS STATUS ,
						DATE_FORMAT( rwd.request_dateCreated, "%Y-%m") AS BLN
					FROM tbl_request rwd
					WHERE rwd.request_status="Waiting_confirmation_DONE"
					AND DATE_FORMAT( rwd.request_dateCreated, "%Y-%m") BETWEEN "2013-06" AND  "2014-06"
					GROUP BY rwd.request_status,DATE_FORMAT( rwd.request_dateCreated, "%Y-%m")) AS WCD 
				ON (sg.THN_BLN=WCD.BLN)
				
				LEFT JOIN (
					SELECT 
						COUNT(rh.request_id) AS JML, 
						rh.request_status AS STATUS ,
						DATE_FORMAT( rh.request_dateCreated, "%Y-%m") AS BLN
					FROM tbl_request rh
					WHERE rh.request_status="HOLD"
					AND DATE_FORMAT( rh.request_dateCreated, "%Y-%m") BETWEEN "2013-06" AND  "2014-06"
					GROUP BY rh.request_status,DATE_FORMAT( rh.request_dateCreated, "%Y-%m")) AS H 
				ON (sg.THN_BLN=H.BLN)
				
				LEFT JOIN (
					SELECT 
						COUNT(rr.request_id) AS JML, 
						rr.request_status AS STATUS ,
						DATE_FORMAT( rr.request_dateCreated, "%Y-%m") AS BLN
					FROM tbl_request rr
					WHERE rr.request_status="REVISION"
					AND DATE_FORMAT( rr.request_dateCreated, "%Y-%m") BETWEEN "2013-06" AND  "2014-06"
					GROUP BY rr.request_status,DATE_FORMAT( rr.request_dateCreated, "%Y-%m")) AS R
				ON (sg.THN_BLN=R.BLN)
				
				LEFT JOIN (
					SELECT 
						COUNT(rop.request_id) AS JML, 
						rop.request_status AS STATUS ,
						DATE_FORMAT( rop.request_dateCreated, "%Y-%m") AS BLN
					FROM tbl_request rop
					WHERE rop.request_status="On Process"
					AND DATE_FORMAT( rop.request_dateCreated, "%Y-%m") BETWEEN "2013-06" AND  "2014-06"
					GROUP BY rop.request_status,DATE_FORMAT( rop.request_dateCreated, "%Y-%m")) AS OP
				ON (sg.THN_BLN=OP.BLN)
				
				LEFT JOIN (
					SELECT 
						COUNT(rwr.request_id) AS JML, 
						rwr.request_status AS STATUS ,
						DATE_FORMAT( rwr.request_dateCreated, "%Y-%m") AS BLN
					FROM tbl_request rwr
					WHERE rwr.request_status="Waiting_respond"
					AND DATE_FORMAT( rwr.request_dateCreated, "%Y-%m") BETWEEN "2013-06" AND  "2014-06"
					GROUP BY rwr.request_status,DATE_FORMAT( rwr.request_dateCreated, "%Y-%m")) AS WR
				ON (sg.THN_BLN=WR.BLN)
WHERE
sg.THN_BLN BETWEEN "2013-06" AND  "2014-06";