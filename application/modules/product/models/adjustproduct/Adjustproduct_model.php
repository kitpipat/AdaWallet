<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Adjustproduct_model extends CI_Model {

    // Functionality: ดึงข้อมูลสินค้า
    // Parameters: array
    // Creator: 31/01/2019 wasin(Yoshi) - 08/06/2020 wat
    // Return: ข้อมูลสินค้าแบบ Array
    // ReturnType: Object Array
    public function FSaMAJPGetDataTable($paData)
    {
        $aRowLen        = FCNaHCallLenData($paData['nRow'], $paData['nPage']);
      
        $tSessionID             = $this->session->userdata('tSesSessionID');

            $tSQL   =   " SELECT c.* FROM(
                            SELECT
                                COUNT(*) OVER() AS rtCountData,
                                AJPTMP.FNRowID,
                                AJPTMP.FTAgnCode,
                                AJPTMP.FTBchCode,
                                AJPTMP.FTPdtCode,
                                AJPTMP.FTPdtName,
                                AJPTMP.FTPunCode,
                                AJPTMP.FTPunName,
                                AJPTMP.FTBarCode,
                                AJPTMP.FTPgpChain,
                                AJPTMP.FTPgpName,
                                AJPTMP.FTPbnCode,
                                AJPTMP.FTPbnName,
                                AJPTMP.FTPmoCode,
                                AJPTMP.FTPmoName,
                                AJPTMP.FTPtyCode,
                                AJPTMP.FTPtyName,
                                AJPTMP.FTStaAlwSet,
                                AJPTMP.FTSessionID,
                                AJPTMP.FTBchName,
                                AJPTMP.FTFhnRefCode,
                                AJPTMP.FTSeaName,
                                AJPTMP.FTFabName,
                                AJPTMP.FTClrName,
                                AJPTMP.FTPszName,
                                AJPTMP.FTFhnModNo,
                                AJPTMP.FDFhnStart,
                                AJPTMP.FCFhnCostStd,
                                AJPTMP.FCFhnCostOth,
                                AJPTMP.FTFhnGender,
                                AJPTMP.FCXsdSalePrice,
                                AJPTMP.FTFhnPgpName,
                                AJPTMP.FTDepName,
                                AJPTMP.FTClsName,
                                AJPTMP.FTSclName,
                                AJPTMP.FTCmlName,
                                AJPTMP.FTClrCode
                                FROM TCNMAdjPdtTmp AJPTMP WITH(NOLOCK)
                            WHERE AJPTMP.FTSessionID = '$tSessionID'
                        ";
            $tSQL   .=  ") AS c WHERE c.FNRowID > $aRowLen[0] AND c.FNRowID <= $aRowLen[1]";

            $oQuery = $this->db->query($tSQL);
        // echo $this->db->last_query();
        

        if ($oQuery->num_rows() > 0) {
            $aList          = $oQuery->result_array();
            if ($paData['nPage'] == 1) {
                $nFoundRow      = $aList[0]['rtCountData'];
            } else {
                $nFoundRow      = $paData['nPagePDTAll'];
            }

            // หา Page All จำนวน Rec หาร จำนวนต่อหน้า
            $nPageAll       = ceil($nFoundRow / $paData['nRow']);


            $tSQL = "   SELECT COUNT(*) AS rnRows  
            FROM TCNMAdjPdtTmp ADJTMP WITH(NOLOCK)
            WHERE  ADJTMP.FTStaAlwSet = '1' AND FTSessionID = '$tSessionID'
             ";
            $oQuery = $this->db->query($tSQL);

            $aDataReturn    = array(
                // 'tSQL'          => $tSQL,
                'raItems'       => $aList,
                'rnAllRow'      => $nFoundRow,
                'rnCurrentPage' => $paData['nPage'],
                'rnAllPage'     => $nPageAll,
                'rnRowsChked'     => $oQuery->row_array()['rnRows'],
                'rtCode'        => '1',
                'rtDesc'        => 'success',
            );
        } else {
            $aDataReturn    = array(
                // 'tSQL'          => $tSQL,
                'rnAllRow'      => 0,
                'rnCurrentPage' => $paData['nPage'],
                "rnAllPage"     => 0,
                'rnRowsChked'   => 0,
                'rtCode'        => '800',
                'rtDesc'        => 'data not found',
            );
        }
        return $aDataReturn;
    }



    // Functionality: ดึงข้อมูลสินค้า
    // Parameters: array
    // Creator: 31/01/2019 wasin(Yoshi) - 08/06/2020 wat
    // Return: ข้อมูลสินค้าแบบ Array
    // ReturnType: Object Array
    public function FSaMAJPDumpDataToTemp($paData){
        $nLngID         = (empty($paData['FNLngID'])) ? 1 : $paData['FNLngID'];
        $aSearchAll     = $paData['aSearchAll'];
        $aConditionAdjustProduct = $paData['aConditionAdjustProduct'];
        
        
        $tSesUserCode = $this->session->userdata('tSesUserCode');
        $aDataUsrGrp = $this->db->where('FTUsrCode',$tSesUserCode)->get('TCNTUsrGroup')->row_array();

        $tSessionID             = $this->session->userdata('tSesSessionID');
        $tSesUsrLevel           = $this->session->userdata('tSesUsrLevel');             
        $tSessionMerCode        = $this->session->userdata('tSesUsrMerCode');           
        $tSessionShopCode       = $this->session->userdata('tSesUsrShpCodeMulti');     
        $tSesUsrAgnCode         = $this->session->userdata('tSesUsrAgnCode');           
        $tSessionBchCode        = $this->session->userdata('tSesUsrBchCodeMulti');      
        $tDefaultBchCode        = $aDataUsrGrp['FTBchCode'];
        $tDefaultShpCode        = $aDataUsrGrp['FTShpCode'];
        $tWHEREPermission_BCH   = '';                                                  
        $tWHEREPermission_SHP   = '';                                                     
            
         
        if ($tSesUsrLevel != 'HQ') {
            //---------------------- การมองเห็นเฉพาะสินค้าตามระดับผู้ใช้--------------------------//
            $tWHEREPermission_BCH .= " AND ( (";
            $tWHEREPermission_BCH .= "     ISNULL(PDLSPC.FTAgnCode,'') = '$tSesUsrAgnCode'";

            if(!empty($tSessionMerCode)){ //กรณีผู้ใช้ผูก Mer จะเห็นสินค้าภายใต้ Mer
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTMerCode,'') = '$tSessionMerCode'";
            }

            if(!empty($tDefaultBchCode)){ //กรณีผู้ใช้ผูก Bch จะเห็นสินค้าภายใต้ Bch
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTBchCode,'') IN ($tSessionBchCode) ";
            }

            if(!empty($tSessionShopCode)){ //กรณีผู้ใช้ผูก Shp จะเห็นสินค้าภายใต้ Shp
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTShpCode,'' ) IN ($tSessionShopCode) ";
            }
                $tWHEREPermission_BCH .= " ) ";
       /* |-------------------------------------------------------------------------------------------| */

        //---------------------- การมองเห็นสินค้าระดับสาขา (สำหรับผู้ใช้ระดับร้านค้า)--------------------------//
            if(!empty($tSessionShopCode)){  
                $tWHEREPermission_BCH .= " OR ("; //กรณีผู้ใช้ผูก Shp จะต้องเห็นสินค้าที่อยู่ใน Bch แต่ไม่ผูก Shp
                $tWHEREPermission_BCH .= "     ISNULL(PDLSPC.FTAgnCode,'') = '$tSesUsrAgnCode'";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTMerCode,'') = '$tSessionMerCode'";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTBchCode,'') IN ($tSessionBchCode) ";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTShpCode,'') = ''"   ;
                $tWHEREPermission_BCH .= " ) ";

                $tWHEREPermission_BCH .= " OR ("; //กรณีผู้ใช้ผูก Shp จะต้องเห็นสินค้าที่อยู่ใน Bch แต่ไม่ผูก Shp และไม่ผูก Mer
                $tWHEREPermission_BCH .= "     ISNULL(PDLSPC.FTAgnCode,'') = '$tSesUsrAgnCode'";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTMerCode,'') = ''";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTBchCode,'') IN ($tSessionBchCode) ";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTShpCode,'') = ''"   ;
                $tWHEREPermission_BCH .= " ) ";

                $tWHEREPermission_BCH .= " OR ("; //กรณีผู้ใช้ผูก Shp จะต้องเห็นสินค้าที่ไม่ผูก Bch และ ไม่ผูก Shp
                $tWHEREPermission_BCH .= "     ISNULL(PDLSPC.FTAgnCode,'') = '$tSesUsrAgnCode'";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTMerCode,'') = '$tSessionMerCode'";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTBchCode,'') = ''";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTShpCode,'') = ''"   ;
                $tWHEREPermission_BCH .= " ) ";

                $tWHEREPermission_BCH .= " OR ("; //กรณีผู้ใช้ผูก Shp จะต้องเห็นสินค้าที่ไม่ผูก Mer และสินค้าผูก Bch / Shp
                $tWHEREPermission_BCH .= "     ISNULL(PDLSPC.FTAgnCode,'') = '$tSesUsrAgnCode'";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTMerCode,'') = ''";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTBchCode,'') IN ($tSessionBchCode) ";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTShpCode,'') IN ($tSessionShopCode) "   ;
                $tWHEREPermission_BCH .= " ) ";

            }
       /* |-------------------------------------------------------------------------------------------| */

        //---------------------- การมองเห็นสินค้าระดับตัวแทนขาย--------------------------//

                    $tWHEREPermission_BCH .= " OR (";
                    $tWHEREPermission_BCH .= "     ISNULL(PDLSPC.FTAgnCode,'') = '$tSesUsrAgnCode'";
                if(!empty($tSessionMerCode)){ //กรณีผู้ใช้ผูก Mer จะต้องเห็นสินค้าที่ไม่ได้ผูก Mer ด้วย
                    $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTMerCode,'') = '' ";
                }
                if(!empty($tDefaultBchCode)){ //กรณีผู้ใช้ผูก Bch จะต้องเห็นสินค้าที่ไม่ได้ผูก Bch ด้วย
                    $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTBchCode,'') = '' ";
                }
                if(!empty($tSessionShopCode)){ //กรณีผู้ใช้ผูก Shp จะต้องเห็นสินค้าที่ไม่ได้ผูก Shp ด้วย
                    $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTShpCode,'') = ''"   ;
                }
                    $tWHEREPermission_BCH .= " ) ";
            
      /* |-------------------------------------------------------------------------------------------| */


       //---------------------- การมองเห็นสินค้าระดับส่วนกลางหรือสินค้าที่ไม่ได้ผูกกับอะไรเลย--------------------------//
                $tWHEREPermission_BCH .= " OR (";
                $tWHEREPermission_BCH .= "     ISNULL(PDLSPC.FTAgnCode,'') = '' ";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTMerCode,'') = '' ";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTBchCode,'') = '' ";
                $tWHEREPermission_BCH .= " AND ISNULL(PDLSPC.FTShpCode,'') = '' "   ;
                $tWHEREPermission_BCH .= " )) ";
       /* |-------------------------------------------------------------------------------------------| */

        }
      

     
        $aSpcJoinTableMaster =  array(
            'TCNMPdt' => '', //รหัสสินค้า
            'TCNMPdtPackSize' => 'LEFT JOIN TCNMPdtPackSize PPCZ WITH (NOLOCK) ON PDT.FTPdtCode = PPCZ.FTPdtCode', //หาหน่วย
            'TCNMPdtBar' => 'LEFT JOIN TCNMPdtPackSize PPCZ WITH (NOLOCK) ON PDT.FTPdtCode = PPCZ.FTPdtCode LEFT JOIN TCNMPdtBar PBAR WITH (NOLOCK)  ON PDT.FTPdtCode = PBAR.FTPdtCode  AND PPCZ.FTPunCode = PBAR.FTPunCode',  //หาบาร์โค้ด
            'TFHMPdtColorSize' => $this->FStMAJPJoinForPdtFhn($nLngID) //หาคุณลักษณะ
        );


        $tAddColumFhn = $this->FStMAJPFeildForPdtFhn($nLngID);

        $aSpcSelectTableMaster =  array(
            'TCNMPdt' =>" '' AS FTPunCode, '' AS FTBarCode, ".$tAddColumFhn, //รหัสสินค้า
            'TCNMPdtPackSize' => "PPCZ.FTPunCode, '' AS FTBarCode, ".$tAddColumFhn, //หาหน่วย
            'TCNMPdtBar' => 'PPCZ.FTPunCode,PBAR.FTBarCode,'.$tAddColumFhn,  //หาบาร์โค้ด
            'TFHMPdtColorSize' => 'PBAR.FTPunCode,PBAR.FTBarCode,PCS.FTFhnRefCode,PdtSea_L.FTSeaName,PdtFab_L.FTFabName,PdtColor_L.FTClrName,PdtSize_L.FTPszName,FHN.FTFhnModNo,PCS.FDFhnStart,PCS.FCFhnCostStd,PCS.FCFhnCostOth,PDTDPL.FTDepName,PDTClSL.FTClsName,PDTSClSL.FTSclName,PDTGRPL.FTPgpName AS FTFhnPgpName,PdtColor_L.FTClrRmk,PDTCML.FTCmlName,FHN.FTFhnGender,PCS.FNFhnSeq,',//หาคุณลักษณะ
        );

        $aSpcSelectTableMaster_L =  array(
            'TCNMPdt' => " '' AS FTPunName, ".$tAddColumFhn, //รหัสสินค้า
            'TCNMPdtPackSize' => 'PUNL.FTPunName,'.$tAddColumFhn, //หาหน่วย
            'TCNMPdtBar' => 'PUNL.FTPunName,'.$tAddColumFhn,  //หาบาร์โค้ด
            'TFHMPdtColorSize' => 'PUNL.FTPunName,PDT.FTFhnRefCode,PDT.FTSeaName,PDT.FTFabName,PDT.FTClrName,PDT.FTPszName,PDT.FTFhnModNo,PDT.FDFhnStart,PDT.FCFhnCostStd,PDT.FCFhnCostOth,PDT.FTDepName,PDT.FTClsName,PDT.FTSclName,PDT.FTFhnPgpName,PDT.FTClrRmk,PDT.FTCmlName,PDT.FTFhnGender,PDT.FNFhnSeq,', //หาคุณลักษณะ
        );

        $tSQLPdtMaster = "  SELECT DISTINCT ";
   
        $tSQLPdtMaster .=  "   PDLSPC.FTAgnCode,PDLSPC.FTBchCode, PDT.FTPdtForSystem,PDT.FTPdtCode, ";
        $tSQLPdtMaster .=      $aSpcSelectTableMaster[$aConditionAdjustProduct['tAJPSelectTable']];
        $tSQLPdtMaster .=  "    PDT.FTPtyCode,
                                PDT.FTPgpChain,
                                PDT.FTPbnCode,
                                PDT.FTPmoCode,
                                PDT.FTCreateBy,
                                PDT.FDCreateOn
                            FROM
                                TCNMPdt PDT WITH (NOLOCK)
                            LEFT JOIN TCNMPdtSpcBch PDLSPC WITH (NOLOCK) ON PDT.FTPdtCode = PDLSPC.FTPdtCode ";
        if (!empty($aConditionAdjustProduct['tAJPSelectTable'])) {
            $tSQLPdtMaster .= $aSpcJoinTableMaster[$aConditionAdjustProduct['tAJPSelectTable']];
        }
        $tSQLPdtMaster .= " WHERE 1=1
                            " . $tWHEREPermission_BCH . "
                            " . $tWHEREPermission_SHP . "
                            ";

        //Filter
        if (!empty($aSearchAll['tAJPAgnCode'])) {
            $tAJPAgnCode = $aSearchAll['tAJPAgnCode'];
            $tSQLPdtMaster .= " AND ( PDLSPC.FTAgnCode = '$tAJPAgnCode' OR ISNULL(PDLSPC.FTAgnCode,'')='' ) "; 
        }

        if (!empty($aSearchAll['tAJPBchCode'])) {
            $tAJPBchCode = $aSearchAll['tAJPBchCode'];
            $tSQLPdtMaster .= " AND ( PDLSPC.FTBchCode = '$tAJPBchCode' OR  ISNULL(PDLSPC.FTBchCode,'')='' ) "; 
        }

        if (!empty($aSearchAll['tAJPPdtCodeFrom']) && !empty($aSearchAll['tAJPPdtCodeTo'])) {
            $tAJPPdtCodeFrom = $aSearchAll['tAJPPdtCodeFrom'];
            $tAJPPdtCodeTo = $aSearchAll['tAJPPdtCodeTo'];
            $tSQLPdtMaster .= " AND ( PDT.FTPdtCode BETWEEN '$tAJPPdtCodeFrom' AND '$tAJPPdtCodeTo' ) "; 
        }

        if (!empty($aSearchAll['tAJPPgpCode'])) {
            $tAJPPgpCode = $aSearchAll['tAJPPgpCode'];
            $tSQLPdtMaster .= " AND ( PDT.FTPgpChain = '$tAJPPgpCode' ) "; 
        }

        if (!empty($aSearchAll['tAJPPbnCode'])) {
            $tAJPPbnCode = $aSearchAll['tAJPPbnCode'];
            $tSQLPdtMaster .= " AND ( PDT.FTPbnCode = '$tAJPPbnCode' ) "; 
        }

        if (!empty($aSearchAll['tAJPPmoCode'])) {
            $tAJPPmoCode = $aSearchAll['tAJPPmoCode'];
            $tSQLPdtMaster .= " AND ( PDT.FTPmoCode = '$tAJPPmoCode' ) "; 
        }

        if (!empty($aSearchAll['tAJPPtyCode'])) {
            $tAJPPtyCode = $aSearchAll['tAJPPtyCode'];
            $tSQLPdtMaster .= " AND ( PDT.FTPtyCode = '$tAJPPtyCode' ) "; 
        }

        if($aConditionAdjustProduct['tAJPSelectTable'] =='TFHMPdtColorSize'){

            if (!empty($aSearchAll['tFhnPdtDepartCode'])) {
                $tFhnPdtDepartCode = $aSearchAll['tFhnPdtDepartCode'];
                $tSQLPdtMaster .= " AND ( FHN.FTDepCode = '$tFhnPdtDepartCode' ) "; 
            }

            if (!empty($aSearchAll['tFhnPdtClassCode'])) {
                $tFhnPdtClassCode = $aSearchAll['tFhnPdtClassCode'];
                $tSQLPdtMaster .= " AND ( FHN.FTClsCode = '$tFhnPdtClassCode' ) "; 
            }

            if (!empty($aSearchAll['tFhnPdtSubClassCode'])) {
                $tFhnPdtSubClassCode = $aSearchAll['tFhnPdtSubClassCode'];
                $tSQLPdtMaster .= " AND ( FHN.FTSclCode = '$tFhnPdtSubClassCode' ) "; 
            }

            if (!empty($aSearchAll['tFhnPdtGroupCode'])) {
                $tFhnPdtGroupCode = $aSearchAll['tFhnPdtGroupCode'];
                $tSQLPdtMaster .= " AND ( FHN.FTPgpCode = '$tFhnPdtGroupCode' ) "; 
            }

            if (!empty($aSearchAll['tFhnPdtComLinesCode'])) {
                $tFhnPdtComLinesCode = $aSearchAll['tFhnPdtComLinesCode'];
                $tSQLPdtMaster .= " AND ( FHN.FTCmlCode = '$tFhnPdtComLinesCode' ) "; 
            }

            if (!empty($aSearchAll['tFhnPdtSeasonCode'])) {
                $tFhnPdtSeasonCode = $aSearchAll['tFhnPdtSeasonCode'];
                $tSQLPdtMaster .= " AND ( PCS.FTSeaCode = '$tFhnPdtSeasonCode' ) "; 
            }

            if (!empty($aSearchAll['tFhnPdtFabricCode'])) {
                $tFhnPdtFabricCode = $aSearchAll['tFhnPdtFabricCode'];
                $tSQLPdtMaster .= " AND ( PCS.FTFabCode = '$tFhnPdtFabricCode' ) "; 
            }

            if (!empty($aSearchAll['tFhnPdtSizeCode'])) {
                $tFhnPdtSizeCode = $aSearchAll['tFhnPdtSizeCode'];
                $tSQLPdtMaster .= " AND ( PCS.FTPszCode = '$tFhnPdtSizeCode' ) "; 
            }

            if (!empty($aSearchAll['tFhnPdtColorCode'])) {
                $tFhnPdtColorCode = $aSearchAll['tFhnPdtColorCode'];
                $tSQLPdtMaster .= " AND ( PCS.FTClrCode = '$tFhnPdtColorCode' ) "; 
            }

        }

        if (!empty($aSearchAll['tmAJPStaAlwPoHQ']) && $aConditionAdjustProduct['tAJPSelectTable']!='TCNMPdt') {
            $tmAJPStaAlwPoHQ = $aSearchAll['tmAJPStaAlwPoHQ'];
            $tSQLPdtMaster .= " AND ( PPCZ.FTPdtStaAlwPoHQ = '$tmAJPStaAlwPoHQ' ) "; 
        }

         //echo $tSQLPdtMaster;
        // die();
        $this->db->where('FTSessionID',$tSessionID)->delete('TCNMAdjPdtTmp');

        $tSQL = "INSERT INTO TCNMAdjPdtTmp ( FNRowID,FTAgnCode,FTBchCode,FTPdtCode,FTPunCode,FTBarCode,FTPtyCode,FTPgpChain,FTPbnCode,FTPmoCode,
                                            FTPdtName,FTPunName,
                                            FTFhnRefCode,FTSeaName,FTFabName,FTClrName,FTPszName,FTFhnModNo,FDFhnStart,FCFhnCostStd,FCFhnCostOth,
                                            FTDepName,FTClsName,FTSclName,FTFhnPgpName,FTClrCode,FTCmlName,FTFhnGender,FNFhnSeq,
                                            FTPtyName,FTPgpName,FTPbnName,FTPmoName,FTBchName,FTStaAlwSet,FCXsdSalePrice,FTSessionID
                                            )";
        $tSQL .= " SELECT
                        PDT.FNRowID,PDT.FTAgnCode,PDT.FTBchCode,PDT.FTPdtCode,PDT.FTPunCode,PDT.FTBarCode,PDT.FTPtyCode,PDT.FTPgpChain,PDT.FTPbnCode,PDT.FTPmoCode, PDTL.FTPdtName, ";
        $tSQL .=        $aSpcSelectTableMaster_L[$aConditionAdjustProduct['tAJPSelectTable']];
        $tSQL .= "      PTL.FTPtyName,
                        PGL.FTPgpName,
                        PBNL.FTPbnName,
                        PMOL.FTPmoName,
                        BCHL.FTBchName,
                        '1' AS FTStaAlwSet,
                        ISNULL(P4PDT.FCPgdPriceRet,0) AS FCPgdPriceRet,
                        '$tSessionID' AS FTSessionID
                       FROM
                        (
                                    SELECT
                                        ROW_NUMBER () OVER (ORDER BY FDCreateOn DESC) AS FNRowID,
                                        *
                                    FROM
                                        (
                                            $tSQLPdtMaster
                                        ) Base
                        ) PDT
                    LEFT JOIN TCNMPdt_L PDTL WITH (NOLOCK)       ON PDT.FTPdtCode = PDTL.FTPdtCode  AND PDTL.FNLngID    = $nLngID
                    LEFT JOIN TCNMPdtType_L PTL WITH (NOLOCK)    ON PDT.FTPtyCode = PTL.FTPtyCode   AND PTL.FNLngID = $nLngID
                    LEFT JOIN TCNMPdtUnit_L PUNL WITH (NOLOCK)   ON PDT.FTPunCode = PUNL.FTPunCode AND PUNL.FNLngID = $nLngID
                    LEFT JOIN TCNMPdtBrand_L PBNL WITH (NOLOCK)  ON PDT.FTPbnCode = PBNL.FTPbnCode AND PBNL.FNLngID = $nLngID
                    LEFT JOIN TCNMPdtModel_L PMOL WITH (NOLOCK)  ON PDT.FTPmoCode = PMOL.FTPmoCode AND PMOL.FNLngID = $nLngID
                    LEFT JOIN TCNMPdtGrp_L PGL WITH (NOLOCK)     ON PDT.FTPgpChain = PGL.FTPgpChain AND PGL.FNLngID = $nLngID
                    LEFT JOIN TCNMBranch_L BCHL WITH (NOLOCK)     ON PDT.FTBchCode = BCHL.FTBchCode  AND BCHL.FNLngID    = $nLngID
                    LEFT JOIN VCN_Price4PdtActive P4PDT WITH (NOLOCK)  ON PDT.FTPdtCode = P4PDT.FTPdtCode AND PDT.FTPunCode = P4PDT.FTPunCode 
                    WHERE 1=1 ";
   
        $tSQL .= " ORDER BY
                        FNRowID
        ";  

        // print_r($tSQL);
        // echo $tSQL;
        // die();
        $oQuery = $this->db->query($tSQL);
        if($this->db->affected_rows() > 0){
            $aStatus = array(
                'rtCode'    => '1',
                'rtDesc'    => 'Dump Success.',
            );
        }else{
            $aStatus = array(
                'rtCode'    => '905',
                'rtDesc'    => 'Error Cannot Dump.',
            );
        }

        return $aStatus;
    }

    // Functionality: ดึงข้อมูลสินค้า
    // Parameters: array
    // Creator: 31/01/2019 wasin(Yoshi) - 08/06/2020 wat
    // Return: ข้อมูลสินค้าแบบ Array
    // ReturnType: Object Array
    public function FSaMAJPEventEditRowIDInTemp($paData){


        $tSessionID  = $this->session->userdata('tSesSessionID');

        $this->db->set('FTStaAlwSet',$paData['FTStaAlwSet']);
        if($paData['FNRowID']!='all'){
        $this->db->where('FNRowID',$paData['FNRowID']);
        }
        $this->db->where('FTSessionID',$tSessionID);
        $this->db->update('TCNMAdjPdtTmp');

        if($this->db->affected_rows() > 0){

            $tSQL = "   SELECT COUNT(*) AS rnRows  
            FROM TCNMAdjPdtTmp ADJTMP WITH(NOLOCK)
            WHERE  ADJTMP.FTStaAlwSet = '1' AND FTSessionID = '$tSessionID'
             ";
            $oQuery = $this->db->query($tSQL);

            $aStatus = array(
                'rtCode'    => '1',
                'rnCountRow' => $oQuery->row_array()['rnRows'],
                'rtDesc'    => 'Update Success.',
            );
        }else{
            $aStatus = array(
                'rtCode'    => '905',
                'rtDesc'    => 'Error Cannot Update.',
            );
        }

        return $aStatus;

    }

    // Functionality: ดึงข้อมูลสินค้า
    // Parameters: array
    // Creator: 31/01/2019 wasin(Yoshi) 
    // Return: ข้อมูลสินค้าแบบ Array
    // ReturnType: Object Array
    public function FSaMAJPGetRowsB4Update($paData){

        $tTable      = $paData['tTable'];
        $tField      = $paData['tField'];
        $tValue      = $paData['tValue'];
        $tOnJoin     = $paData['tOnJoin'];
        $tSessionID  = $this->session->userdata('tSesSessionID');

        $tSQL = "   SELECT COUNT(*) AS rnRows  
                    FROM TCNMAdjPdtTmp ADJTMP WITH(NOLOCK)
                    WHERE  ADJTMP.FTStaAlwSet = '1' AND FTSessionID = '$tSessionID'
               ";
        $oQuery = $this->db->query($tSQL);
        if($this->db->affected_rows() > 0){
            $aStatus = array(
                'rtCode'    => '1',
                'rtDesc'    => language('product/product/product', 'tAdjPdtMassageSuccess'),
            );
        }else{
            $aStatus = array(
                'rtCode'    => '905',
                'rtDesc'    =>  language('product/product/product', 'tAdjPdtMassageWarning'),
            );
        }

        return $aStatus;

    }


    // Functionality: ดึงข้อมูลสินค้า
    // Parameters: array
    // Creator: 31/01/2019 wasin(Yoshi) 
    // Return: ข้อมูลสินค้าแบบ Array
    // ReturnType: Object Array
    public function FSaMAJPEventUpdate($paData){

        $tTable      = $paData['tTable'];
        $tField      = $paData['tField'];
        $tValue      = $paData['tValue'];
        $tOnJoin     = $paData['tOnJoin'];
        $tSessionID  = $this->session->userdata('tSesSessionID');

        $tSQL = "  UPDATE PDT SET
                        PDT.$tField = $tValue
                    FROM
                        $tTable PDT
                    INNER JOIN TCNMAdjPdtTmp ADJTMP ON  PDT.FTPdtCode = ADJTMP.FTPdtCode  $tOnJoin
                    AND ADJTMP.FTStaAlwSet = '1' AND FTSessionID = '$tSessionID'
              
               ";
        $oQuery = $this->db->query($tSQL);
        if($this->db->affected_rows() > 0){
            $aStatus = array(
                'rtCode'    => '1',
                'rtDesc'    => language('product/product/product', 'tAdjPdtMassageSuccess'),
            );
        }else{
            $aStatus = array(
                'rtCode'    => '905',
                'rtDesc'    =>  language('product/product/product', 'tAdjPdtMassageWarning'),
            );
        }

        return $aStatus;

    }



    // Functionality: ดึงข้อมูลสินค้า
    // Parameters: array
    // Creator: 31/01/2019 wasin(Yoshi) 
    // Return: ข้อมูลสินค้าแบบ Array
    // ReturnType: Object Array
    private function FStMAJPJoinForPdtFhn($pnLngID){
        $nLngID = $pnLngID;
        $tJoinOnPdtFahsionPdtFhn   ='LEFT JOIN TFHMPdtFhn FHN WITH (NOLOCK) ON PDT.FTPdtCode = FHN.FTPdtCode LEFT JOIN TFHMPdtColorSize PCS WITH (NOLOCK) ON PDT.FTPdtCode = PCS.FTPdtCode AND PCS.FTFhnStaActive=1 ';

        $tJoinOnPdtFahsionPdtFhn .= " LEFT OUTER JOIN TFHMPdtF1Depart_L PDTDPL WITH(NOLOCK) ON FHN.FTDepCode = PDTDPL.FTDepCode AND PDTDPL.FNLngID = $nLngID";
        $tJoinOnPdtFahsionPdtFhn .= " LEFT OUTER JOIN TFHMPdtF2Class_L PDTClSL WITH(NOLOCK) ON FHN.FTClsCode = PDTClSL.FTClsCode AND PDTClSL.FNLngID = $nLngID";
        $tJoinOnPdtFahsionPdtFhn .= " LEFT OUTER JOIN TFHMPdtF3SubClass_L PDTSClSL WITH(NOLOCK) ON FHN.FTSclCode = PDTSClSL.FTSclCode AND PDTSClSL.FNLngID = $nLngID";
        $tJoinOnPdtFahsionPdtFhn .= " LEFT OUTER JOIN TFHMPdtF4Group_L PDTGRPL WITH(NOLOCK) ON FHN.FTPgpCode = PDTGRPL.FTPgpCode AND PDTGRPL.FNLngID = $nLngID";
        $tJoinOnPdtFahsionPdtFhn .= " LEFT OUTER JOIN TFHMPdtF5ComLines_L PDTCML WITH(NOLOCK) ON FHN.FTCmlCode = PDTCML.FTCmlCode AND PDTCML.FNLngID = $nLngID";


        $tJoinOnPdtFahsionBar   =  ' INNER JOIN (SELECT
                                         ROW_NUMBER () OVER (Partition by BA.FTPdtCode,BA.FTFhnRefCode,BA.FNBarRefSeq ORDER BY BA.FNBarRefSeq DESC) AS FNRowID,
                                         BA.FTPdtCode,
                                         BA.FTBarCode,
                                         BA.FNBarRefSeq,
                                         BA.FTFhnRefCode,
                                         BA.FTPunCode
                                         FROM TCNMPdtBar BA WITH (NOLOCK)
                                         WHERE BA.FTBarStaUse = 1 ) PBAR ON PCS.FTPdtCode = PBAR.FTPdtCode AND  PCS.FTFhnRefCode = PBAR.FTFhnRefCode AND PCS.FNFhnSeq = PBAR.FNBarRefSeq AND  PBAR.FNRowID = 1 ';
         $tJoinOnPdtFahsionSeason =  " LEFT OUTER JOIN TFHMPdtSeason PdtSea WITH(NOLOCK) ON PCS.FTSeaCode = PdtSea.FTSeaCode LEFT OUTER JOIN TFHMPdtSeason_L PdtSea_L WITH(NOLOCK) ON PdtSea.FTSeaCode = PdtSea_L.FTSeaCode AND PdtSea.FTSeaChain = PdtSea_L.FTSeaChain AND PdtSea_L.FNLngID = $nLngID ";
         $tJoinOnPdtFahsionFabric =  " LEFT OUTER JOIN TFHMPdtFabric_L PdtFab_L WITH(NOLOCK) ON PCS.FTFabCode = PdtFab_L.FTFabCode AND PdtFab_L.FNLngID = $nLngID";
         $tJoinOnPdtFahsionColor  =  " LEFT OUTER JOIN TCNMPdtColor_L PdtColor_L WITH(NOLOCK) ON PCS.FTClrCode = PdtColor_L.FTClrCode AND PdtColor_L.FNLngID = $nLngID";
         $tJoinOnPdtFahsionSize   =  " LEFT OUTER JOIN TCNMPdtSize_L PdtSize_L WITH(NOLOCK) ON PCS.FTPszCode = PdtSize_L.FTPszCode AND PdtSize_L.FNLngID = $nLngID";
 
         $tJoinForPdtFhn = $tJoinOnPdtFahsionPdtFhn.$tJoinOnPdtFahsionBar.$tJoinOnPdtFahsionSeason.$tJoinOnPdtFahsionFabric.$tJoinOnPdtFahsionColor.$tJoinOnPdtFahsionSize;

        return $tJoinForPdtFhn;
    }


    // Functionality: ดึงข้อมูลสินค้า
    // Parameters: array
    // Creator: 31/01/2019 wasin(Yoshi) 
    // Return: ข้อมูลสินค้าแบบ Array
    // ReturnType: Object Array
    private function FStMAJPFeildForPdtFhn($nLngID){

        $tAddColumFhn = " '' AS FTFhnRefCode , '' AS FTSeaName, '' AS FTFabName , '' AS FTClrName, '' AS  FTPszName , '' AS FTFhnModNo ,  '' AS FDFhnStart , 0 AS FCFhnCostStd, 0 AS FCFhnCostOth, '' AS FTDepName,'' AS FTClsName,'' AS FTSclName,'' AS FTFhnPgpName,'' AS FTClrRmk, '' AS FTCmlName, 3 AS FTFhnGender, '' AS FNFhnSeq,";
        return $tAddColumFhn;
    }
    // FTClrRmk
}