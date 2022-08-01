<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class mCommon extends CI_Model {
    //Functionality : Function Update Password User Login
    //Parameters : usrlogin , oldpass , newpass
    //Creator : 13/05/2020 Napat(Jame)
    // Last Update : 16/11/2020 Napat(Jame) เพิ่มการตรวจสอบ Error Message
    //Last Modified : -
    //Return : Status Update Password
    //Return Type : Array
    public function FCNaMCMMChangePassword($paPackData){
        try{


            $tSQL = "   SELECT TOP 1
                            A.*,
                            CASE 
                                WHEN ISNULL(B.FTUsrLogin,'')     = '' THEN '999'  /*ไม่พบชื่อผู้ใช้*/
                                WHEN ISNULL(C.FTUsrLoginPwd,'')  = '' THEN '998'  /*รหัสผ่านเดิมไม่ถูกต้อง*/
                                WHEN ISNULL(B.FTUsrStaActive,'') = '2' THEN '997' /*สถานะไม่ใช้งาน ไม่สามารถเปลี่ยนรหัสผ่าน*/
                                WHEN CONVERT(VARCHAR(10),GETDATE(),121) > CONVERT(VARCHAR(10),B.FDUsrPwdExpired,121) THEN '996' /*หมดอายุไม่สามารถเปลี่ยนรหัสผ่าน*/
                                ELSE '0'
                            END AS FTErrMsg 
                        FROM (
                            SELECT '1' AS Seq
                        ) A
                        LEFT JOIN TCNMUsrLogin B WITH(NOLOCK) ON B.FTUsrLogin = '".$paPackData['FTUsrLogin']."' AND B.FTUsrLogType  = '".$paPackData['tStaLogType']."'
                        LEFT JOIN TCNMUsrLogin C WITH(NOLOCK) ON C.FTUsrLogin = '".$paPackData['FTUsrLogin']."' AND C.FTUsrLoginPwd = '".$paPackData['tPasswordOld']."'
                    ";

            $oQuery     = $this->db->query($tSQL);
            $aListData  = $oQuery->result_array();

            if( $aListData[0]['FTErrMsg'] == '0' ){
                // ถ้าส่ง parameters UsrStaActive = 3 คือ เปลี่ยนรหัสผ่าน ครั้งแรก
                // ให้ปรับสถานะ = 1 เพื่อเริ่มใช้งาน
                if($paPackData['nChkUsrSta'] == 3){
                    $this->db->set('FTUsrStaActive'  , '1');
                }

                $this->db->set('FTUsrLoginPwd'  , $paPackData['tPasswordNew']);
                $this->db->where('FTUsrLogin'  , $paPackData['FTUsrLogin']);
                $this->db->where('FTUsrLoginPwd'  , $paPackData['tPasswordOld']);
                $this->db->update('TCNMUsrLogin');

                if($this->db->affected_rows() > 0){
                    $aStatus = array(
                        'nCode'     => 1,
                        'tDesc'     => 'Update Password Success',
                    );
                }else{
                    $aStatus = array(
                        'nCode'     => 905,
                        'tDesc'     => 'Error Cannot Update Password.',
                    );
                }
            }else{
                $aStatus = array(
                    'nCode'     => $aListData[0]['FTErrMsg'],
                    'tDesc'     => 'Data false',
                );
            }
            return $aStatus;
        }catch(Exception $Error){
            return $Error;
        }
    }

    //Delete
    public function FCNaMCMMDeleteTmpExcelCasePDT($paPackData){
        try{    
            $aWhere = array('TCNMPdt','TCNMPdtUnit','TCNMPdtBrand','TCNMPdtTouchGrp','TCNMPdtType','TCNMPdtModel','TCNMPdtGrp','TCNMPdtSpcBch');
            $this->db->where_in('FTTmpTableKey' , $aWhere);
            $this->db->where_in('FTSessionID'   , $paPackData['tSessionID']);
            $this->db->delete($paPackData['tTableNameTmp']); 
        }catch(Exception $Error){
            return $Error;
        }
    }

    //Import Excel To Temp
    public function FCNaMCMMImportExcelToTmp($paPackData,$poIns){
        try{    

            $tTableNameTmp      = $paPackData['tTableNameTmp'];
            $tNameModule        = $paPackData['tNameModule'];
            $tTypeModule        = $paPackData['tTypeModule']; 
            $tFlagClearTmp      = $paPackData['tFlagClearTmp']; 
            $tTableRefPK        = $paPackData['tTableRefPK']; 



            //ลบข้อมูลทั้งหมดก่อน
            if($tTypeModule == 'document' && $tFlagClearTmp == 1){
                //ลบช้อมูลของ document
                if ($tTableNameTmp == 'TCNTPrnLabelTmp') {
                    $tIP = $this->input->ip_address();
                    $tFullHost = gethostbyaddr($tIP);
                    $this->db->where_in('FTComName', $tFullHost);
                    $this->db->delete($tTableNameTmp);
                } else {
                    $this->db->where_in('FTXthDocKey'   , $tTableRefPK);
                    $this->db->where_in('FTSessionID'   , $paPackData['tSessionID']);
                    $this->db->delete($tTableNameTmp);
                }
            }else if($tTypeModule == 'master'){
                //ลบข้อมูลของ master
                if($tNameModule != 'product'){
                    $this->db->where_in('FTTmpTableKey' , $tTableRefPK);
                    $this->db->where_in('FTSessionID'   , $paPackData['tSessionID']);
                    $this->db->delete($tTableNameTmp);  
                }
            }
           
            //เพิ่มข้อมูล
            $this->db->insert_batch($tTableNameTmp, $poIns);
            /*เพิ่มข้อมูล
             $tNameProject   = explode('/', $_SERVER['REQUEST_URI'])[1];
             $tPathFileBulk  = $_SERVER['DOCUMENT_ROOT'].'/'.$tNameProject.'/application/modules/common/assets/writeFileImport/FileImport_Branch.txt';
             $tSQL = "BULK INSERT dbo.TCNTImpMasTmp FROM '".$tPathFileBulk."'
                     WITH
                     (
                         FIELDTERMINATOR=',',
                         ROWTERMINATOR = '\n'
            )";*/
        }catch(Exception $Error){
            return $Error;
        }
    }

    //Import Excel To Temp
    public function FCNaMCMMImportExcelToFhnTmp($paPackData,$poIns){
        try{    

            $tTableFhnNameTmp   = $paPackData['tTableFhnNameTmp'];
            $tNameModule        = $paPackData['tNameModule'];
            $tTypeModule        = $paPackData['tTypeModule']; 
            $tFlagClearTmp      = $paPackData['tFlagClearTmp']; 
            $tTableRefPK        = $paPackData['tTableRefPK']; 

                //ลบช้อมูลของ document
                $this->db->where_in('FTXthDocKey'   , $tTableRefPK);
                $this->db->where_in('FTSessionID'   , $paPackData['tSessionID']);
                $this->db->delete($tTableFhnNameTmp);
  
           
            //เพิ่มข้อมูล
            $this->db->insert_batch($tTableFhnNameTmp, $poIns);

        }catch(Exception $Error){
            return $Error;
        }
    }


    /**
     * Functionality: ตรวจสอบข้อมูลสินค้าจากรหัสบาร์โค้ด
     * Parameters: Array เงื่อนไขการเช็คค่า [$paParams]
     * Creator: 21/04/2022 ์ฟสำ
     * Last Modified: -
     * Return: Statuss
     * Return Type: Number
    */
    public function FCNaMCMMImportExcelFindPdtInfoByBarCode($paData){
        $tPdtCode = $paData['FTPdtCode'];
        $tBarCode = $paData['FTBarCode'];
        $nLngID = $paData['FNLngID'];
        $tSQL = "SELECT
        	        PDT.FTPdtForSystem,
                    CASE WHEN PDT.FTPdtForSystem = 5 THEN 'FH' ELSE 'GN' END AS PDTSpc ,
                    BAR.FTPdtCode,
                    PDT_L.FTPdtName,
                    BAR.FTBarCode,
                    BAR.FTPunCode,
                    UNT_L.FTPunName,
                    PSZ.FCPdtUnitFact,
                    BAR.FTPlcCode
                FROM
                    TCNMPdtBar BAR WITH(NOLOCK)
                LEFT OUTER JOIN TCNMPdt PDT WITH(NOLOCK) ON BAR.FTPdtCode = PDT.FTPdtCode
                LEFT OUTER JOIN TCNMPdt_L PDT_L WITH(NOLOCK) ON BAR.FTPdtCode = PDT_L.FTPdtCode AND PDT_L.FNLngID = $nLngID
                LEFT OUTER JOIN TCNMPdtUnit_L UNT_L WITH(NOLOCK) ON BAR.FTPunCode = UNT_L.FTPunCode AND UNT_L.FNLngID = $nLngID
                LEFT OUTER JOIN TCNMPdtPackSize PSZ WITH(NOLOCK) ON BAR.FTPdtCode = PSZ.FTPdtCode AND BAR.FTPunCode = PSZ.FTPunCode
                WHERE PDT.FTPdtStaActive = '1'
                ";
            if(!empty($tPdtCode)){
                $tSQL .= " AND BAR.FTPdtCode = '$tPdtCode' "; 
            }
            if(!empty($tBarCode)){
                $tSQL .= " AND BAR.FTBarCode = '$tBarCode' "; 
            }
            $oQuery = $this->db->query($tSQL);

            if ($oQuery->num_rows() > 0) {
                $oDetail = $oQuery->row_array();
                $aResult = array(
                    'raItem'   => $oDetail,
                    'rtCode'    => '1',
                    'rtDesc'    => 'success',
                );
            } else {
                $aResult = array(
                    'rtCode' => '800',
                    'rtDesc' => 'data not found.',
                );
            }
            return $aResult;
    }


    
    /**
     * Functionality: ตรวจสอบข้อมูลสินค้าจากรหัสบาร์โค้ด
     * Parameters: Array เงื่อนไขการเช็คค่า [$paParams]
     * Creator: 21/04/2022 ์ฟสำ
     * Last Modified: -
     * Return: Statuss
     * Return Type: Number
    */
    public function FCNaMCMMListDataPrintBarCode($ptBarCode, $pnLangPrint)
    {
        $tSQLSelect = " SELECT 
        PDT.FTPdtCode,
                            PDTL.FTPdtName FTPdtName, 
                            ISNULL(PRI.FCPgdPriceRet,0) FCPdtPrice,
                            '' FTPlcCode,
                            GETDATE() FDPrnDate,
                            ISNULL(PCL.FTClrName,'') + ' ' + ISNULL(PSZ.FTPszName,'') FTPdtContentUnit,
                            '' AS FTPlbCode, 
                            ISNULL(PBNL.FTPbnName,'') FTPbnDesc,
                            'ดูที่ผลิตภัณฑ์' FTPdtTime, 
                            'ดูที่ผลิตภัณฑ์' FTPdtMfg,
                            'บริษัท คิง เพาเวอร์ คลิก จำกัด' FTPdtImporter,
                            PDG.FTPdgRegNo FTPdtRefNo,
                            PSZ.FTPszName FTPdtValue,
                            1 FTPlbStaSelect
        FROM TCNMPdt PDT with(nolock)
                    INNER JOIN TCNMPdtPackSize PPS with(nolock) ON PPS.FTPdtCode = PDT.FTPdtCode
                    LEFT JOIN TCNMPdtUnit_L PUL WITH(NOLOCK) ON PUL.FTPunCode = PPS.FTPunCode AND PUL.FNLngID = $pnLangPrint
                    LEFT JOIN TCNMPdtBar BAR with(nolock) ON BAR.FTPdtCode = PPS.FTPdtCode AND BAR.FTPunCode = PPS.FTPunCode
                    LEFT JOIN TCNMPdt_L PDTL with(nolock) ON PDTL.FTPdtCode = PDT.FTPdtCode AND PDTL.FNLngID = $pnLangPrint
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
                    LEFT JOIN TCNMPdtBrand_L PBNL with(nolock) ON PBNL.FTPbnCode = PDT.FTPbnCode AND PBNL.FNLngID = $pnLangPrint
                    LEFT JOIN TCNMPdtDrug PDG with(nolock) ON PDG.FTPdtCode = PDT.FTPdtCode
                    LEFT JOIN TCNMPdtSize_L PSZ with(nolock) ON PSZ.FTPszCode = PPS.FTPszCode AND PSZ.FNLngID =   $pnLangPrint
                    LEFT JOIN TCNMPdtColor_L PCL with(nolock) ON PCL.FTClrCode = PPS.FTClrCode AND PCL.FNLngID =   $pnLangPrint
                    LEFT JOIN TCNMPdtCategory CAT WITH(NOLOCK) ON PDT.FTPdtCode = CAT.FTPdtCode
                    WHERE 1 = 1 AND BAR.FTBarCode = '$ptBarCode' ";


        $oQuerySelect = $this->db->query($tSQLSelect);

        if ($oQuerySelect->num_rows() > 0) {
            $oResult = $oQuerySelect->result_array();
        } else {
            $oResult = array();
        }

        return  $oResult;
    }


    /**
     * Functionality: ตรวจสอบข้อมูลสินค้าจากรหัสบาร์โค้ด
     * Parameters: Array เงื่อนไขการเช็คค่า [$paParams]
     * Creator: 21/04/2022 ์ฟสำ
     * Last Modified: -
     * Return: Statuss
     * Return Type: Number
    */
    public function FCNaMCMMListDataPrintBarCodeCheckValidate()
    {
        $tIP = $this->input->ip_address();
        $tFullHost = gethostbyaddr($tIP);

        $tSQL = "UPDATE TCNTPrnLabelTmp
        SET FTPlbStaImport = 2,FTPlbStaSelect = null,FTPlbImpDesc =  '[2]ไม่พบสินค้า'
        WHERE FTPdtCode  IS NULL AND FTComName = '$tFullHost' ";

        $oQuerySelect = $this->db->query($tSQL);

        // if ($oQuerySelect->num_rows() > 0) {
        //     $oResult = $oQuerySelect->result_array();
        // } else {
        //     $oResult = array();
        // }

        // return  $oResult;
    }
}