--################## CREATE TABLE FOR SCRIPT ##################
	IF OBJECT_ID(N'TCNTUpgradeHisTmp') IS NULL BEGIN
		CREATE TABLE [dbo].[TCNTUpgradeHisTmp] (
					[FTUphVersion] varchar(10) NOT NULL ,
					[FDCreateOn] datetime NULL ,
					[FTUphRemark] varchar(MAX) NULL ,
					[FTCreateBy] varchar(50) NULL 
			);
			ALTER TABLE [dbo].[TCNTUpgradeHisTmp] ADD PRIMARY KEY ([FTUphVersion]);
		END
	GO
--#############################################################

--Version ไฟล์ กับ Version บรรทัดที่ 15 ต้องเท่ากันเสมอ !! 

IF NOT EXISTS(SELECT FTUphVersion FROM TCNTUpgradeHisTmp WHERE FTUphVersion=  '00.00.01') BEGIN

--ทุกครั้งที่รันสคริปใหม่
INSERT INTO [TCNTUpgradeHisTmp] ([FTUphVersion], [FDCreateOn], [FTUphRemark], [FTCreateBy]) VALUES ( '00.00.01', getdate() , 'สคริปตั้งต้น', 'Nattakit K.');
END
GO

IF NOT EXISTS(SELECT FTUphVersion FROM TCNTUpgradeHisTmp WHERE FTUphVersion=  '00.00.02') BEGIN

	INSERT INTO TSysSyncModule(FTAppCode,FNSynSeqNo) VALUES('PS',107);
	INSERT INTO TSysSyncModule(FTAppCode,FNSynSeqNo) VALUES('PS',108);
	INSERT INTO TSysSyncModule(FTAppCode,FNSynSeqNo) VALUES('PS',112);
	INSERT INTO TSysSyncModule(FTAppCode,FNSynSeqNo) VALUES('PS',113);
--ทุกครั้งที่รันสคริปใหม่
INSERT INTO [TCNTUpgradeHisTmp] ([FTUphVersion], [FDCreateOn], [FTUphRemark], [FTCreateBy]) VALUES ( '00.00.02', getdate() , 'ของพี่เอ็ม', 'Nattakit K.');
END
GO

IF NOT EXISTS(SELECT FTUphVersion FROM TCNTUpgradeHisTmp WHERE FTUphVersion=  '00.00.03') BEGIN
INSERT INTO [TSysReportFilter] ([FTRptFltCode], [FTRptFltStaFrm], [FTRptFltStaTo], [FTRptGrpFlt]) VALUES ('63', '1', '0', 'G3');
INSERT INTO [TSysReportFilter] ([FTRptFltCode], [FTRptFltStaFrm], [FTRptFltStaTo], [FTRptGrpFlt]) VALUES ('64', '1', '1', 'G3');
INSERT INTO [TSysReportFilter] ([FTRptFltCode], [FTRptFltStaFrm], [FTRptFltStaTo], [FTRptGrpFlt]) VALUES ('65', '1', '1', 'G3');
INSERT INTO [TSysReportFilter_L] ([FTRptFltCode], [FNLngID], [FTRptFltName]) VALUES ('63', '1', 'กลุ่มลูกค้า');
INSERT INTO [TSysReportFilter_L] ([FTRptFltCode], [FNLngID], [FTRptFltName]) VALUES ('63', '2', 'Customers Group');
INSERT INTO [TSysReportFilter_L] ([FTRptFltCode], [FNLngID], [FTRptFltName]) VALUES ('64', '1', 'ประเภทลูกค้า');
INSERT INTO [TSysReportFilter_L] ([FTRptFltCode], [FNLngID], [FTRptFltName]) VALUES ('64', '2', 'Customers Type');
INSERT INTO [TSysReportFilter_L] ([FTRptFltCode], [FNLngID], [FTRptFltName]) VALUES ('65', '1', 'ระดับลูกค้า');
INSERT INTO [TSysReportFilter_L] ([FTRptFltCode], [FNLngID], [FTRptFltName]) VALUES ('65', '2', 'Customers Level');

INSERT INTO [TSysReport] ([FTRptCode], [FTGrpRptModCode], [FTGrpRptCode], [FTRptRoute], [FTRptStaUseFrm], [FTRptTblView], [FTRptFilterCol], [FTRptFileName], [FTRptStaShwBch], [FTRptStaShwYear], [FTRptSeqNo], [FTRptStaUse], [FTLicPdtCode]) VALUES ('006001005', '006', '006001', 'rptCustomer', NULL, NULL, '27,63,64,65', NULL, '1', '1', '5', '1', 'SB-RPT006001005');
INSERT INTO [TSysReport_L] ([FTRptCode], [FNLngID], [FTRptName], [FTRptDes]) VALUES ('006001005', '1', 'รายงานลูกค้า', '');

INSERT INTO [TSysReportGrp] ([FTGrpRptCode], [FNGrpRptShwSeq], [FTGrpRptStaUse], [FTGrpRptModCode]) VALUES ('001003', '3', '1', '001');
INSERT INTO [TSysReportGrp_L] ([FTGrpRptCode], [FNLngID], [FTGrpRptName]) VALUES ('001003', '1', 'รายงานพิเศษ');

INSERT INTO [TSysReport] ([FTRptCode], [FTGrpRptModCode], [FTGrpRptCode], [FTRptRoute], [FTRptStaUseFrm], [FTRptTblView], [FTRptFilterCol], [FTRptFileName], [FTRptStaShwBch], [FTRptStaShwYear], [FTRptSeqNo], [FTRptStaUse], [FTLicPdtCode]) VALUES ('001003001', '001', '001003', 'rptSalByDT', NULL, NULL, '1,3,4,9,13,27,53,59,60,61,62', NULL, '1', '1', '1', '1', 'SB-RPT001003001');
INSERT INTO [TSysReport_L] ([FTRptCode], [FNLngID], [FTRptName], [FTRptDes]) VALUES ('001003001', '1', 'รายงาน - ยอดขายตามรายการสินค้า', '');

--ทุกครั้งที่รันสคริปใหม่
INSERT INTO [TCNTUpgradeHisTmp] ([FTUphVersion], [FDCreateOn], [FTUphRemark], [FTCreateBy]) VALUES ( '00.00.03', getdate() , 'รายงานลูกค้า/รายงานยอดขายตามรายการ', 'Nattakit K.');
END
GO

IF NOT EXISTS(SELECT FTUphVersion FROM TCNTUpgradeHisTmp WHERE FTUphVersion=  '00.00.04') BEGIN

UPDATE TPSMFuncDT SET FTLicPdtCode = 'SF-PS048KB035',FTGdtStaUse = '1',FTGdtSysUse = '1' WHERE FTGhdCode = '048' AND FTGdtCallByName = 'C_KBDxSalePerson';
UPDATE TPSMFuncHD SET FDLastUpdOn = GETDATE(),FTLastUpdBy ='Junthon M.' WHERE FTGhdCode = '048';

--ทุกครั้งที่รันสคริปใหม่
INSERT INTO [TCNTUpgradeHisTmp] ([FTUphVersion], [FDCreateOn], [FTUphRemark], [FTCreateBy]) VALUES ( '00.00.04', getdate() , 'พี่เอ็มฝาก', 'Junthon M.');
END
GO



IF NOT EXISTS(SELECT FTUphVersion FROM TCNTUpgradeHisTmp WHERE FTUphVersion=  '00.00.05') BEGIN

INSERT INTO [TSysReport] ([FTRptCode], [FTGrpRptModCode], [FTGrpRptCode], [FTRptRoute], [FTRptStaUseFrm], [FTRptTblView], [FTRptFilterCol], [FTRptFileName], [FTRptStaShwBch], [FTRptStaShwYear], [FTRptSeqNo], [FTRptStaUse], [FTLicPdtCode]) VALUES ('001003002', '001', '001003', 'rptRptInventoryPosFhn', NULL, NULL, '1,2,3,6,12', NULL, '1', '1', '2', '1', 'SB-RPT001003002');
INSERT INTO [TSysReport] ([FTRptCode], [FTGrpRptModCode], [FTGrpRptCode], [FTRptRoute], [FTRptStaUseFrm], [FTRptTblView], [FTRptFilterCol], [FTRptFileName], [FTRptStaShwBch], [FTRptStaShwYear], [FTRptSeqNo], [FTRptStaUse], [FTLicPdtCode]) VALUES ('001003003', '001', '001003', 'rtpMovePosVDFhn', NULL, NULL, '1,2,3,5,6,12,13,28,49', NULL, '1', '1', '3', '1', 'SB-RPT001003003');
INSERT INTO [TSysReport_L] ([FTRptCode], [FNLngID], [FTRptName], [FTRptDes]) VALUES ('001003002', '1', 'รายงาน - สินค้าแฟชั่นคงคลังตามคลังสินค้า', '');
INSERT INTO [TSysReport_L] ([FTRptCode], [FNLngID], [FTRptName], [FTRptDes]) VALUES ('001003003', '1', 'รายงาน - ความเคลื่อนไหวสินค้าแฟชั่น', '');

--ทุกครั้งที่รันสคริปใหม่
INSERT INTO [TCNTUpgradeHisTmp] ([FTUphVersion], [FDCreateOn], [FTUphRemark], [FTCreateBy]) VALUES ( '00.00.05', getdate() , 'รายงานพิเศษสินค้าแฟชั่น', 'Nattakit K.');
END
GO
