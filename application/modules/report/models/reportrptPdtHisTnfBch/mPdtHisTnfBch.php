<?php defined('BASEPATH') or exit('No direct script access allowed');

class mPdtHisTnfBch extends CI_Model{

    // Functionality: Call Stored Procedure
    // Parameters:  Function Parameter
    // Creator: 15/07/2019 Wasin(Yoshi)
    // Last Modified : -
    // Return : Status Return Call Stored Procedure
    // Return Type: Array
    public function FSnMExecStoreReport($paDataFilter){
        // สาขา
        $tBchCodeSelect = ($paDataFilter['bBchStaSelectAll']) ? '' : FCNtAddSingleQuote($paDataFilter['tBchCodeSelect']); 
        // ร้านค้า
        $tShpCodeSelect = ($paDataFilter['bShpStaSelectAll']) ? '' : FCNtAddSingleQuote($paDataFilter['tShpCodeSelect']);
        // กลุ่มธุรกิจ
        $tMerCodeSelect = ($paDataFilter['bMerStaSelectAll']) ? '' : FCNtAddSingleQuote($paDataFilter['tMerCodeSelect']);
        // ประเภทเครื่องจุดขาย
        // $tPosCodeSelect = ($paDataFilter['bPosStaSelectAll']) ? '' : $paDataFilter['tPosCodeSelect'];

        $tCallStore = "{ CALL SP_RPTxPdtHisTnfBch(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) }";

        $aDataStore = array(
            'pnLngID'       => $paDataFilter['nLangID'],
            'pnComName'     => $paDataFilter['tCompName'],
            'ptRptCode'     => $paDataFilter['tRptCode'],
            'ptUsrSession'  => $paDataFilter['tSessionID'],

            'pnFilterType'  => $paDataFilter['tTypeSelect'],
            'ptBchL'        => $tBchCodeSelect,
            'ptMerL'        => $tMerCodeSelect,
            'ptShpL'        => $tShpCodeSelect,
            'ptWahF'        => $paDataFilter['tWahCodeFrom'],
            'ptWahT'        => $paDataFilter['tWahCodeTo'],
            'ptPdtF'        => $paDataFilter['tPdtCodeFrom'],
            'ptPdtT'        => $paDataFilter['tPdtCodeTo'],
            'ptDocDateF'    => $paDataFilter['tDocDateFrom'],
            'ptDocDateT'    => $paDataFilter['tDocDateTo'],
            'FNResult'      => 0
        );

        $oQuery = $this->db->query($tCallStore, $aDataStore);

        if($oQuery !== FALSE){
            unset($oQuery);
            return 1;
        }else{
            unset($oQuery);
            return 0;
        }
        
    }

    
    // Functionality: Call Stored Procedure
    // Parameters:  Function Parameter
    // Creator: 18/07/2019 Wasin(Yoshi)
    // Last Modified : -
    // Return : Status Return Call Stored Procedure
    // Return Type: Array
    public function FSaMGetDataReport($paDataWhere){

        $nPage      =  $paDataWhere['nPage'];

        // Call Data Pagination
        $aPagination    = $this->FMaMRPTPagination($paDataWhere);

        $nRowIDStart    = $aPagination["nRowIDStart"];
        $nRowIDEnd      = $aPagination["nRowIDEnd"];
        $nTotalPage     = $aPagination["nTotalPage"];

        $tComName       = $paDataWhere['tCompName'];
        $tRptCode       = $paDataWhere['tRptCode'];
        $tUsrSession    = $paDataWhere['tUsrSessionID'];

        // Set Priority
        $this->FMxMRPTSetPriorityGroup($paDataWhere);

        // Check ว่าเป็นหน้าสุดท้ายหรือไม่ ถ้าเป็นหน้าสุดท้ายให้ไป Sum footer ข้อมูลมา
        if($nPage == $nTotalPage){
            $tJoinFoooter = "  
                    SELECT 
                    FTUsrSession            AS FTUsrSession_Footer,
                    SUM(FCXidQty)           AS FCXidQty_Footer
                FROM TRPTPdtHisTnfBchTmp WITH(NOLOCK)
                WHERE 1=1
                AND FTComName       = '$tComName'
                AND FTRptCode       = '$tRptCode'
                AND FTUsrSession    = '$tUsrSession'
                GROUP BY FTUsrSession ) T ON L.FTUsrSession = T.FTUsrSession_Footer
            ";
        }else{
            // ถ้าไม่ใช่ให้ Select 0 เพื่อให้ Join ได้แต่จะไม่มีการ Sum
            $tJoinFoooter = "   
                SELECT
                    '$tUsrSession'  AS FTUsrSession_Footer,
                    '0'             AS FCXidQty_Footer
                ) T ON  L.FTUsrSession = T.FTUsrSession_Footer
                
            ";
        }

        // L = List ข้อมูลทั้งหมด
        // A = SaleDT
        // S = Misures Summary
        $tSQL  = "  SELECT 
                        L.*,
                        T.FCXidQty_Footer
                    FROM (
                        SELECT
                            ROW_NUMBER() OVER(ORDER BY FTPdtCode ASC) AS RowID ,
                            A.*,
                            S.FNRptGroupMember,
                            S.FCXidQty_SubFooter
                    FROM TRPTPdtHisTnfBchTmp A WITH(NOLOCK)
                    /* Calculate Misures */
                    LEFT JOIN (
                        SELECT 
                            FTPdtCode         AS FTPdtCode_SUM,
                            COUNT(FTPdtCode)  AS FNRptGroupMember,
                            SUM(FCXidQty)     AS FCXidQty_SubFooter
                    FROM TRPTPdtHisTnfBchTmp A WITH(NOLOCK)
                    WHERE 1=1
                    AND FTComName       = '$tComName'
                    AND FTRptCode       = '$tRptCode'
                    AND FTUsrSession    = '$tUsrSession'
                    GROUP BY FTPdtCode
                ) AS S ON A.FTPdtCode = S.FTPdtCode_SUM
                WHERE A.FTComName       = '$tComName'
                AND   A.FTRptCode       = '$tRptCode'
                AND   A.FTUsrSession    = '$tUsrSession'
                /* End Calculate Misures */
                ) AS L
                    LEFT JOIN (
            " . $tJoinFoooter . "
        ";

        // WHERE เงื่อนไข Page
        $tSQL .= " WHERE L.RowID > $nRowIDStart AND L.RowID <= $nRowIDEnd ";

        //สั่ง Order by ตามข้อมูลหลัก
        $tSQL .= " ORDER BY L.FTPdtCode";

        $oQuery = $this->db->query($tSQL);

        if ($oQuery->num_rows() > 0) {
            $aData = $oQuery->result_array();
        } else {
            $aData = NULL;
        }

        $aErrorList = array(
            "nErrInvalidPage" => ""
        );

        $aResualt = array(
            "aPagination" => $aPagination,
            "aRptData" => $aData,
            "aError" => $aErrorList
        );
        unset($oQuery);
        unset($aData);
        return $aResualt;
    }

    // Functionality: Get Data Page Co
    // Parameters:  Function Parameter
    // Creator: 18/07/2019 Wasin(Yoshi)
    // Last Modified : -
    // Return : Array Data Page Nation
    // Return Type: Array
    public function FMaMRPTPagination($paDataWhere){

        $tComName       = $paDataWhere['tCompName'];
        $tRptCode       = $paDataWhere['tRptCode'];
        $tUsrSession    = $paDataWhere['tUsrSessionID'];

        $tSQL = "
            SELECT 
                    COUNT(TMP.FTPdtCode) AS rnCountPage
                FROM TRPTPdtHisTnfBchTmp TMP WITH(NOLOCK)
                WHERE 1=1
                AND TMP.FTComName    = '$tComName'
                AND TMP.FTRptCode    = '$tRptCode'
                AND TMP.FTUsrSession = '$tUsrSession'
        ";

        $oQuery = $this->db->query($tSQL);
        $nRptAllRecord = $oQuery->row_array()['rnCountPage'];

        $nPage      = $paDataWhere['nPage'];
        $nPerPage   = $paDataWhere['nPerPage'];
        $nPrevPage  = $nPage - 1;
        $nNextPage  = $nPage + 1;
        $nRowIDStart = (($nPerPage * $nPage) - $nPerPage); //RowId Start

        if ($nRptAllRecord <= $nPerPage) {
            $nTotalPage = 1;
        } else if (($nRptAllRecord % $nPerPage) == 0) {
            $nTotalPage = ($nRptAllRecord / $nPerPage);
        } else {
            $nTotalPage = ($nRptAllRecord / $nPerPage) + 1;
            $nTotalPage = (int) $nTotalPage;
        }

        // get rowid end
        $nRowIDEnd = $nPerPage * $nPage;
        if ($nRowIDEnd > $nRptAllRecord) {
            $nRowIDEnd = $nRptAllRecord;
        }
  
        $aRptMemberDet = array(
            "nTotalRecord"  => $nRptAllRecord,
            "nTotalPage"    => $nTotalPage,
            "nDisplayPage"  => $paDataWhere['nPage'],
            "nRowIDStart"   => $nRowIDStart,
            "nRowIDEnd"     => $nRowIDEnd,
            "nPrevPage"     => $nPrevPage,
            "nNextPage"     => $nNextPage
        );
        unset($oQuery);
        return $aRptMemberDet;
    }

    // Functionality: Get Data Page Co
    // Parameters:  Function Parameter
    // Creator: 18/07/2019 Wasin(Yoshi)
    // Last Modified : -
    // Return : Array Data Page Nation
    // Return Type: Array
    public function FMxMRPTSetPriorityGroup($paDataWhere){
        $tComName       = $paDataWhere['tCompName'];
        $tRptCode       = $paDataWhere['tRptCode'];
        $tUsrSession    = $paDataWhere['tUsrSessionID'];

        $tSQL   = " UPDATE TRPTPdtHisTnfBchTmp
                        SET FNRowPartID = B.PartID
                    FROM(
                        SELECT
                            ROW_NUMBER() OVER(PARTITION BY FTPdtCode ORDER BY FTPdtCode DESC) AS PartID,
                            FTRptRowSeq
                        FROM TRPTPdtHisTnfBchTmp TMP WITH(NOLOCK)
                        WHERE TMP.FTComName     = '$tComName' 
                        AND TMP.FTRptCode       = '$tRptCode'
                        AND TMP.FTUsrSession    = '$tUsrSession'
                    ) AS B
                    WHERE TRPTPdtHisTnfBchTmp.FTRptRowSeq = B.FTRptRowSeq
                    AND TRPTPdtHisTnfBchTmp.FTComName      = '$tComName'
                    AND TRPTPdtHisTnfBchTmp.FTRptCode      = '$tRptCode'
                    AND TRPTPdtHisTnfBchTmp.FTUsrSession   = '$tUsrSession'
                ";
        $this->db->query($tSQL);
    }   







}
