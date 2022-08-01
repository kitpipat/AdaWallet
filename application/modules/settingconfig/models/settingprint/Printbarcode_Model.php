<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Printbarcode_Model extends CI_Model
{
    function FSaMPriBarList($paData)
    {
        $tIP = $this->input->ip_address();
        $tFullHost = gethostbyaddr($tIP);


        // return null;
        $aRowLen    = FCNaHCallLenData($paData['nRow'], $paData['nPage']);
        $nLngID     = $paData['FNLngID'];
        $bSeleteImport     =   $paData['bSeleteImport'];


        // $tSearchAllDocumentPrint      = $this->input->post('tSearchAllDocumentPrint');
        $tPrnBarSheet       = $paData['aDataWhere']['tPrnBarSheet'];
        $tPrnBarXthDocDateFrom   =  $paData['aDataWhere']['tPrnBarXthDocDateFrom'];
        $tPrnBarXthDocDateTo   =  $paData['aDataWhere']['tPrnBarXthDocDateTo'];
        $tPrnBarBrowseRptNoFromCode  =  $paData['aDataWhere']['tPrnBarBrowseRptNoFromCode'];
        $tPrnBarBrowseRptNoToCode   = $paData['aDataWhere']['tPrnBarBrowseRptNoToCode'];
        $tPrnBarBrowsePdtFromCode   =  $paData['aDataWhere']['tPrnBarBrowsePdtFromCode'];
        $tPrnBarBrowsePdtToCode   = $paData['aDataWhere']['tPrnBarBrowsePdtToCode'];
        $tPrnBarBrowsePdtGrpFromCode  =  $paData['aDataWhere']['tPrnBarBrowsePdtGrpFromCode'];
        $tPrnBarBrowsePdtGrpToCode   =  $paData['aDataWhere']['tPrnBarBrowsePdtGrpToCode'];
        $tPrnBarBrowsePdtTypeFromCode  =  $paData['aDataWhere']['tPrnBarBrowsePdtTypeFromCode'];
        $tPrnBarBrowsePdtTypeToCode =  $paData['aDataWhere']['tPrnBarBrowsePdtTypeToCode'];
        $tPrnBarBrowsePdtBrandFromCode   =  $paData['aDataWhere']['tPrnBarBrowsePdtBrandFromCode'];
        $tPrnBarBrowsePdtBrandToCode =  $paData['aDataWhere']['tPrnBarBrowsePdtBrandToCode'];
        $tPrnBarBrowsePdtModelFromCode  =  $paData['aDataWhere']['tPrnBarBrowsePdtModelFromCode'];
        $tPrnBarBrowsePdtModelToCode =  $paData['aDataWhere']['tPrnBarBrowsePdtModelToCode'];
        $tPrnBarPdtDepartCode  = $paData['aDataWhere']['tPrnBarPdtDepartCode'];
        $tPrnBarPdtClassCode =  $paData['aDataWhere']['tPrnBarPdtClassCode'];
        $tPrnBarPdtSubClassCode =  $paData['aDataWhere']['tPrnBarPdtSubClassCode'];
        $tPrnBarPdtGroupCode =  $paData['aDataWhere']['tPrnBarPdtGroupCode'];
        $tPrnBarPdtComLinesCode = $paData['aDataWhere']['tPrnBarPdtComLinesCode'];
        $tPrnBarTotalPrint  = $paData['aDataWhere']['tPrnBarTotalPrint'];
        $tPrnBarPlbCode  = $paData['aDataWhere']['tPrnBarPlbCode'];

        if ($tPrnBarPlbCode == 'L003') {
            $nLangPdtName = 2;
        } else {
            $nLangPdtName = 1;
        }


        if (
            $tPrnBarSheet != '' || $tPrnBarXthDocDateFrom  != '' || $tPrnBarXthDocDateTo  != '' || $tPrnBarBrowseRptNoFromCode  != '' || $tPrnBarBrowseRptNoToCode  != ''
            || $tPrnBarBrowsePdtFromCode  != '' || $tPrnBarBrowsePdtToCode  != '' || $tPrnBarBrowsePdtGrpFromCode  != '' || $tPrnBarBrowsePdtGrpToCode  != ''
            || $tPrnBarBrowsePdtTypeFromCode  != '' || $tPrnBarBrowsePdtTypeToCode  != '' || $tPrnBarBrowsePdtBrandFromCode  != '' || $tPrnBarBrowsePdtBrandToCode  != ''
            || $tPrnBarBrowsePdtModelFromCode  != '' || $tPrnBarBrowsePdtModelToCode  != '' || $tPrnBarPdtDepartCode  != '' || $tPrnBarPdtClassCode  != ''
            || $tPrnBarPdtSubClassCode  != '' || $tPrnBarPdtGroupCode  != '' || $tPrnBarPdtComLinesCode  != ''
        ) {
            $nWhereST  = 1;
        } else {
            $nWhereST  = 0;
        }


        if ($bSeleteImport == 0) {
            $this->db->where('FTComName', $tFullHost);
            $this->db->delete('TCNTPrnLabelTmp');
            if ($tPrnBarSheet  != '') {
                if ($tPrnBarSheet == 'Promotion') {
                    $tSQLSelect = "  
           INSERT INTO TCNTPrnLabelTmp (FTComName,
            FTPdtCode,
            FTPdtName,
            FTBarCode,
            FCPdtPrice,
            FTPlcCode,
            FDPrnDate,
            FTPdtContentUnit,
            FTPlbCode,
            FNPlbQty,
            FTPbnDesc,
            FTPdtTime,
            FTPdtMfg,
            FTPdtImporter,
            FTPdtRefNo,
            FTPdtValue,
            FTPlbStaSelect,
            FTPlbStaImport
            )
            SELECT A.FTComName
            , A.FTPdtCode
            , A.FTPdtName
            , A.FTBarCode
            , A.FCPdtPrice
            , A.FTPlcCode
            , A.FDPrnDate
            , A.FTPdtContentUnit
            , A.FTPlbCode
            , A.FNPlbQty
            , A.FTPbnDesc
            , A.FTPdtTime
            , A.FTPdtMfg
            , A.FTPdtImporter
            , A.FTPdtRefNo
            , A.FTPdtValue
            , A.FTPlbStaSelect
            , A.FTPlbStaImport
            FROM(
                SELECT 
                      ROW_NUMBER () OVER (PARTITION BY PDT.FTPdtCode , BAR.FTBarCode ORDER BY PDT.FTPdtCode , BAR.FTBarCode ASC) as rtPackSizeMoreOne,
                    '$tFullHost' AS FTComName,
                                PDT.FTPdtCode,
                                PDTL.FTPdtName FTPdtName, 
                                BAR.FTBarCode,
                                ISNULL(PRI.FCPgdPriceRet,0) FCPdtPrice,
                                '' FTPlcCode,
                                GETDATE() FDPrnDate,
                                ISNULL(PCL.FTClrName,'') + ' ' + ISNULL(PSZ.FTPszName,'') FTPdtContentUnit,
                                '' AS FTPlbCode, 
                                $tPrnBarTotalPrint FNPlbQty,
                                ISNULL(PBNL.FTPbnName,'') FTPbnDesc,
                                'ดูที่ผลิตภัณฑ์' FTPdtTime, 
                                'ดูที่ผลิตภัณฑ์' FTPdtMfg,
                                'บริษัท คิง เพาเวอร์ คลิก จำกัด' FTPdtImporter,
                                PDG.FTPdgRegNo FTPdtRefNo,
                                PSZ.FTPszName FTPdtValue,
                                1 FTPlbStaSelect,
                                1 FTPlbStaImport
                FROM [TCNTPdtPmtHD] ProHD WITH(NOLOCK) 
                LEFT JOIN [TCNTPdtPmtDT] ProDT WITH(NOLOCK) ON ProHD.FTPmhDocNo = ProDT.FTPmhDocNo

                LEFT JOIN [TCNMPdt] Pdt WITH(NOLOCK) ON  Pdt.FTPdtCode = ProDT.FTPmdRefCode
                INNER JOIN TCNMPdtPackSize PPS with(nolock) ON PPS.FTPdtCode = PDT.FTPdtCode
                LEFT JOIN TCNMPdtUnit_L PUL WITH(NOLOCK) ON PUL.FTPunCode = PPS.FTPunCode AND PUL.FNLngID = $nLangPdtName
                LEFT JOIN TCNMPdtBar BAR with(nolock) ON BAR.FTPdtCode = PPS.FTPdtCode AND BAR.FTPunCode = PPS.FTPunCode
                LEFT JOIN TCNMPdt_L PDTL with(nolock) ON PDTL.FTPdtCode = PDT.FTPdtCode AND PDTL.FNLngID = $nLangPdtName
                LEFT JOIN (SELECT PRI.FTPdtCode,PRI.FTPunCode,PRI.FCPgdPriceRet FROM TCNTPdtPrice4PDT PRI with(nolock) 
                                    INNER JOIN (SELECT FTPdtCode,FTPunCode,MAX(FTPghDocNo) FTPghDocNo
                                    FROM TCNTPdtPrice4PDT with(nolock)
                                    WHERE CONVERT(VARCHAR(10),GETDATE(),121) BETWEEN FDPghDStart AND FDPghDStop
                                    AND FTPghDocType = '1' 
                                    GROUP BY FTPdtCode,FTPunCode) PRI2 ON PRI2.FTPdtCode = PRI.FTPdtCode AND PRI2.FTPunCode = PRI.FTPunCode 
                                    AND PRI2.FTPghDocNo = PRI.FTPghDocNo) PRI ON PRI.FTPdtCode = PDT.FTPdtCode AND BAR.FTPunCode = PRI.FTPunCode
                  LEFT JOIN
                                    (
                                        SELECT PRI.FTPdtCode, 
                                               PRI.FTPunCode, 
                                               PRI.FCPgdPriceRet
                                        FROM TCNTPdtPrice4PDT PRI WITH(NOLOCK)
                                             INNER JOIN
                                        (
                                            SELECT FTPdtCode, 
                                                   FTPunCode, 
                                                   MAX(FTPghDocNo) FTPghDocNo
                                            FROM TCNTPdtPrice4PDT WITH(NOLOCK)
                                            WHERE CONVERT(VARCHAR(10), GETDATE(), 121) BETWEEN FDPghDStart AND FDPghDStop
                                                  AND FTPghDocType = '2'
                                            GROUP BY FTPdtCode, 
                                                     FTPunCode
                                        ) PRI2 ON PRI2.FTPdtCode = PRI.FTPdtCode
                                                  AND PRI2.FTPunCode = PRI.FTPunCode
                                                  AND PRI2.FTPghDocNo = PRI.FTPghDocNo
                                    ) PRIPRO ON PRIPRO.FTPdtCode = PDT.FTPdtCode
                                                AND BAR.FTPunCode = PRIPRO.FTPunCode
                        LEFT JOIN TCNMPdtBrand_L PBNL with(nolock) ON PBNL.FTPbnCode = PDT.FTPbnCode AND PBNL.FNLngID = $nLangPdtName
                        LEFT JOIN TCNMPdtDrug PDG with(nolock) ON PDG.FTPdtCode = PDT.FTPdtCode
                        LEFT JOIN TCNMPdtSize_L PSZ with(nolock) ON PSZ.FTPszCode = PPS.FTPszCode AND PSZ.FNLngID = $nLangPdtName
                        LEFT JOIN TCNMPdtColor_L PCL with(nolock) ON PCL.FTClrCode = PPS.FTClrCode AND PCL.FNLngID = $nLangPdtName
                        LEFT JOIN TCNMPdtCategory CAT WITH(NOLOCK) ON PDT.FTPdtCode = CAT.FTPdtCode
               WHERE 1 = $nWhereST AND ProHD.FTPmhStaApv = 1 ";

                    if ($tPrnBarXthDocDateFrom != '' && $tPrnBarXthDocDateTo != '') {
                        $tSQLSelect .= "AND ProHD.FDCreateOn BETWEEN '$tPrnBarXthDocDateFrom 00:00:00.000' AND '$tPrnBarXthDocDateTo 23:59:59.000' ";
                    }

                    if ($tPrnBarBrowseRptNoFromCode != '' && $tPrnBarBrowseRptNoToCode != '') {
                        $tSQLSelect .= "AND ProDT.FTPmhDocNo BETWEEN '$tPrnBarBrowseRptNoFromCode' AND '$tPrnBarBrowseRptNoToCode' ";
                    }
                    $tSQLSelect .= ' ) AS A WHERE rtPackSizeMoreOne <= 1 ';
                } else if ($tPrnBarSheet == 'PriceAdjustmentSale') {
                    $tSQLSelect = "  
           INSERT INTO TCNTPrnLabelTmp (FTComName,
            FTPdtCode,
            FTPdtName,
            FTBarCode,
            FCPdtPrice,
            FTPlcCode,
            FDPrnDate,
            FTPdtContentUnit,
            FTPlbCode,
            FNPlbQty,
            FTPbnDesc,
            FTPdtTime,
            FTPdtMfg,
            FTPdtImporter,
            FTPdtRefNo,
            FTPdtValue,
            FTPlbStaSelect,
            FTPlbStaImport
            )
            SELECT A.FTComName
            , A.FTPdtCode
            , A.FTPdtName
            , A.FTBarCode
            , A.FCPdtPrice
            , A.FTPlcCode
            , A.FDPrnDate
            , A.FTPdtContentUnit
            , A.FTPlbCode
            , A.FNPlbQty
            , A.FTPbnDesc
            , A.FTPdtTime
            , A.FTPdtMfg
            , A.FTPdtImporter
            , A.FTPdtRefNo
            , A.FTPdtValue
            , A.FTPlbStaSelect
            , A.FTPlbStaImport
            FROM(
                SELECT 
                      ROW_NUMBER () OVER (PARTITION BY PDT.FTPdtCode , BAR.FTBarCode ORDER BY PDT.FTPdtCode , BAR.FTBarCode ASC) as rtPackSizeMoreOne,
          
            '$tFullHost' AS FTComName,
                                PDT.FTPdtCode,
                                PDTL.FTPdtName FTPdtName, 
                                BAR.FTBarCode,
                                ISNULL(PRI.FCPgdPriceRet,0) FCPdtPrice,
                                '' FTPlcCode,
                                GETDATE() FDPrnDate,
                                ISNULL(PCL.FTClrName,'') + ' ' + ISNULL(PSZ.FTPszName,'') FTPdtContentUnit,
                                '' AS FTPlbCode, 
                                $tPrnBarTotalPrint FNPlbQty,
                                ISNULL(PBNL.FTPbnName,'') FTPbnDesc,
                                'ดูที่ผลิตภัณฑ์' FTPdtTime, 
                                'ดูที่ผลิตภัณฑ์' FTPdtMfg,
                                'บริษัท คิง เพาเวอร์ คลิก จำกัด' FTPdtImporter,
                                PDG.FTPdgRegNo FTPdtRefNo,
                                PSZ.FTPszName FTPdtValue,
                                1 FTPlbStaSelect,
                                1  FTPlbStaImport
                FROM [TCNTPdtAdjPriHD]  AdpHD WITH(NOLOCK) 
                LEFT JOIN [TCNTPdtAdjPriDT]  AdpDT WITH(NOLOCK) ON AdpHD.FTXphDocNo = AdpDT.FTXphDocNo
                LEFT JOIN [TCNMPdt] Pdt WITH(NOLOCK) ON  PDT.FTPdtCode = AdpDT.FTPdtCode
                INNER JOIN TCNMPdtPackSize PPS with(nolock) ON PPS.FTPdtCode = PDT.FTPdtCode
                LEFT JOIN TCNMPdtUnit_L PUL WITH(NOLOCK) ON PUL.FTPunCode = PPS.FTPunCode AND PUL.FNLngID = 1
                LEFT JOIN TCNMPdtBar BAR with(nolock) ON BAR.FTPdtCode = PPS.FTPdtCode AND BAR.FTPunCode = PPS.FTPunCode
                        LEFT JOIN TCNMPdt_L PDTL with(nolock) ON PDTL.FTPdtCode = PDT.FTPdtCode AND PDTL.FNLngID = $nLangPdtName
                        LEFT JOIN (SELECT PRI.FTPdtCode,PRI.FTPunCode,PRI.FCPgdPriceRet FROM TCNTPdtPrice4PDT PRI with(nolock) 
                                    INNER JOIN (SELECT FTPdtCode,FTPunCode,MAX(FTPghDocNo) FTPghDocNo
                                    FROM TCNTPdtPrice4PDT with(nolock)
                                    WHERE CONVERT(VARCHAR(10),GETDATE(),121) BETWEEN FDPghDStart AND FDPghDStop
                                    AND FTPghDocType = '1' 
                                    GROUP BY FTPdtCode,FTPunCode) PRI2 ON PRI2.FTPdtCode = PRI.FTPdtCode AND PRI2.FTPunCode = PRI.FTPunCode 
                                    AND PRI2.FTPghDocNo = PRI.FTPghDocNo) PRI ON PRI.FTPdtCode = PDT.FTPdtCode AND BAR.FTPunCode = PRI.FTPunCode
                                    LEFT JOIN
                                    (
                                        SELECT PRI.FTPdtCode, 
                                               PRI.FTPunCode, 
                                               PRI.FCPgdPriceRet
                                        FROM TCNTPdtPrice4PDT PRI WITH(NOLOCK)
                                             INNER JOIN
                                        (
                                            SELECT FTPdtCode, 
                                                   FTPunCode, 
                                                   MAX(FTPghDocNo) FTPghDocNo
                                            FROM TCNTPdtPrice4PDT WITH(NOLOCK)
                                            WHERE CONVERT(VARCHAR(10), GETDATE(), 121) BETWEEN FDPghDStart AND FDPghDStop
                                                  AND FTPghDocType = '2'
                                            GROUP BY FTPdtCode, 
                                                     FTPunCode
                                        ) PRI2 ON PRI2.FTPdtCode = PRI.FTPdtCode
                                                  AND PRI2.FTPunCode = PRI.FTPunCode
                                                  AND PRI2.FTPghDocNo = PRI.FTPghDocNo
                                    ) PRIPRO ON PRIPRO.FTPdtCode = PDT.FTPdtCode
                                                AND BAR.FTPunCode = PRIPRO.FTPunCode
                        LEFT JOIN TCNMPdtBrand_L PBNL with(nolock) ON PBNL.FTPbnCode = PDT.FTPbnCode AND PBNL.FNLngID = 2
                        LEFT JOIN TCNMPdtDrug PDG with(nolock) ON PDG.FTPdtCode = PDT.FTPdtCode
                        LEFT JOIN TCNMPdtSize_L PSZ with(nolock) ON PSZ.FTPszCode = PPS.FTPszCode AND PSZ.FNLngID = $nLangPdtName
                        LEFT JOIN TCNMPdtColor_L PCL with(nolock) ON PCL.FTClrCode = PPS.FTClrCode AND PCL.FNLngID = $nLangPdtName
                        LEFT JOIN TCNMPdtCategory CAT WITH(NOLOCK) ON PDT.FTPdtCode = CAT.FTPdtCode
              
         WHERE 1 = $nWhereST AND AdpHD.FTXphStaApv = 1 ";

                    if ($tPrnBarXthDocDateFrom != '' && $tPrnBarXthDocDateTo != '') {
                        $tSQLSelect .= "AND AdpHD.FDXphDocDate BETWEEN '$tPrnBarXthDocDateFrom 00:00:00.000' AND '$tPrnBarXthDocDateTo 23:59:59.000' ";
                    }

                    if ($tPrnBarBrowseRptNoFromCode != '' && $tPrnBarBrowseRptNoToCode != '') {
                        $tSQLSelect .= "AND AdpDT.FTXphDocNo BETWEEN '$tPrnBarBrowseRptNoFromCode' AND '$tPrnBarBrowseRptNoToCode' ";
                    }
                    $tSQLSelect .= ' ) AS A WHERE rtPackSizeMoreOne <= 1 ';
                }
            } else {
                $tSQLSelect = " INSERT INTO TCNTPrnLabelTmp (FTComName,
            FTPdtCode,
            FTPdtName,
            FTBarCode,
            FCPdtPrice,
            FTPlcCode,
            FDPrnDate,
            FTPdtContentUnit,
            FTPlbCode,
            FNPlbQty,
            FTPbnDesc,
            FTPdtTime,
            FTPdtMfg,
            FTPdtImporter,
            FTPdtRefNo,
            FTPdtValue,
            FTPlbStaSelect,
            FTPlbStaImport
            -- FTPlbSellingUnit,
            -- FTPlbClrName,
            -- FTPlbPszName,
            -- FTPlbType
            )
            SELECT '$tFullHost' AS FTComName,
                                PDT.FTPdtCode,
                                PDTL.FTPdtName FTPdtName, 
                                BAR.FTBarCode,
                                ISNULL(PRI.FCPgdPriceRet,0) FCPdtPrice,
                                '' FTPlcCode,
                                GETDATE() FDPrnDate,
                                ISNULL(PCL.FTClrName,'') + ' ' + ISNULL(PSZ.FTPszName,'') FTPdtContentUnit,
                                '' AS FTPlbCode, 
                                $tPrnBarTotalPrint FNPlbQty,
                                ISNULL(PBNL.FTPbnName,'') FTPbnDesc,
                                'ดูที่ผลิตภัณฑ์' FTPdtTime, 
                                'ดูที่ผลิตภัณฑ์' FTPdtMfg,
                                'บริษัท คิง เพาเวอร์ คลิก จำกัด' FTPdtImporter,
                                PDG.FTPdgRegNo FTPdtRefNo,
                                PSZ.FTPszName FTPdtValue,
                                1 FTPlbStaSelect,
                                1 FTPlbStaImport
                                -- ISNULL(PUL.FTPunName, '') FTPlbSellingUnit,
    --                             ISNULL(PCL.FTClrName,'') FTPlbClrName,
    --                             ISNULL(PSZ.FTPszName,'') FTPlbPszName,
    --                             CASE
    --        WHEN ISNULL(PRIPRO.FCPgdPriceRet, 0) = 0
    --        THEN 'ราคาปกติ'
    --        ELSE 'ราคาโปรโมชั่น'
    --    END AS FTPlbType
            FROM TCNMPdt PDT with(nolock)
                        INNER JOIN TCNMPdtPackSize PPS with(nolock) ON PPS.FTPdtCode = PDT.FTPdtCode
                        LEFT JOIN TCNMPdtUnit_L PUL WITH(NOLOCK) ON PUL.FTPunCode = PPS.FTPunCode AND PUL.FNLngID = 1
                        LEFT JOIN TCNMPdtBar BAR with(nolock) ON BAR.FTPdtCode = PPS.FTPdtCode AND BAR.FTPunCode = PPS.FTPunCode
                        LEFT JOIN TCNMPdt_L PDTL with(nolock) ON PDTL.FTPdtCode = PDT.FTPdtCode AND PDTL.FNLngID = $nLangPdtName
                        LEFT JOIN (SELECT PRI.FTPdtCode,PRI.FTPunCode,PRI.FCPgdPriceRet FROM TCNTPdtPrice4PDT PRI with(nolock) 
                                    INNER JOIN (SELECT FTPdtCode,FTPunCode,MAX(FTPghDocNo) FTPghDocNo
                                    FROM TCNTPdtPrice4PDT with(nolock)
                                    WHERE CONVERT(VARCHAR(10),GETDATE(),121) BETWEEN FDPghDStart AND FDPghDStop
                                    AND FTPghDocType = '1' 
                                    GROUP BY FTPdtCode,FTPunCode) PRI2 ON PRI2.FTPdtCode = PRI.FTPdtCode AND PRI2.FTPunCode = PRI.FTPunCode 
                                    AND PRI2.FTPghDocNo = PRI.FTPghDocNo) PRI ON PRI.FTPdtCode = PDT.FTPdtCode AND BAR.FTPunCode = PRI.FTPunCode
                                    LEFT JOIN
(
    SELECT PRI.FTPdtCode, 
           PRI.FTPunCode, 
           PRI.FCPgdPriceRet
    FROM TCNTPdtPrice4PDT PRI WITH(NOLOCK)
         INNER JOIN
    (
        SELECT FTPdtCode, 
               FTPunCode, 
               MAX(FTPghDocNo) FTPghDocNo
        FROM TCNTPdtPrice4PDT WITH(NOLOCK)
        WHERE CONVERT(VARCHAR(10), GETDATE(), 121) BETWEEN FDPghDStart AND FDPghDStop
              AND FTPghDocType = '2'
        GROUP BY FTPdtCode, 
                 FTPunCode
    ) PRI2 ON PRI2.FTPdtCode = PRI.FTPdtCode
              AND PRI2.FTPunCode = PRI.FTPunCode
              AND PRI2.FTPghDocNo = PRI.FTPghDocNo
) PRIPRO ON PRIPRO.FTPdtCode = PDT.FTPdtCode
            AND BAR.FTPunCode = PRIPRO.FTPunCode
                        LEFT JOIN TCNMPdtBrand_L PBNL with(nolock) ON PBNL.FTPbnCode = PDT.FTPbnCode AND PBNL.FNLngID = 2
                        LEFT JOIN TCNMPdtDrug PDG with(nolock) ON PDG.FTPdtCode = PDT.FTPdtCode
                        -- LEFT JOIN TCNMPdtSize_L PSZ with(nolock) ON PSZ.FTPszCode = PPS.FTPszCode AND PSZ.FNLngID = 2
                        -- LEFT JOIN TCNMPdtColor_L PCL with(nolock) ON PCL.FTClrCode = PPS.FTClrCode AND PCL.FNLngID = 1 
                        LEFT JOIN TCNMPdtSize_L PSZ with(nolock) ON PSZ.FTPszCode = PPS.FTPszCode AND PSZ.FNLngID =   $nLangPdtName
                        LEFT JOIN TCNMPdtColor_L PCL with(nolock) ON PCL.FTClrCode = PPS.FTClrCode AND PCL.FNLngID =   $nLangPdtName
                        LEFT JOIN TCNMPdtCategory CAT WITH(NOLOCK) ON PDT.FTPdtCode = CAT.FTPdtCode
                        WHERE 1 = $nWhereST";
            }


            //กรองสินค้า
            if ($tPrnBarBrowsePdtFromCode != '' && $tPrnBarBrowsePdtToCode != '') {
                $tSQLSelect .= " AND Pdt.FTPdtCode Between  '$tPrnBarBrowsePdtFromCode' AND '$tPrnBarBrowsePdtToCode' ";
            }

            //กรองกลุ่มสินค้า
            if ($tPrnBarBrowsePdtGrpFromCode != '' && $tPrnBarBrowsePdtGrpToCode != '') {
                $tSQLSelect .= " AND Pdt.FTPgpChain Between  '$tPrnBarBrowsePdtGrpFromCode' AND '$tPrnBarBrowsePdtGrpToCode' ";
            }

            //กรองประเภทสินค้า
            if ($tPrnBarBrowsePdtTypeFromCode != '' && $tPrnBarBrowsePdtTypeToCode != '') {
                $tSQLSelect .= " AND Pdt.FTPtyCode Between  '$tPrnBarBrowsePdtTypeFromCode' AND '$tPrnBarBrowsePdtTypeToCode' ";
            }

            //กรองยี่ห้อ
            if ($tPrnBarBrowsePdtBrandFromCode != '' && $tPrnBarBrowsePdtBrandToCode != '') {
                $tSQLSelect .= " AND Pdt.FTPbnCode Between  '$tPrnBarBrowsePdtBrandFromCode' AND '$tPrnBarBrowsePdtBrandToCode' ";
            }

            //กรองรุ่น
            if ($tPrnBarBrowsePdtModelFromCode != '' && $tPrnBarBrowsePdtModelToCode != '') {
                $tSQLSelect .= " AND Pdt.FTPmoCode Between  '$tPrnBarBrowsePdtModelFromCode' AND '$tPrnBarBrowsePdtModelToCode' ";
            }

            //กรองหมวด 1
            if ($tPrnBarPdtDepartCode != '') {
                $tSQLSelect .= " AND Cat.FTPdtCat1 = '$tPrnBarPdtDepartCode' ";
            }

            //กรองหมวด 2
            if ($tPrnBarPdtClassCode != '') {
                $tSQLSelect .= " AND Cat.FTPdtCat2 = '$tPrnBarPdtClassCode' ";
            }

            //กรองหมวด 3
            if ($tPrnBarPdtSubClassCode != '') {
                $tSQLSelect .= " AND Cat.FTPdtCat3 = '$tPrnBarPdtSubClassCode' ";
            }

            //กรองหมวด 4
            if ($tPrnBarPdtGroupCode != '') {
                $tSQLSelect .= " AND Cat.FTPdtCat4 = '$tPrnBarPdtGroupCode' ";
            }

            //กรองหมวด 5
            if ($tPrnBarPdtComLinesCode != '') {
                $tSQLSelect .= " AND Cat.FTPdtCat5 = '$tPrnBarPdtComLinesCode' ";
            }





            $oQuerySelect = $this->db->query($tSQLSelect);
        }

        $tSQL = "   SELECT c.* FROM ( SELECT ROW_NUMBER() OVER( ORDER BY rtPrnBarImpDesc DESC,rtPrnBarCode ASC) AS rtRowID, * FROM (
                        SELECT  
                            FTPdtCode AS rtPrnBarCode, 
                            FTPdtName AS rtPrnBarName, 
                            FTPdtContentUnit AS rtPrnBarContentUnit, 
                            FTBarCode AS rtPrnBarBarCode,
                            FTPdtRefNo AS  rtPrnBarPriceType,
                            FCPdtPrice AS  rtPrnBarPrice,
                            FNPlbQty As  rtPrnBarQTY,
                            FTPlbStaSelect AS  rtPrnBarStaSelect,
                            FTPlbStaImport   AS     rtPrnBarStaImport, 
                            FTPlbImpDesc   AS    rtPrnBarImpDesc,
                            FTPbnDesc AS rtPrnBarPbnDesc
                            --    FTPlbSellingUnit AS rtPrnBarSellingUnit,
                            --    FTPlbType AS rtPrnBarPlbType
                        FROM TCNTPrnLabelTmp PLT WITH(NOLOCK)
                        WHERE FTComName = '$tFullHost' ";
        $tSearchList = $paData['tSearchAll'];

        $tSQL .= ") Base) AS c WHERE c.rtRowID > $aRowLen[0] AND c.rtRowID <= $aRowLen[1]";

        // print_r($tSQL);
        $oQuery = $this->db->query($tSQL);
        if ($oQuery->num_rows() > 0) {
            $oList = $oQuery->result();
            $aFoundRow = $this->FSnMPriBarGetPageAll(/*$tWhereCode,*/$tSearchList, $nLngID);
            $nFoundRow = $aFoundRow[0]->counts;
            $nPageAll = ceil($nFoundRow / $paData['nRow']); //หา Page All จำนวน Rec หาร จำนวนต่อหน้า
            $aResult = array(
                'raItems'       => $oList,
                'rnAllRow'      => $nFoundRow,
                'rnCurrentPage' => $paData['nPage'],
                'rnAllPage'     => $nPageAll,
                'rtCode'        => '1',
                'rtDesc'        => 'success',
            );
        } else {
            //No Data
            $aResult = array(
                'rnAllRow' => 0,
                'rnCurrentPage' => $paData['nPage'],
                "rnAllPage" => 0,
                'rtCode' => '800',
                'rtDesc' => 'data not found',
            );
        }

        $jResult = json_encode($aResult);
        $aResult = json_decode($jResult, true);
        return $aResult;
    }

    function FSaMPriBarListSearch($paData)
    {
        $tIP = $this->input->ip_address();
        $tFullHost = gethostbyaddr($tIP);

        // return null;
        $aRowLen    = FCNaHCallLenData($paData['nRow'], $paData['nPage']);
        $nLngID     = $paData['FNLngID'];


        $tSesAgnCode = $paData['tSesAgnCode'];
        $tSQL = "   SELECT c.* FROM ( SELECT ROW_NUMBER() OVER(ORDER BY rtPrnBarImpDesc DESC,rtPrnBarCode ASC) AS rtRowID, * FROM (
                        SELECT  
                            FTPdtCode AS rtPrnBarCode, 
                            FTPdtName AS rtPrnBarName, 
                            FTPdtContentUnit AS rtPrnBarContentUnit, 
                            FTBarCode AS rtPrnBarBarCode,
                            FTPdtRefNo AS  rtPrnBarPriceType,
                            FCPdtPrice AS  rtPrnBarPrice,
                            FNPlbQty As  rtPrnBarQTY,
                            FTPlbStaSelect AS  rtPrnBarStaSelect,
                            FTPlbStaImport   AS     rtPrnBarStaImport, 
                            FTPlbImpDesc   AS    rtPrnBarImpDesc   
                        FROM TCNTPrnLabelTmp PLT WITH(NOLOCK) 
                        WHERE FTComName =  '$tFullHost' ";

        $tSearchList = $paData['tSearchAll'];
        if ($tSearchList != '') {
            $tSQL .= " AND (FTPdtCode LIKE '%$tSearchList%'";
            $tSQL .= " OR FTPdtName LIKE '%$tSearchList%')";
        }
        $tSQL .= ") Base) AS c WHERE c.rtRowID > $aRowLen[0] AND c.rtRowID <= $aRowLen[1]";

        $oQuery = $this->db->query($tSQL);
        if ($oQuery->num_rows() > 0) {
            $oList = $oQuery->result();
            $aFoundRow = $this->FSnMPriBarGetPageAllSearch(/*$tWhereCode,*/$tSearchList, $nLngID);
            $nFoundRow = $aFoundRow[0]->counts;
            $nPageAll = ceil($nFoundRow / $paData['nRow']); //หา Page All จำนวน Rec หาร จำนวนต่อหน้า
            $aResult = array(
                'raItems'       => $oList,
                'rnAllRow'      => $nFoundRow,
                'rnCurrentPage' => $paData['nPage'],
                'rnAllPage'     => $nPageAll,
                'rtCode'        => '1',
                'rtDesc'        => 'success',
            );
        } else {
            //No Data
            $aResult = array(
                'rnAllRow' => 0,
                'rnCurrentPage' => $paData['nPage'],
                "rnAllPage" => 0,
                'rtCode' => '800',
                'rtDesc' => 'data not found',
            );
        }

        $jResult = json_encode($aResult);
        $aResult = json_decode($jResult, true);
        return $aResult;
    }

    public function FSnMPriBarGetPageAllSearch($ptSearchList, $ptLngID)
    {

        $tIP = $this->input->ip_address();
        $tFullHost = gethostbyaddr($tIP);

        $tSQL = "   SELECT COUNT (FTBarCode) AS counts
                    FROM TCNTPrnLabelTmp PLT WITH(NOLOCK)
                    WHERE FTComName =  '$tFullHost'";

        if ($ptSearchList != '') {
            $tSQL .= " AND (FTPdtCode LIKE '%$ptSearchList%'";
            $tSQL .= " OR FTPdtName LIKE '%$ptSearchList%')";
        }

        $oQuery = $this->db->query($tSQL);
        if ($oQuery->num_rows() > 0) {
            return $oQuery->result();
        } else {
            //No Data
            return false;
        }
    }




    /**
     * Functionality : All Page Of Printer BarCode
     * Parameters : $ptSearchList, $ptLngID
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : data
     * Return Type : array
     */
    public function FSnMPriBarGetPageAll($ptSearchList, $ptLngID)
    {

        $tIP = $this->input->ip_address();
        $tFullHost = gethostbyaddr($tIP);

        $tSQL = "SELECT COUNT (FTBarCode) AS counts
          FROM [TCNTPrnLabelTmp] PLT 
            WHERE 1=1 AND FTComName =  '$tFullHost'";


        $oQuery = $this->db->query($tSQL);
        if ($oQuery->num_rows() > 0) {
            return $oQuery->result();
        } else {
            //No Data
            return false;
        }
    }



    function FSaMPriBarUpdateEditInLine($nValue, $tPdtCode, $tPdtBarCode)
    {
        $tIP = $this->input->ip_address();
        $tFullHost = gethostbyaddr($tIP);

        $this->db->set('FNPlbQty', $nValue);
        $this->db->where('FTPdtCode', $tPdtCode);
        $this->db->where('FTBarCode',  $tPdtBarCode);
        $this->db->where('FTComName', $tFullHost);
        $this->db->update('TCNTPrnLabelTmp');
    }

    function FSaMPriBarUpdateCheckedAll($bCheckedAll)
    {
        $tIP = $this->input->ip_address();
        $tFullHost = gethostbyaddr($tIP);


        if ($bCheckedAll == 'true') {
            $bCheckedAllUp = 1;
        } else {
            $bCheckedAllUp = NULL;
        }
        $this->db->set('FTPlbStaSelect', $bCheckedAllUp);
        $this->db->where('FTComName', $tFullHost);
        $this->db->where('FTPlbStaImport', 1);
        $this->db->update('TCNTPrnLabelTmp');
    }

    function FSaMPriBarUpdateChecked($tValueChecked, $tPdtCode, $tBarCode)
    {
        $tIP = $this->input->ip_address();
        $tFullHost = gethostbyaddr($tIP);


        if ($tValueChecked == 'true') {
            $bCheckedUp = 1;
        } else {
            $bCheckedUp = NULL;
        }

        $this->db->set('FTPlbStaSelect', $bCheckedUp);
        $this->db->where('FTComName', $tFullHost);
        $this->db->where('FTPdtCode', $tPdtCode);
        $this->db->where('FTBarCode', $tBarCode);
        $this->db->update('TCNTPrnLabelTmp');
    }


    function FSaMPriBarUpdateLableCode($tPrnBarPrnLableCode)
    {

        $tIP = $this->input->ip_address();
        $tFullHost = gethostbyaddr($tIP);

        $this->db->set('FTPlbCode', $tPrnBarPrnLableCode);
        $this->db->where('FTComName', $tFullHost);
        $this->db->update('TCNTPrnLabelTmp');
    }


    function FSaMPriBarListDataMQ()
    {
        try {

            $tIP = $this->input->ip_address();
            $tFullHost = gethostbyaddr($tIP);


            $tSQL = "SELECT * FROM TCNTPrnLabelTmp WITH(NOLOCK) WHERE FTComName = '$tFullHost' AND  FTPlbStaSelect = '1' ";

            $oQuery = $this->db->query($tSQL);

            if ($oQuery->num_rows() > 0) {
                // $oDetail = $oQuery->row_array();
                $oDetail = $oQuery->result_array();
                $aResult = array(
                    'raItems'       => @$oDetail,
                    'rtCode'        => '1',
                    'rtDesc'        => 'success',
                );
            } else {
                //Not Found
                $aResult = array(
                    'rtCode' => '800',
                    'rtDesc' => 'data not found.',
                );
            }
            return $aResult;
        } catch (Exception $Error) {
            return $Error;
        }
    }



    function FSaMPriBarClearDataMQ()
    {
        $tIP = $this->input->ip_address();
        $tFullHost = gethostbyaddr($tIP);

        $this->db->where('FTComName', $tFullHost);
        $this->db->delete('TCNTPrnLabelTmp');
    }



    public function FSaMPRIGetTempData($paDataSearch)
    {
        $nLngID             = $paDataSearch['nLangEdit'];
        $tTableKey          = $paDataSearch['tTableKey'];
        $tSessionID         = $paDataSearch['tSessionID'];
        $tTextSearch        = $paDataSearch['tTextSearch'];

        $tSQL   = " SELECT
                        IMP.FNTmpSeq,
                        IMP.FTBchCode,
                        IMP.FTBchName,
                        IMP.FTAgnCode,
                        AGN_L.FTAgnName,
                        IMP.FTPplCode,
                        PRI_L.FTPplName,
                        IMP.FTTmpStatus,
                        IMP.FTTmpRemark
                    FROM TCNTImpMasTmp IMP WITH(NOLOCK)
                    LEFT JOIN TCNMAgency_L		AGN_L WITH(NOLOCK) ON IMP.FTAgnCode = AGN_L.FTAgnCode AND AGN_L.FNLngID = $nLngID
                    LEFT JOIN TCNMPdtPriList_L	PRI_L WITH(NOLOCK) ON IMP.FTPplCode = PRI_L.FTPplCode AND PRI_L.FNLngID = $nLngID
                    WHERE 1=1
                        AND IMP.FTSessionID     = '$tSessionID'
                        AND FTTmpTableKey       = '$tTableKey'
        ";

        if ($tTextSearch != '' || $tTextSearch != null) {
            $tSQL .= " AND (IMP.FTBchCode LIKE '%$tTextSearch%' ";
            $tSQL .= " OR IMP.FTBchName LIKE '%$tTextSearch%' ";
            $tSQL .= " OR IMP.FTAgnCode LIKE '%$tTextSearch%' ";
            $tSQL .= " OR AGN_L.FTAgnName LIKE '%$tTextSearch%' ";
            $tSQL .= " OR IMP.FTPplCode LIKE '%$tTextSearch%' ";
            $tSQL .= " OR PRI_L.FTPplName LIKE '%$tTextSearch%' ";
            $tSQL .= " )";
        }

        $tSQL .= " ORDER BY IMP.FTBchCode";

        $oQuery = $this->db->query($tSQL);
        if ($oQuery->num_rows() > 0) {
            $aStatus = array(
                'tCode'     => '1',
                'tDesc'     => 'success',
                'aResult'   => $oQuery->result_array(),
                'numrow'    => $oQuery->num_rows()
            );
        } else {
            $aStatus = array(
                'tCode'     => '99',
                'tDesc'     => 'Error',
                'aResult'   => array(),
                'numrow'    => 0
            );
        }
        return $aStatus;
    }

    //Functionality : Delete Import Branch
    //Parameters : function parameters
    //Create By : 09/07/2020 Napat(Jame)
    //Return : response
    //Return Type : array
    public function FSaMPRIImportDelete($paParamMaster)
    {
        try {
            $this->db->where_in('FNTmpSeq', $paParamMaster['FNTmpSeq']);
            $this->db->delete('TCNTImpMasTmp');

            if ($this->db->trans_status() === FALSE) {
                $aStatus = array(
                    'tCode' => '905',
                    'tDesc' => 'Cannot Delete Item.',
                );
            } else {
                $aStatus = array(
                    'tCode' => '1',
                    'tDesc' => 'Delete Complete.',
                );
            }
            return $aStatus;
        } catch (Exception $Error) {
            return $Error;
        }
    }

    public function FSaMPRIImportMove2Master($paDataSearch)
    {
        try {
            $nLngID         = $paDataSearch['nLangEdit'];
            $tTableKey      = $paDataSearch['tTableKey'];
            $tSessionID     = $paDataSearch['tSessionID'];
            $dDateOn        = $paDataSearch['dDateOn'];
            $tUserBy        = $paDataSearch['tUserBy'];

            $dBchDateStart  = $paDataSearch['dBchDateStart'];
            $dBchDateStop  = $paDataSearch['dBchDateStop'];

            $tSQL   = " INSERT INTO TCNMBranch (
                            FTBchCode,FTAgnCode,FTPplCode,FTWahCode,FTBchType,FTBchPriority,FTBchStaActive,
                            FDBchStart,FDBchStop,FDBchSaleStart,FDBchSaleStop,
                            FDLastUpdOn,FTLastUpdBy,FDCreateOn,FTCreateBy
                        )
                        SELECT
                            IMP.FTBchCode,
                            IMP.FTAgnCode,
                            IMP.FTPplCode,
                            '00001',
                            CASE WHEN ISNULL(IMP.FTAgnCode,'') = '' THEN '1' ELSE '4' END AS FTBchType,
                            '1',
                            '1',
                            '$dBchDateStart',
                            '$dBchDateStop',
                            '$dBchDateStart',
                            '$dBchDateStop',
                            '$dDateOn',
                            '$tUserBy',
                            '$dDateOn',
                            '$tUserBy'
                        FROM TCNTImpMasTmp IMP WITH(NOLOCK)
                        WHERE IMP.FTSessionID       = '$tSessionID'
                          AND IMP.FTTmpTableKey     = '$tTableKey'
                          AND IMP.FTTmpStatus       = '1'
            ";
            $this->db->query($tSQL);

            $tSQL   = " INSERT INTO TCNMBranch_L (FTBchCode,FNLngID,FTBchName)
                        SELECT
                            IMP.FTBchCode,
                            $nLngID,
                            IMP.FTBchName
                        FROM TCNTImpMasTmp IMP WITH(NOLOCK)
                        WHERE IMP.FTSessionID       = '$tSessionID'
                          AND IMP.FTTmpTableKey     = '$tTableKey'
                          AND IMP.FTTmpStatus       = '1'
            ";
            $this->db->query($tSQL);

            if ($this->db->trans_status() === FALSE) {
                $aStatus = array(
                    'tCode'     => '99',
                    'tDesc'     => 'Error'
                );
            } else {
                $aStatus = array(
                    'tCode'     => '1',
                    'tDesc'     => 'success'
                );
            }
            return $aStatus;
        } catch (Exception $Error) {
            return $Error;
        }
    }

    //เพิ่มคลังกรณี import file สาขา
    public function FSaMPRIImportMove2MasterAndInsWah($paDataSearch)
    {
        try {
            $tSessionID     = $paDataSearch['tSessionID'];
            $dDateOn        = $paDataSearch['dDateOn'];
            $tUserBy        = $paDataSearch['tUserBy'];
            $tTableKey      = $paDataSearch['tTableKey'];

            //Insert ลงตาราง TCNMWaHouse
            $tSQL   = " INSERT INTO TCNMWaHouse (FTBchCode,FTWahCode,FTWahStaType,FTWahRefCode,FTWahStaChkStk,FTWahStaPrcStk,FDCreateOn,FTCreateBy,FDLastUpdOn,FTLastUpdBy)
                        SELECT PACKDATA.*
                        FROM TCNTImpMasTmp Tmp
                        CROSS APPLY (
                            VALUES
                                (FTBchCode,'00001',1,FTBchCode,'1','2','$dDateOn','$tUserBy','$dDateOn','$tUserBy')
                        ) PACKDATA (FTBchCode,FTWahCode,FTWahStaType,FTWahRefCode,FTWahStaChkStk,FTWahStaPrcStk,FDCreateOn,FTCreateBy,FDLastUpdOn,FTLastUpdBy)
                        WHERE Tmp.FTSessionID = '$tSessionID' AND Tmp.FTTmpStatus = '1' ";
            /*
                        , (FTBchCode,'00002',1,FTBchCode,'$dDateOn','$tUserBy','$dDateOn','$tUserBy')
                        , (FTBchCode,'00003',1,FTBchCode,'$dDateOn','$tUserBy','$dDateOn','$tUserBy')
                        */
            $this->db->query($tSQL);

            //Insert ลงตาราง TCNMWaHouse_L
            $tSQL   = " INSERT INTO TCNMWaHouse_L (FTBchCode,FTWahCode,FNLngID,FTWahName)
                        SELECT PACKDATA.*
                        FROM TCNTImpMasTmp Tmp
                        CROSS APPLY (
                            VALUES
                                (FTBchCode,'00001','1','คลังขาย'),
                                (FTBchCode,'00001','2','Sales Warehouse')
                        ) PACKDATA (FTBchCode,FTWahCode,FNLngID,FTWahName)
                        WHERE Tmp.FTSessionID = '$tSessionID' AND Tmp.FTTmpStatus = '1' ";
            /*
                        , (FTBchCode,'00002','1','คลังของเสีย')
                        , (FTBchCode,'00003','1','คลังของแถม')
                        , (FTBchCode,'00002','2','Waste warehouse')
                        , (FTBchCode,'00003','2','Free inventory')
                        */
            $this->db->query($tSQL);
        } catch (Exception $Error) {
            return $Error;
        }
    }

    //เช็คกรณีข้อมูลซ้ำ
    public function FSaMPRIImportMove2MasterAndReplaceOrInsert($paDataSearch)
    {
        try {
            $tSessionID         = $paDataSearch['tSessionID'];
            $dDateOn            = $paDataSearch['dDateOn'];
            $tUserBy            = $paDataSearch['tUserBy'];
            $tTableKey          = $paDataSearch['tTableKey'];
            $tTypeCaseDuplicate = $paDataSearch['tTypeCaseDuplicate'];
            $nLngID             = $paDataSearch['nLangEdit'];
            $dBchDateStart      = $paDataSearch['dBchDateStart'];
            $dBchDateStop       = $paDataSearch['dBchDateStop'];

            if ($tTypeCaseDuplicate == 2) {
                //อัพเดทรายการเดิม

                //อัพเดทชื่อที่ตาราง L
                $tSQLUpdate_L = "UPDATE
                                    TCNMBranch_L
                                SET
                                    TCNMBranch_L.FTBchName = TCNTImpMasTmp.FTBchName
                                FROM
                                    TCNMBranch_L
                                INNER JOIN
                                    TCNTImpMasTmp
                                ON
                                    TCNMBranch_L.FTBchCode = TCNTImpMasTmp.FTBchCode
                                WHERE
                                    TCNTImpMasTmp.FTSessionID = '$tSessionID'
                                AND TCNTImpMasTmp.FTTmpTableKey = 'TCNMBranch'
                                AND TCNTImpMasTmp.FTTmpStatus = '6' ";
                $this->db->query($tSQLUpdate_L);

                //อัพเดทตัวแทนขาย กับ กลุ่มราคา
                $tSQLUpdate = "UPDATE
                                    TCNMBranch
                                SET
                                    TCNMBranch.FTPplCode = TCNTImpMasTmp.FTPplCode,
                                    TCNMBranch.FTAgnCode = TCNTImpMasTmp.FTAgnCode,
                                    TCNMBranch.FDLastUpdOn = '$dDateOn',
                                    TCNMBranch.FTLastUpdBy = '$tUserBy'
                                FROM
                                    TCNMBranch
                                INNER JOIN
                                    TCNTImpMasTmp
                                ON
                                    TCNMBranch.FTBchCode = TCNTImpMasTmp.FTBchCode
                                WHERE
                                    TCNTImpMasTmp.FTSessionID = '$tSessionID'
                                AND TCNTImpMasTmp.FTTmpTableKey = 'TCNMBranch'
                                AND TCNTImpMasTmp.FTTmpStatus = '6' ";
                $this->db->query($tSQLUpdate);
            } else if ($tTypeCaseDuplicate == 1) {
                //ใช้รายการใหม่

                //ลบข้อมูลในตาราง L
                $tSQLDeleteBch_L = "DELETE FROM TCNMBranch_L WHERE FTBchCode IN (
                                    SELECT FTBchCode
                                    FROM TCNTImpMasTmp
                                    WHERE FTSessionID = '$tSessionID' AND FTTmpStatus = 6 AND FTTmpTableKey = 'TCNMBranch'
                                )";
                $this->db->query($tSQLDeleteBch_L);

                //ลบข้อมูลในตารางจริง
                $tSQLDeleteBch = "DELETE FROM TCNMBranch WHERE FTBchCode IN (
                                        SELECT FTBchCode
                                        FROM TCNTImpMasTmp
                                        WHERE FTSessionID = '$tSessionID' AND FTTmpStatus = 6 AND FTTmpTableKey = 'TCNMBranch'
                                    )";
                $this->db->query($tSQLDeleteBch);



                //เพิ่มข้อมูลที่เป็น BCH Type 6
                $tSQL   = " INSERT INTO TCNMBranch (
                                FTBchCode,FTAgnCode,FTPplCode,FTWahCode,
                                FDBchStart,FDBchStop,FDBchSaleStart,FDBchSaleStop,
                                FDLastUpdOn,FTLastUpdBy,FDCreateOn,FTCreateBy
                            )
                            SELECT
                                IMP.FTBchCode,
                                IMP.FTAgnCode,
                                IMP.FTPplCode,
                                '',
                                '$dBchDateStart',
                                '$dBchDateStop',
                                '$dBchDateStart',
                                '$dBchDateStop',
                                '$dDateOn',
                                '$tUserBy',
                                '$dDateOn',
                                '$tUserBy'
                            FROM TCNTImpMasTmp IMP WITH(NOLOCK)
                            WHERE IMP.FTSessionID     = '$tSessionID'
                            AND IMP.FTTmpTableKey     = '$tTableKey'
                            AND IMP.FTTmpStatus       = '6'
                ";
                $this->db->query($tSQL);

                //เพิ่มข้อมูลที่เป็น BCH_L Type 6
                $tSQL   = " INSERT INTO TCNMBranch_L (FTBchCode,FNLngID,FTBchName)
                            SELECT
                                IMP.FTBchCode,
                                $nLngID,
                                IMP.FTBchName
                            FROM TCNTImpMasTmp IMP WITH(NOLOCK)
                            WHERE IMP.FTSessionID       = '$tSessionID'
                            AND IMP.FTTmpTableKey     = '$tTableKey'
                            AND IMP.FTTmpStatus       = '6'
                ";
                $this->db->query($tSQL);
            }
        } catch (Exception $Error) {
            return $Error;
        }
    }

    //ลบข้อมูลใน Temp
    public function FSaMPRIImportMove2MasterDeleteTemp($paDataSearch)
    {
        try {
            $tSessionID     = $paDataSearch['tSessionID'];
            $dDateOn        = $paDataSearch['dDateOn'];
            $tUserBy        = $paDataSearch['tUserBy'];
            $tTableKey      = $paDataSearch['tTableKey'];

            // ลบรายการใน Temp
            $this->db->where('FTSessionID', $tSessionID);
            $this->db->where('FTTmpTableKey', $tTableKey);
            $this->db->delete('TCNTImpMasTmp');
        } catch (Exception $Error) {
            return $Error;
        }
    }

    //Get ข้อมูลใน Temp ทั้งหมด
    public function FSaMPRIGetTempDataAtAll()
    {
        try {
            $tSesSessionID = $this->session->userdata("tSesSessionID");
            $tSQL   = "SELECT TOP 1
                        (SELECT COUNT(FTTmpTableKey) AS TYPESIX FROM TCNTImpMasTmp IMP
                        WHERE IMP.FTSessionID     = '$tSesSessionID'
                        AND IMP.FTTmpTableKey     = 'TCNMBranch'
                        AND IMP.FTTmpStatus       = '6') AS TYPESIX ,

                        (SELECT COUNT(FTTmpTableKey) AS TYPEONE FROM TCNTImpMasTmp IMP
                        WHERE IMP.FTSessionID     = '$tSesSessionID'
                        AND IMP.FTTmpTableKey     = 'TCNMBranch'
                        AND IMP.FTTmpStatus       = '1') AS TYPEONE ,

                        (SELECT COUNT(FTTmpTableKey) AS TYPEONE FROM TCNTImpMasTmp IMP
                        WHERE IMP.FTSessionID     = '$tSesSessionID'
                        AND IMP.FTTmpTableKey     = 'TCNMBranch'
                        ) AS ITEMALL
                    FROM TCNTImpMasTmp ";
            $oQuery = $this->db->query($tSQL);
            return $oQuery->result_array();
        } catch (Exception $Error) {
            return $Error;
        }
    }
}
