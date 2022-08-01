<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Serverprinter_Model extends CI_Model
{

    /**
     * Functionality : Search Server Printer By ID
     * Parameters : $paData
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : Data
     * Return Type : array
     */
    public function FSaMSrvPriSearchByID($paData)
    {
        $tSrvPriCode   = $paData['FTSrvPriCode'];
        $nLngID     = $paData['FNLngID'];


        $tSQL       = "SELECT
                            PrnSrv.FTSrvCode   AS rtPrnSrvCode,
                            PrnSrvL.FTSrvName  AS rtPrnSrvName,
                            PrnSrvL.FTSrvRmk   AS rtPrnSrvRmk,
                            PrnSrv.FTSrvStaUse   AS rtPrnSrvStaUse
                       FROM [TCNMPrnServer] PrnSrv
                       LEFT JOIN [TCNMPrnServer_L]  PrnSrvL ON PrnSrv.FTSrvCode = PrnSrvL.FTSrvCode AND PrnSrvL.FNLngID = $nLngID
                       WHERE 1=1 ";
        if ($tSrvPriCode != "") {
            $tSQL .= "AND PrnSrv.FTSrvCode = '$tSrvPriCode'";
        }


        $oQuery = $this->db->query($tSQL);
        if ($oQuery->num_rows() > 0) {
            $oDetail = $oQuery->result();
            $aResult = array(
                'raItems'   => $oDetail[0],
                'rtCode'    => '1',
                'rtDesc'    => 'success',
            );
        } else {
            //Not Found
            $aResult = array(
                'rtCode' => '800',
                'rtDesc' => 'data not found.',
            );
        }
        $jResult = json_encode($aResult);
        $aResult = json_decode($jResult, true);
        return $aResult;
    }

    /**
     * Functionality : List Server Printer
     * Parameters : $ptAPIReq, $ptMethodReq is request type, $paData is data for select filter
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : data
     * Return Type : array
     */
    public function FSaMSrvPriList($paData)
    {
        // return null;
        $aRowLen    = FCNaHCallLenData($paData['nRow'], $paData['nPage']);
        $nLngID     = $paData['FNLngID'];

        $tSesAgnCode = $paData['tSesAgnCode'];
        $tSQL       = "SELECT c.* FROM(
                       SELECT  ROW_NUMBER() OVER(ORDER BY FDCreateOn DESC , rtPrnSrvCode DESC) AS rtRowID,*
                       FROM
                       (SELECT DISTINCT
                       PrnSrv.FTSrvCode   AS rtPrnSrvCode,
                       PrnSrvL.FTSrvName  AS rtPrnSrvName,
                                PrnSrv.FDCreateOn,
                        PrnSrv.FTSrvStaUse   AS   rtPrnSrvSta
                        FROM [TCNMPrnServer] PrnSrv
                        LEFT JOIN [TCNMPrnServer_L] PrnSrvL ON PrnSrvL.FTSrvCode = PrnSrv.FTSrvCode AND PrnSrvL.FNLngID = $nLngID
                        WHERE 1=1";

        $tSearchList = $paData['tSearchAll'];
        if ($tSearchList != '') {
            $tSQL .= " AND PrnSrv.FTSrvCode COLLATE THAI_BIN LIKE '%$tSearchList%'  OR PrnSrvL.FTSrvName COLLATE THAI_BIN LIKE '%$tSearchList%'";
        }

        $tSQL .= ") Base) AS c WHERE c.rtRowID > $aRowLen[0] AND c.rtRowID <= $aRowLen[1]";

        $oQuery = $this->db->query($tSQL);
        if ($oQuery->num_rows() > 0) {
            $oList = $oQuery->result();
            $aFoundRow = $this->FSnMSrvPriGetPageAll(/*$tWhereCode,*/$tSearchList, $nLngID, $tSesAgnCode);
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

    /**
     * Functionality : All Page Of Server Printer
     * Parameters : $ptSearchList, $ptLngID
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : data
     * Return Type : array
     */
    public function FSnMSrvPriGetPageAll($ptSearchList, $ptLngID, $tSesAgnCode)
    {
        $tSQL = "SELECT COUNT (PrnSrv.FTSrvCode) AS counts
                FROM [TCNMPrnServer] PrnSrv
                LEFT JOIN [TCNMPrnServer_L] PrnSrvL ON PrnSrvL.FTSrvCode = PrnSrv.FTSrvCode AND PrnSrvL.FNLngID = $ptLngID
                WHERE 1=1 ";

        if ($ptSearchList != '') {
            $tSQL .= " AND (PrnSrv.FTSrvCode LIKE '%$ptSearchList%'";
            $tSQL .= " OR PrnSrvL.FTSrvName LIKE '%$ptSearchList%')";
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
     * Functionality : Checkduplicate
     * Parameters : $ptSrvPriCode
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : data
     * Return Type : object is has result, boolean is no result
     */
    public function FSoMSrvPriCheckDuplicate($ptPrnSrvCode)
    {
        $tSQL = "SELECT COUNT(FTSrvCode) AS counts
                 FROM TCNMPrnServer
                 WHERE FTSrvCode = '$ptPrnSrvCode' ";
        $oQuery = $this->db->query($tSQL);
        if ($oQuery->num_rows() > 0) {
            return $oQuery->result();
        } else {
            return false;
        }
    }

    /**
     * Functionality : Update Server Printer
     * Parameters : $paData is data for update
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : Status response
     * Return Type : array
     */
    public function FSaMSrvPriAddUpdateMaster($paData)
    {

        try {
            // Update Master
            $this->db->set('FDLastUpdOn', $paData['FDLastUpdOn']);
            $this->db->set('FTLastUpdBy', $paData['FTLastUpdBy']);
            $this->db->set('FTSrvStaUse', $paData['FTSrvPriStaUse']);
            $this->db->where('FTSrvCode', $paData['FTSrvPriCode']);
            $this->db->update('TCNMPrnServer');
            if ($this->db->affected_rows() > 0) {
                $aStatus = array(
                    'rtCode' => '1',
                    'rtDesc' => 'Update Master Success',
                );
            } else {
                // Add Master
                $this->db->insert('TCNMPrnServer', array(
                    'FTSrvCode'     => $paData['FTSrvPriCode'],
                    'FDCreateOn'    => $paData['FDCreateOn'],
                    'FTCreateBy'    => $paData['FTCreateBy'],
                    'FDLastUpdOn'   => $paData['FDLastUpdOn'],
                    'FTLastUpdBy'   => $paData['FTLastUpdBy'],
                    'FTSrvStaUse'   => $paData['FTSrvPriStaUse']

                ));
                if ($this->db->affected_rows() > 0) {
                    $aStatus = array(
                        'rtCode' => '1',
                        'rtDesc' => 'Add Master Success',
                    );
                } else {
                    $aStatus = array(
                        'rtCode' => '905',
                        'rtDesc' => 'Error Cannot Add/Edit Master.',
                    );
                }
            }
            return $aStatus;
        } catch (Exception $Error) {
            return $Error;
        }
    }

    /**
     * Functionality : Update Lang Server Printer
     * Parameters : $paData is data for update
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : Status response
     * Return Type : array
     */
    public function FSaMSrvPriAddUpdateLang($paData)
    {
        try {
            // Update Lang
            $this->db->set('FTSrvName', $paData['FTSrvPriName']);
            $this->db->set('FTSrvRmk', $paData['FTSrvPriRmk']);
            $this->db->where('FNLngID', $paData['FNLngID']);
            $this->db->where('FTSrvCode', $paData['FTSrvPriCode']);
            $this->db->update('TCNMPrnServer_L');
            if ($this->db->affected_rows() > 0) {
                $aStatus = array(
                    'rtCode' => '1',
                    'rtDesc' => 'Update Lang Success.',
                );
            } else { // Add Lang
                $this->db->insert('TCNMPrnServer_L', array(
                    'FTSrvCode' => $paData['FTSrvPriCode'],
                    'FNLngID'   => $paData['FNLngID'],
                    'FTSrvName' => $paData['FTSrvPriName'],
                    'FTSrvRmk'  => $paData['FTSrvPriRmk']
                ));
                if ($this->db->affected_rows() > 0) {
                    $aStatus = array(
                        'rtCode' => '1',
                        'rtDesc' => 'Add Lang Success',
                    );
                } else {
                    $aStatus = array(
                        'rtCode' => '905',
                        'rtDesc' => 'Error Cannot Add/Edit Lang.',
                    );
                }
            }
            return $aStatus;
        } catch (Exception $Error) {
            return $Error;
        }
    }

    /**
     * Functionality : Delete Server Printer
     * Parameters : $paData
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : Status response
     * Return Type : array
     */
    public function FSnMSrvPriDel($paData)
    {
        $this->db->where('FTSrvCode', $paData['FTSrvPriCode']);
        $this->db->delete('TCNMPrnServer');

        $this->db->where_in('FTSrvCode', $paData['FTSrvPriCode']);
        $this->db->delete('TCNMPrnServer_L');



        return $aStatus = array(
            'rtCode' => '1',
            'rtDesc' => 'success',
        );
    }
}
