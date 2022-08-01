IF EXISTS(SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'TCNMChannel_L' AND COLUMN_NAME = 'FTPdtRmk') BEGIN
	EXEC sp_rename 'TCNMChannel_L.FTPdtRmk', 'FTChnRmk', 'COLUMN'
END
GO
IF EXISTS(SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'TCNMChannelTmp_L' AND COLUMN_NAME = 'FTPdtRmk') BEGIN
	EXEC sp_rename 'TCNMChannelTmp_L.FTPdtRmk', 'FTChnRmk', 'COLUMN'
END


IF NOT EXISTS(SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'TPSTSalDTFhn' AND COLUMN_NAME = 'FNXsfSeqNo') BEGIN
	ALTER TABLE TPSTSalDTFhn ADD FNXsfSeqNo int NOT NULL DEFAULT(1)
END
GO
IF NOT EXISTS(SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'TPSTSalDTFhn' AND COLUMN_NAME = 'FTClrName') BEGIN
	ALTER TABLE TPSTSalDTFhn ADD FTClrName varchar(100)
END
GO
IF NOT EXISTS(SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'TPSTSalDTFhn' AND COLUMN_NAME = 'FTPszName') BEGIN
	ALTER TABLE TPSTSalDTFhn ADD FTPszName varchar(100)
END
GO
IF NOT EXISTS(SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'TPSTSalDTFhn' AND COLUMN_NAME = 'FTFabName') BEGIN
	ALTER TABLE TPSTSalDTFhn ADD FTFabName varchar(100)
END
GO
IF NOT EXISTS(SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'TPSTSalDTFhn' AND COLUMN_NAME = 'FTSeaName') BEGIN
	ALTER TABLE TPSTSalDTFhn ADD FTSeaName varchar(100)
END
GO
IF EXISTS(SELECT name FROM sys.key_constraints WHERE name = 'PK_TPSTSalDTFhn') BEGIN
	ALTER TABLE TPSTSalDTFhn DROP CONSTRAINT PK_TPSTSalDTFhn
END
GO


/****** Object:  Table [dbo].[TCNTPdtIntDTFhn]    Script Date: 12/7/2564 19:16:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TCNTPdtIntDTFhn]') AND type in (N'U'))
BEGIN
CREATE TABLE [dbo].[TCNTPdtIntDTFhn](
	[FTBchCode] [varchar](5) NOT NULL,
	[FTXthDocNo] [varchar](20) NOT NULL,
	[FNXtdSeqNo] [int] NOT NULL,
	[FTPdtCode] [varchar](20) NOT NULL,
	[FTFhnRefCode] [varchar](50) NOT NULL,
	[FCXtdQty] [numeric](18, 4) NULL,
	[FCXtdQtyRcv] [numeric](18, 4) NULL,
	[FCXtdQtyAll] [numeric](18, 4) NULL,
	[FTXthWahTo] [varchar](255) NULL,
 CONSTRAINT [PK_TCNTPdtIntDTFhn] PRIMARY KEY CLUSTERED 
(
	[FTBchCode] ASC,
	[FTXthDocNo] ASC,
	[FNXtdSeqNo] ASC,
	[FTPdtCode] ASC,
	[FTFhnRefCode] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
END
GO
/****** Object:  Table [dbo].[TCNTPdtIntDTFhnBch]    Script Date: 12/7/2564 19:16:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TCNTPdtIntDTFhnBch]') AND type in (N'U'))
BEGIN
CREATE TABLE [dbo].[TCNTPdtIntDTFhnBch](
	[FTBchCode] [varchar](5) NOT NULL,
	[FTXthDocNo] [varchar](20) NOT NULL,
	[FNXtdSeqNo] [int] NOT NULL,
	[FTPdtCode] [varchar](20) NOT NULL,
	[FTFhnRefCode] [varchar](255) NOT NULL,
	[FCXtdQty] [numeric](18, 4) NULL,
	[FCXtdQtyRcv] [numeric](18, 4) NULL,
	[FCXtdQtyAll] [numeric](18, 4) NULL,
	[FTXthBchTo] [varchar](5) NULL,
	[FTXthWahTo] [varchar](5) NULL,
 CONSTRAINT [PK_TCNTPdtIntDTFhnBch] PRIMARY KEY CLUSTERED 
(
	[FTBchCode] ASC,
	[FTXthDocNo] ASC,
	[FNXtdSeqNo] ASC,
	[FTPdtCode] ASC,
	[FTFhnRefCode] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
END
GO
/****** Object:  Table [dbo].[TCNTPdtTbiDTFhn]    Script Date: 12/7/2564 19:16:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TCNTPdtTbiDTFhn]') AND type in (N'U'))
BEGIN
CREATE TABLE [dbo].[TCNTPdtTbiDTFhn](
	[FTBchCode] [varchar](5) NOT NULL,
	[FTXthDocNo] [varchar](20) NOT NULL,
	[FNXtdSeqNo] [int] NOT NULL,
	[FTPdtCode] [varchar](20) NOT NULL,
	[FTFhnRefCode] [varchar](255) NOT NULL,
	[FCXtdQty] [numeric](18, 4) NULL,
PRIMARY KEY CLUSTERED 
(
	[FTBchCode] ASC,
	[FTXthDocNo] ASC,
	[FNXtdSeqNo] ASC,
	[FTPdtCode] ASC,
	[FTFhnRefCode] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
END
GO
/****** Object:  Table [dbo].[TCNTPdtTboDTFhn]    Script Date: 12/7/2564 19:16:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TCNTPdtTboDTFhn]') AND type in (N'U'))
BEGIN
CREATE TABLE [dbo].[TCNTPdtTboDTFhn](
	[FTBchCode] [varchar](5) NOT NULL,
	[FTXthDocNo] [varchar](20) NOT NULL,
	[FNXtdSeqNo] [int] NOT NULL,
	[FTPdtCode] [varchar](20) NOT NULL,
	[FTFhnRefCode] [varchar](255) NOT NULL,
	[FCXtdQty] [numeric](18, 4) NULL,
PRIMARY KEY CLUSTERED 
(
	[FTBchCode] ASC,
	[FTXthDocNo] ASC,
	[FNXtdSeqNo] ASC,
	[FTPdtCode] ASC,
	[FTFhnRefCode] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
END
GO



/****** Object:  Table [dbo].[TRPTCstSalMTDTmp]    Script Date: 14/7/2564 12:54:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TRPTCstSalMTDTmp]') AND type in (N'U'))
BEGIN
CREATE TABLE [dbo].[TRPTCstSalMTDTmp](
	[FTRptRowSeq] [bigint] IDENTITY(1,1) NOT NULL,
	[FNRowPartID] [bigint] NULL,
	[FNAppType] [int] NULL,
	[FTCgpCode] [varchar](5) NULL,
	[FTCstCode] [varchar](50) NULL,
	[FTCstName] [varchar](255) NULL,
	[FTCstCrdNo] [varchar](100) NULL,
	[FCTxnBuyTotal] [numeric](18, 4) NULL,
	[FCXshGrand] [numeric](18, 4) NULL,
	[FDXshLastDate] [datetime] NULL,
	[FTBchCode] [varchar](5) NULL,
	[FTBchName] [varchar](100) NULL,
	[FTCstTel] [varchar](20) NULL,
	[FDCstDob] [datetime] NULL,
	[FTChnCount] [numeric](18, 0) NULL,
	[FTCstSex] [varchar](50) NULL,
	[FCCstCrLimit] [numeric](18, 4) NULL,
	[FTClvName] [varchar](100) NULL,
	[FCTxnPntBillQty] [numeric](18, 4) NULL,
	[FCTxnPntQtyBal] [numeric](18, 4) NULL,
	[FTCstEmail] [varchar](100) NULL,
	[FDCstApply] [datetime] NULL,
	[FTCtyName] [varchar](100) NULL,
	[FTPplName] [varchar](100) NULL,
	[FCXshSumGrand] [numeric](18, 4) NULL,
	[FTComName] [varchar](50) NULL,
	[FTRptCode] [varchar](50) NULL,
	[FTUsrSession] [varchar](255) NULL,
	[FDTmpTxnDate] [datetime] NULL,
	[FTCstAddress] [text] NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
END
GO
/****** Object:  Table [dbo].[TRPTSpcSalByDTTmp]    Script Date: 14/7/2564 12:54:08 ******/
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TRPTSpcSalByDTTmp]') AND type in (N'U'))
BEGIN
DROP TABLE TRPTSpcSalByDTTmp;
END
GO 
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TRPTSpcSalByDTTmp]') AND type in (N'U'))
BEGIN
CREATE TABLE [dbo].[TRPTSpcSalByDTTmp](
	[FTRptRowSeq] [bigint] IDENTITY(1,1) NOT NULL,
	[FNRowPartID] [bigint] NULL,
	[FNAppType] [int] NULL,
	[FTPbnName] [varchar](255) NULL,
	[FDXshDocDate] [datetime] NULL,
	[FTCstName] [varchar](255) NULL,
	[FTCstTel] [varchar](255) NULL,
	[FTBchCode] [varchar](5) NULL,
	[FTBchName] [varchar](100) NULL,
	[FTXshDocNo] [varchar](20) NULL,
	[FNXsdSeqNo] [int] NULL,
	[FTUsrName] [varchar](255) NULL,
	[FTPdtCode] [varchar](20) NULL,
	[FTXsdPdtName] [varchar](100) NULL,
	[FTPgpChainName] [varchar](255) NULL,
	[FTPunCode] [varchar](5) NULL,
	[FTPunName] [varchar](50) NULL,
	[FTFhnRefCode] [varchar](50) NULL,
	[FTClrName] [varchar](100) NULL,
	[FTPszName] [varchar](100) NULL,
	[FTFhnGender] [varchar](100) NULL,
	[FTSeaName] [varchar](100) NULL,
	[FNXshAge] [varchar](100) NULL,
	[FTXshNation] [varchar](100) NULL,
	[FTDepName] [varchar](100) NULL,
	[FTCmlName] [varchar](100) NULL,
	[FTClsName] [varchar](100) NULL,
	[FCXsdFactor] [numeric](18, 4) NULL,
	[FTXsdBarCode] [varchar](25) NULL,
	[FTSrnCode] [varchar](50) NULL,
	[FTXsdVatType] [varchar](1) NULL,
	[FTVatCode] [varchar](5) NULL,
	[FCXsdVatRate] [numeric](18, 4) NULL,
	[FTXsdSaleType] [varchar](1) NULL,
	[FCXsdSalePrice] [numeric](18, 4) NULL,
	[FCXsdGrossSales] [numeric](18, 4) NULL,
	[FCXsdGrossSalesExVat] [numeric](18, 4) NULL,
	[FCXsdNetSales] [numeric](18, 4) NULL,
	[FCXsdNetSalesEx] [numeric](18, 4) NULL,
	[FTXddDisChgTxt] [varchar](100) NULL,
	[FCXsdQty] [numeric](18, 4) NULL,
	[FCXsdQtyAll] [numeric](18, 4) NULL,
	[FCXsdSetPrice] [numeric](18, 4) NULL,
	[FCXsdAmtB4DisChg] [numeric](18, 4) NULL,
	[FTXsdDisChgTxt] [varchar](50) NULL,
	[FCXsdDis] [numeric](18, 4) NULL,
	[FCXsdChg] [numeric](18, 4) NULL,
	[FCXsdNet] [numeric](18, 4) NULL,
	[FCXsdNetAfHD] [numeric](18, 4) NULL,
	[FCXsdVat] [numeric](18, 4) NULL,
	[FCXsdVatable] [numeric](18, 4) NULL,
	[FCXsdWhtAmt] [numeric](18, 4) NULL,
	[FTXsdWhtCode] [varchar](5) NULL,
	[FCXsdWhtRate] [numeric](18, 4) NULL,
	[FCXsdCostIn] [numeric](18, 4) NULL,
	[FCXsdCostEx] [numeric](18, 4) NULL,
	[FTXsdStaPdt] [varchar](1) NULL,
	[FCXsdQtyLef] [numeric](18, 4) NULL,
	[FCXsdQtyRfn] [numeric](18, 4) NULL,
	[FTXsdStaPrcStk] [varchar](1) NULL,
	[FTXsdStaAlwDis] [varchar](1) NULL,
	[FNXsdPdtLevel] [int] NULL,
	[FTXsdPdtParent] [varchar](20) NULL,
	[FCXsdQtySet] [numeric](18, 4) NULL,
	[FTPdtStaSet] [varchar](1) NULL,
	[FTXsdRmk] [varchar](200) NULL,
	[FDLastUpdOn] [datetime] NULL,
	[FTLastUpdBy] [varchar](20) NULL,
	[FDCreateOn] [datetime] NULL,
	[FTCreateBy] [varchar](20) NULL,
	[FTComName] [varchar](50) NULL,
	[FTRptCode] [varchar](50) NULL,
	[FTUsrSession] [varchar](255) NULL,
	[FDTmpTxnDate] [datetime] NULL,
	[FTChnName] [varchar](50) NULL,
	[FTCstCode] [varchar](50) NULL,
	[FNXshSex] [varchar](10) NULL,
	[FTXshRmk] [varchar](255) NULL,
) ON [PRIMARY]
END
GO

/****** Object:  Table [dbo].[TCNMAdjPdtTmp]    Script Date: 14/7/2564 12:57:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TCNMAdjPdtTmp]') AND type in (N'U'))
BEGIN
CREATE TABLE [dbo].[TCNMAdjPdtTmp](
	[FNRowID] [bigint] NULL,
	[FTAgnCode] [varchar](10) NULL,
	[FTBchCode] [varchar](5) NULL,
	[FTPdtCode] [varchar](20) NULL,
	[FTPdtName] [varchar](150) NULL,
	[FTPunCode] [varchar](5) NULL,
	[FTPunName] [varchar](100) NULL,
	[FTBarCode] [varchar](25) NULL,
	[FTPgpChain] [varchar](30) NULL,
	[FTPgpName] [varchar](100) NULL,
	[FTPbnCode] [varchar](10) NULL,
	[FTPbnName] [varchar](100) NULL,
	[FTPmoCode] [varchar](10) NULL,
	[FTPmoName] [varchar](100) NULL,
	[FTPtyCode] [varchar](10) NULL,
	[FTPtyName] [varchar](100) NULL,
	[FTStaAlwSet] [varchar](1) NULL,
	[FTSessionID] [varchar](255) NULL,
	[FTBchName] [varchar](100) NULL,
	[FTFhnRefCode] [varchar](50) NULL,
	[FTSeaCode] [varchar](5) NULL,
	[FTSeaName] [varchar](100) NULL,
	[FTFabCode] [varchar](5) NULL,
	[FTFabName] [varchar](100) NULL,
	[FTClrCode] [varchar](100) NULL,
	[FTClrName] [varchar](100) NULL,
	[FTPszCode] [varchar](5) NULL,
	[FTPszName] [varchar](100) NULL,
	[FTDepCode] [varchar](10) NULL,
	[FTDepName] [varchar](100) NULL,
	[FTClsCode] [varchar](10) NULL,
	[FTClsName] [varchar](100) NULL,
	[FTSclCode] [varchar](10) NULL,
	[FTSclName] [varchar](100) NULL,
	[FTPgpCode] [varchar](10) NULL,
	[FTCmlCode] [varchar](10) NULL,
	[FTCmlName] [varchar](100) NULL,
	[FTFhnModNo] [varchar](30) NULL,
	[FTFhnGender] [varchar](30) NULL,
	[FCFhnCostStd] [numeric](18, 4) NULL,
	[FCFhnCostOth] [numeric](18, 4) NULL,
	[FDFhnStart] [datetime] NULL,
	[FCXsdSalePrice] [numeric](18, 4) NULL,
	[FTFhnPgpName] [varchar](100) NULL,
	[FNFhnSeq] [int] NULL
) ON [PRIMARY]
END
GO



/****** Object:  Table [dbo].[TRPTPdtStkBalFhnTmp]    Script Date: 16/7/2564 15:50:17 ******/

IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TRPTPdtStkBalFhnTmp]') AND type in (N'U'))
BEGIN
DROP TABLE TRPTPdtStkBalFhnTmp;
END
GO 
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TRPTPdtStkBalFhnTmp]') AND type in (N'U'))
BEGIN
CREATE TABLE [dbo].[TRPTPdtStkBalFhnTmp](
	[FTRptRowSeq] [bigint] IDENTITY(1,1) NOT NULL,
	[FNRowPartID] [bigint] NULL,
	[FTBchCode] [varchar](5) NULL,
	[FTWahCode] [varchar](5) NULL,
	[FTWahName] [varchar](255) NULL,
	[FTPdtCode] [varchar](20) NULL,
	[FTPdtName] [varchar](255) NULL,
	[FTPgpChainName] [varchar](255) NULL,
	[FCPdtCostAVGEX] [numeric](18, 4) NULL,
	[FCPdtCostTotal] [numeric](18, 4) NULL,
	[FCStkQty] [numeric](18, 4) NULL,
	[FDLastUpdOn] [datetime] NULL,
	[FTLastUpdBy] [varchar](20) NULL,
	[FDCreateOn] [datetime] NULL,
	[FTCreateBy] [varchar](20) NULL,
	[FTComName] [varchar](50) NULL,
	[FTRptCode] [varchar](50) NULL,
	[FTUsrSession] [varchar](255) NULL,
	[FDTmpTxnDate] [datetime] NULL,
	[FTBchName] [varchar](100) NULL,
	[FTFhnRefCode] [varchar](50) NULL,
	[FTDepName] [varchar](100) NULL,
	[FTClsName] [varchar](100) NULL,
	[FTSeaName] [varchar](100) NULL,
	[FTPmoName] [varchar](100) NULL,
	[FTFabName] [varchar](100) NULL,
	[FTClrName] [varchar](100) NULL,
	[FTPszName] [varchar](100) NULL,
	[FTClrRmk] [varchar](50) NULL,
	[FTBarCode] [varchar](50) NULL,
	[FCPgdPriceRet] [numeric](18, 4) NULL,
	[FCXshNetSale] [numeric](18, 4) NULL,
	[FCXshDiffCost] [numeric](18, 4) NULL,
) ON [PRIMARY]
END
GO
/****** Object:  Table [dbo].[TRPTPdtStkCrdFhnTmp]    Script Date: 16/7/2564 15:50:19 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TRPTPdtStkCrdFhnTmp]') AND type in (N'U'))
BEGIN
CREATE TABLE [dbo].[TRPTPdtStkCrdFhnTmp](
	[FTRptRowSeq] [bigint] IDENTITY(1,1) NOT NULL,
	[FNRowPartID] [bigint] NULL,
	[FNRowPartIDWah] [bigint] NULL,
	[FNRowPartIDBch] [bigint] NULL,
	[FNStkCrdID] [bigint] NULL,
	[FTBchCode] [varchar](5) NULL,
	[FTBchName] [varchar](100) NULL,
	[FDStkDate] [datetime] NULL,
	[FTStkDocNo] [varchar](20) NULL,
	[FTWahCode] [varchar](5) NULL,
	[FTPdtCode] [varchar](20) NULL,
	[FTStkType] [varchar](1) NULL,
	[FCStkQtyMonEnd] [numeric](18, 4) NULL,
	[FCStkQtyIn] [numeric](18, 4) NULL,
	[FCStkQtyOut] [numeric](18, 4) NULL,
	[FCStkQtySaleDN] [numeric](18, 4) NULL,
	[FCStkQtyCN] [numeric](18, 4) NULL,
	[FCStkQtyAdj] [numeric](18, 4) NULL,
	[FCStkSetPrice] [numeric](18, 4) NULL,
	[FCStkCostIn] [numeric](18, 4) NULL,
	[FCStkCostEx] [numeric](18, 4) NULL,
	[FTWahName] [varchar](255) NULL,
	[FTPdtName] [varchar](255) NULL,
	[FCStkQtyBal] [numeric](18, 4) NULL,
	[FTComName] [varchar](50) NULL,
	[FTRptCode] [varchar](50) NULL,
	[FTUsrSession] [varchar](255) NULL,
	[FDTmpTxnDate] [datetime] NULL,
	[FTBarCode] [varchar](25) NULL,
	[FTFhnRefCode] [varchar](50) NULL,
	[FTDepName] [varchar](100) NULL,
	[FTClsName] [varchar](100) NULL,
	[FTSeaName] [varchar](100) NULL,
	[FTPmoName] [varchar](100) NULL,
	[FTFabName] [varchar](100) NULL,
	[FTClrName] [varchar](100) NULL,
	[FTPszName] [varchar](100) NULL,
	[FTClrRmk] [varchar](50) NULL,
) ON [PRIMARY]
END
GO




/****** Object:  View [dbo].[VCN_VatActive]    Script Date: 3/9/2564 21:14:28 ******/
DROP VIEW IF EXISTS [dbo].[VCN_VatActive]
GO
/****** Object:  View [dbo].[VCN_VatActive]    Script Date: 3/9/2564 21:14:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[VCN_VatActive] AS 
SELECT V.* FROM (
SELECT 
ROW_NUMBER() OVER(PARTITION BY FTVatCode ORDER BY  FTVatCode ASC ,FDVatStart DESC) AS FNRowPart,
FTVatCode,
FCVatRate,
FDVatStart
FROM TCNMVatRate WHERE CONVERT(VARCHAR(19),GETDATE(),121) > FDVatStart  ) V
WHERE V.FNRowPart = 1 
GO
