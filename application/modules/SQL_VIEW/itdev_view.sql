/*
ar_file_concat
*/

CREATE OR REPLACE VIEW ar_file_concat AS
SELECT 
  f.F_Req_id,
  CONCAT_WS('|', f.F_Maintenance, f.F_Form_req_dev, f.F_Bisnis_proses, f.F_Regulasi, f.F_Master_data, f.F_Fungsi_utamaApp, f.F_Karakteristik_pengguna, f.F_Prototype, f.F_RAS, f.F_UAT ) AS doc_support
FROM tbl_file_request f;