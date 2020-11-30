<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Export extends CI_Controller 
{
    /* installing phpspresheet

        change value config.php become like this
        $config['composer_autoload'] = "vendor/autoload.php";

        run composer
        composer require phpoffice/phpspreadsheet

    */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Export_model');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('encrypt');
		
	}
	
	public function index()
	{
        //sample paramter
        //Array
        //(
        //    [nm_perusahaan] => 
        //    [provinsi] => 11
        //    [lokasi] => Keude Bakongan
        //    [wilayah_kerja] => 2
        //    [kategori] => 13,14
        //    [bidangusaha] => 7,9,11
        //    [dermagaType] => DERMAGA I TIPE MARGINAL
        //    [kedalaman] => -30
        //    [kapasitas] => 200
        //    [ter_tuk] => TUKS
        //    [status] => Y
        //    [ms_berlaku] => 07-2035
        //)
        $session_data = array(
            "nm_perusahaan" => $this->session->userdata('nm_perusahaan'),
            "provinsi"      => $this->session->userdata('provinsi'),
            "lokasi"        => $this->session->userdata('kota'),
            "wilayah_kerja" => $this->session->userdata('kelas'),
            "kategori"      => $this->session->userdata('kategori'),
            "bidangusaha"   => $this->session->userdata('bidangusaha')
        );
        $post = $session_data;
        /* Filter Nama Perusahaan */
        $nm_perusahaan = "";
        if($post['nm_perusahaan'] != "")
        {
            $nm_perusahaan = $nm_perusahaan;
        }

        /* Filter Provinsi */        
        $provinsi_id = array();
        if(isset($post['provinsi']) && $post['provinsi'] != "")
        {
            //$prov = explode(",",$post['provinsi']);
            //if(count($prov) > 0 && is_array($prov))
            //{
                $provinsi_id = $post['provinsi'];
            //}
        }
        
        /* filter by lokasi */
        $lokasi = "";
        if(isset($post['lokasi']) && $post['lokasi'] !== "")
        {
            $lokasi = $post['lokasi'];
        }

        /** Filter by Wilayah Kerja **/
        $wilayah_kerja = array();
        if(isset($post['wilayah_kerja']) && $post['wilayah_kerja'] !== "")
        {
            $r = explode(",",$post['wilayah_kerja']);
           
            if(count($r) > 0 && is_array($r))
            {
                $wilayah_kerja = $r;
            }
        }

        /** Filter By Kategori **/
        $kategori_id = array();
        if(isset($post['kategori']) && $post['kategori'] !== "")
        {
            $r = explode(",",$post['kategori']);
            if(count($r) > 0 && is_array($r))
            {
                $kategori_id = $r;
            }
        }

        /** Filter By Bidang Usaha **/
        $bdgusaha_id = array();
        if(isset($post['bidangusaha']) && $post['bidangusaha'] !== "")
        {
            $r = explode(",",$post['bidangusaha']);
            if(count($r) > 0 && is_array($r))
            {
                $bdgusaha_id = $r;
            }
        }

        $data                   = $this->Export_model->getData($provinsi_id,$kategori_id,$wilayah_kerja,$bdgusaha_id); 
        $rekap_provinsi         = $this->Export_model->rekapProvinsi($provinsi_id);
        //$rekap_wilayah_kerja    = $this->Export_model->rekapWilayahkerja($provinsi_id);
        $rekap_kategori         = $this->Export_model->rekapKategori($provinsi_id,$kategori_id);
        $spreadsheet = new Spreadsheet();
        $index = 0;
        $wilayah = "";$row = 8;$no = 0;
        $wilayah_kerja = "";
        //style FONT CENTER * BOLD
        $style = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
        );
        $styleTitle = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            //'borders' => [
            //    'top' => [
            //        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            //    ],
            //],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'DDEBF7',
                ],
            ],
        ];

        $styleData = [
            'font' => [
                'name' => "calibri",
                'size' => 9
            ]
        ];
        foreach($data->result_array() as $r)
        {
            if($wilayah != $r['provinsi'])
            {
                # create new sheet and activeted it
                $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $r['provinsi']);
                $spreadsheet->addSheet($myWorkSheet, $index);
                $sheet = $spreadsheet->setActiveSheetIndex($index);

                /* set width column */
                $sheet->getColumnDimension('B')->setWidth(6.5);
                $sheet->getColumnDimension('C')->setWidth(36);
                $sheet->getColumnDimension('D')->setWidth(23);
                $sheet->getColumnDimension('E')->setWidth(24.5);
                $sheet->getColumnDimension('F')->setWidth(29.15);
                $sheet->getColumnDimension('G')->setWidth(30);
                $sheet->getColumnDimension('H')->setWidth(28.56);
                $sheet->getColumnDimension('I')->setWidth(20);
                $sheet->getColumnDimension('J')->setWidth(33);
                $sheet->getColumnDimension('K')->setWidth(13);
                $sheet->getColumnDimension('L')->setVisible(false);
                $sheet->getColumnDimension('M')->setWidth(24.4);
                $sheet->getColumnDimension('N')->setWidth(22.89);
                $sheet->getColumnDimension('O')->setWidth(16.78);
                $sheet->getColumnDimension('P')->setWidth(18);
                $sheet->getColumnDimension('Q')->setVisible(false);
                $sheet->getColumnDimension('R')->setVisible(false);


                /* create title */
                $sheet->mergeCells('B3:O3');
                $sheet->getStyle("B3")->applyFromArray($style);
                $sheet->mergeCells('B4:O4');
                $sheet->getStyle("B4")->applyFromArray($style);
                $sheet->mergeCells('B5:O5');
                $sheet->getStyle("B5")->applyFromArray($style);
                $sheet->setCellValue('B3', 'DAFTAR TERSUS & TUKS DI WILAYAH KERJA');
                $sheet->setCellValue('B4', 'KANTOR UPT DITJEN HUBLA');
                $sheet->setCellValue('B5', 'PROVINSI '.strtoupper($r['provinsi']));
                $index++; $row = 8;
            }
            
            
            // wilayah kerja
            if($wilayah_kerja != $r['wilayah_kerja'])
            {
                $row += 3;
                //WILAYAH KERJA
                $wilayah_kerja = $r['wilayah_kerja'];
                $sheet->setCellValue("C".$row, $wilayah_kerja);
                $sheet->getStyle("C".$row)->applyFromArray(array("font" => array("bold" => true)));$row++;

                /* set row style for title */                
                $sheet->getRowDimension($row)->setRowHeight(45);

                /* set vertical center */
                $sheet->getStyle('B'.$row.':P'.$row)->getAlignment()->setVertical('center');

                //HEADER TABLE
                $sheet->setCellValue("B".$row, 'No');
                $sheet->getStyle("B".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("C".$row, 'NAMA PERUSAHAAN');
                $sheet->getStyle("C".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("D".$row, 'BIDANG USAHA');
                $sheet->getStyle("D".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("E".$row, 'KATEGORI');
                $sheet->getStyle("E".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("F".$row, 'LOKASI');
                $sheet->getStyle("F".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("G".$row, 'ALAMAT');
                $sheet->getStyle("G".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("H".$row, 'PENANGGUNG JAWAB');
                $sheet->getStyle("H".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("I".$row, 'NPWP');
                $sheet->getStyle("I".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("J".$row, 'KOORDINAT');
                $sheet->getStyle("J".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("K".$row, 'TERSUS/TUKS');
                $sheet->getStyle("K".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("L".$row, 'SPESIFIKASI');
                $sheet->getStyle("L".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("M".$row, 'LEGALITAS');
                $sheet->getStyle("M".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("N".$row, 'TANGGAL TERBIT');
                $sheet->getStyle("N".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("O".$row, 'STATUS');
                $sheet->getStyle("O".$row)->applyFromArray($styleTitle);
                $sheet->setCellValue("P".$row, 'MASA BERLAKU');
                $sheet->getStyle("P".$row)->applyFromArray($styleTitle);

                #indexing autoincrement number
                $no = 1;
            }
            #parameter new table
            $wilayah_kerja = $r['wilayah_kerja'];
            
            $col = "B";$row++;
            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setHorizontal('center');
            $sheet->setCellValue($col.$row,$no);$col++;

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,$r['perusahaan']);$col++; #perusahaan

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,$r['bidang_usaha']);$col++; #bisang usaha

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,$r['kategori']);$col++; #kategori

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,$r['lokasi']);$col++;    # lokasi
            
            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,$r['alamat']);$col++; # alamat

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,$r['png_jwb']);$col++; #penganggung jawab

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,$r['npwp']);$col++; #npwp

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,$r['koordinat']);$col++; #koordinat

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,$r['ter_tuk']);$col++; #ter_tuk

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->setCellValue($col.$row,$r['spesifikasi']);$col++; #spesifikasi

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,$r['legalitas']);$col++; #legalitas

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,date("d F Y",strtotime($r['tgl_terbit'])));$col++; #tanggal terbit
            $status = "TIDAK AKTIF";
            if(strtoupper($r['status']) == "Y")
            {
                $status = "AKTIF";
            }
            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,$status);$col++;

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->getStyle($col.$row)->getAlignment()->setVertical('center');
            $sheet->getStyle($col.$row)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($col.$row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue($col.$row,date("d F Y",strtotime($r['ms_berlaku'])));$col++;

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->setCellValue($col.$row,date($r['latitude']));$col++;

            $sheet->getStyle($col.$row)->applyFromArray($styleData);
            $sheet->setCellValue($col.$row,date($r['longitude']));$col++;
            $wilayah = $r['provinsi'];$no++;

        }
        
        /* rekaptulasi provinsi */
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, "REKAPiTULASI PROVINSI");
        $spreadsheet->addSheet($myWorkSheet, $index);
        $sheet = $spreadsheet->setActiveSheetIndex($index);
        
        $sheet->mergeCells('B3:H3');
        
        $sheet->getRowDimension(3)->setRowHeight(36);
        $sheet->getStyle('B3')->getAlignment()->setVertical('center');
        $sheet->getStyle('B3')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('B3', 'REKAPITULASI JUMLAH TERSUS DAN TUKS PER PROVINSI');

        
        
        $sheet->mergeCells('B4:B5'); $sheet->mergeCells('D4:E4'); $sheet->mergeCells('F4:G4'); 
        $sheet->mergeCells('C4:C5'); $sheet->mergeCells('H4:H5');

        $sheet->getStyle('B4')->getAlignment()->setVertical('center');
        $sheet->getStyle('C4')->getAlignment()->setVertical('center');
        $sheet->getStyle('D4')->getAlignment()->setVertical('center');
        $sheet->getStyle('F4')->getAlignment()->setVertical('center');
        $sheet->getStyle('D5')->getAlignment()->setVertical('center');
        $sheet->getStyle('E5')->getAlignment()->setVertical('center');
        $sheet->getStyle('F5')->getAlignment()->setVertical('center');
        $sheet->getStyle('G5')->getAlignment()->setVertical('center');

        $sheet->getStyle('C4')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D4')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('F4')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('F5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('G5')->getAlignment()->setHorizontal('center');

        $sheet->setCellValue('B4', 'NO'); $sheet->setCellValue('C4', 'PROVINSI'); $sheet->setCellValue('D4', 'TERSUS');
        $sheet->setCellValue('F4', 'TUKS'); $sheet->setCellValue('H4', 'JUMLAH');
        $sheet->setCellValue('D5','AKTIF'); $sheet->setCellValue('E5','TIDAK AKTIF');
        $sheet->setCellValue('F5','AKTIF'); $sheet->setCellValue('G5','TIDAK AKTIF');
        
        $no = 1; $cols = "B"; $rows="6";
        foreach($rekap_provinsi->result_array() as $key => $value)
        {
            $sheet->getStyle($cols.$rows)->getAlignment()->setVertical('center');
            $sheet->getStyle($cols.$rows)->getAlignment()->setHorizontal('center');
            $sheet->setCellValue($cols.$rows, $no);$cols++;
            $sheet->setCellValue($cols.$rows, $value['provinsi']);$cols++;
            $sheet->getStyle($cols.$rows)->getAlignment()->setVertical('center');
            $sheet->getStyle($cols.$rows)->getAlignment()->setHorizontal('center');
            $sheet->setCellValue($cols.$rows, $value['TERSUS_AKTIF']);$cols++;
            $sheet->getStyle($cols.$rows)->getAlignment()->setVertical('center');
            $sheet->getStyle($cols.$rows)->getAlignment()->setHorizontal('center');
            $sheet->setCellValue($cols.$rows, $value['TERSUS_NONAKTIF']);$cols++;
            $sheet->getStyle($cols.$rows)->getAlignment()->setVertical('center');
            $sheet->getStyle($cols.$rows)->getAlignment()->setHorizontal('center');
            $sheet->setCellValue($cols.$rows, $value['TUKS_AKTIF']);$cols++;
            $sheet->getStyle($cols.$rows)->getAlignment()->setVertical('center');
            $sheet->getStyle($cols.$rows)->getAlignment()->setHorizontal('center');
            $sheet->setCellValue($cols.$rows, $value['TUKS_NONAKTIF']);$cols++;
            $sheet->getStyle($cols.$rows)->getAlignment()->setVertical('center');
            $sheet->getStyle($cols.$rows)->getAlignment()->setHorizontal('center');
            $sheet->setCellValue($cols.$rows, $value['JUMLAH']);
            $rows++;$cols= "B";$no++;            
        }

        $index++;
        /* rekaptulasi wilayah kerja */
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, "REKAPITULASI KATEGORI");
        $spreadsheet->addSheet($myWorkSheet, $index);
        $sheet = $spreadsheet->setActiveSheetIndex($index);

        $sheet->mergeCells('B3:H3');
        $sheet->getColumnDimension('C')->setWidth(17);
        $sheet->getStyle('B3')->getAlignment()->setVertical('center');
        $sheet->getStyle('B3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B3')->applyFromArray($style);
        $sheet->setCellValue('B3', 'REKAPITULASI JUMLAH TERSUS DAN TUKS PER KATEGORI');

        $sheet->getStyle('B5')->getAlignment()->setVertical('center');
        $sheet->getStyle('B5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B5')->applyFromArray($style);
        $sheet->setCellValue('B5', 'NO');
        $sheet->getStyle('C5')->getAlignment()->setVertical('center');
        $sheet->getStyle('C5')->getAlignment()->setHorizontal('center');      
        $sheet->getStyle('C5')->applyFromArray($style);
        $sheet->setCellValue('C5', 'BIDANG USAHA');
        $sheet->getStyle('D5')->getAlignment()->setVertical('center');
        $sheet->getStyle('D5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D5')->applyFromArray($style);
        $sheet->setCellValue('D5', 'TERSUS');
        $sheet->getStyle('E5')->getAlignment()->setVertical('center');
        $sheet->getStyle('E5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E5')->applyFromArray($style);
        $sheet->setCellValue('E5', 'TUKS');
        $sheet->getStyle('F5')->getAlignment()->setVertical('center');
        $sheet->getStyle('F5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('F5')->applyFromArray($style);
        $sheet->setCellValue('F5', 'LAIN-LAIN');
        $sheet->getStyle('G5')->getAlignment()->setVertical('center');
        $sheet->getStyle('G5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('G5')->applyFromArray($style);
        $sheet->setCellValue('G5', 'JUMLAH');

        unset($col);$columns = "B"; $rows = "6"; $nomor=1; $tersus =0;$tuks =0;$lainlain=0;$jumlah=0;
        foreach($rekap_kategori as $key => $value)
        {
            $sheet->getStyle($columns.$rows)->getAlignment()->setVertical('center');
            $sheet->getStyle($columns.$rows)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($columns.$rows)->applyFromArray($styleData);
            $sheet->setCellValue($columns.$rows, $nomor);$columns++;
            $sheet->getStyle($columns.$rows)->getAlignment()->setVertical('center');
            $sheet->getStyle($columns.$rows)->applyFromArray($styleData);
            $sheet->setCellValue($columns.$rows, $value['kategori']);$columns++;
            $sheet->getStyle($columns.$rows)->getAlignment()->setVertical('center');
            $sheet->getStyle($columns.$rows)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($columns.$rows)->applyFromArray($styleData);
            $sheet->setCellValue($columns.$rows, $value['TERSUS']);$columns++;
            $sheet->getStyle($columns.$rows)->getAlignment()->setVertical('center');
            $sheet->getStyle($columns.$rows)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($columns.$rows)->applyFromArray($styleData);
            $sheet->setCellValue($columns.$rows, $value['TUKS']);$columns++;
            $sheet->getStyle($columns.$rows)->getAlignment()->setVertical('center');
            $sheet->getStyle($columns.$rows)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($columns.$rows)->applyFromArray($styleData);
            $sheet->setCellValue($columns.$rows, $value['LAINNYA']);$columns++;
            $sheet->getStyle($columns.$rows)->getAlignment()->setVertical('center');
            $sheet->getStyle($columns.$rows)->getAlignment()->setHorizontal('center');
            $sheet->getStyle($columns.$rows)->applyFromArray($styleData);
            $sheet->setCellValue($columns.$rows, $value['TOTAL']);
            $nomor++;$columns = "B"; $rows++; $tersus+=$value['TERSUS'];$tuks+=$value['TUKS'];$lainlain=$value['LAINNYA'];$jumlah+=$value['TOTAL'];
        }
        
        $sheet->mergeCells("B".$rows.":C".$rows);
        $sheet->getStyle("B".$rows)->getAlignment()->setVertical('center');
        $sheet->getStyle("B".$rows)->getAlignment()->setHorizontal('center');
        $sheet->getStyle("B".$rows)->applyFromArray($styleData);
        $sheet->setCellValue("B".$rows, "TOTAL");
        $sheet->getStyle("D".$rows)->getAlignment()->setVertical('center');
        $sheet->getStyle("D".$rows)->getAlignment()->setHorizontal('center');
        $sheet->getStyle("D".$rows)->applyFromArray($styleData);
        $sheet->setCellValue("D".$rows,$tersus );
        $sheet->getStyle("E".$rows)->getAlignment()->setVertical('center');
        $sheet->getStyle("E".$rows)->getAlignment()->setHorizontal('center');
        $sheet->getStyle("E".$rows)->applyFromArray($styleData);
        $sheet->setCellValue("E".$rows,$tuks );
        $sheet->getStyle("F".$rows)->getAlignment()->setVertical('center');
        $sheet->getStyle("F".$rows)->getAlignment()->setHorizontal('center');
        $sheet->getStyle("F".$rows)->applyFromArray($styleData);
        $sheet->setCellValue("F".$rows,$lainlain );
        $sheet->getStyle("G".$rows)->getAlignment()->setVertical('center');
        $sheet->getStyle("G".$rows)->getAlignment()->setHorizontal('center');
        $sheet->getStyle("G".$rows)->applyFromArray($styleData);
        $sheet->setCellValue("G".$rows,$jumlah );

        $this->session->sess_destroy();
        
		$writer = new Xlsx($spreadsheet);
		$filename = 'Data-TUKS-TERSUS-INDONESIA_'.date("Ymd");
		
        header('Content-Disposition: attachment;filename="'. $filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Transfer-Encoding: binary');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');

		
	}
	
    public function csv()
    {

        $session_data = array(
            "provinsi"      => $this->session->userdata('provinsi'),
            "lokasi"        => $this->session->userdata('kota'),
            "wilayah_kerja" => $this->session->userdata('kelas'),
            "kategori"      => $this->session->userdata('kategori'),
            "bidangusaha"   => $this->session->userdata('bidangusaha')
        );
        
        //$post = $this->input->post();
        $post = $session_data;
        //echo "<pre>";print_r($provinsi_id);die();
        /* Filter Provinsi */        
        $provinsi_id = array();
        if(isset($post['provinsi']) && $post['provinsi'] != "")
        {
            
            $provinsi_id = $post['provinsi'];
           
        }
        
        /* filter by lokasi */
        $lokasi = "";
        if(isset($post['lokasi']) && $post['lokasi'] !== "")
        {
            $lokasi = $post['lokasi'];
        }

        /** Filter by Wilayah Kerja **/
        $wilayah_kerja = array();
        if(isset($post['wilayah_kerja']) && $post['wilayah_kerja'] !== "")
        {
            $r = explode(",",$post['wilayah_kerja']);
           
            if(count($r) > 0 && is_array($r))
            {
                $wilayah_kerja = $r;
            }
        }

        /** Filter By Kategori **/
        $kategori_id = array();
        if(isset($post['kategori']) && $post['kategori'] !== "")
        {
            $r = explode(",",$post['kategori']);
            if(count($r) > 0 && is_array($r))
            {
                $kategori_id = $r;
            }
        }

        /** Filter By Bidang Usaha **/
        $bdgusaha_id = array();
        if(isset($post['bidangusaha']) && $post['bidangusaha'] !== "")
        {
            $r = explode(",",$post['bidangusaha']);
            if(count($r) > 0 && is_array($r))
            {
                $bdgusaha_id = $r;
            }
        }
        $data = $this->Export_model->getData($provinsi_id,$kategori_id,$wilayah_kerja,$bdgusaha_id); 
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"test".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');
        $no = 1;
        foreach ($data->result_array() as $data_array => $value) {
            if($no==1)
            {
                $header_array = array(
                    "Provinsi",                    
                    "Wilayah kerja",
                    "Perusahaan",
                    "Bidang Usaha",
                    "Kategori",
                    "Lokasi",
                    "Alamat",
                    "Penanggung Jawab",
                    "NPWP",
                    "Koordinat",
                    "TERSUS/TUKS",
                    "Spesifikasi",
                    "Legalitas",
                    "Tanggal Terbit",
                    "status",
                    "Masa Berlaku",
                    "latitude",
                    "longitude"

                );
                fputcsv($handle, $header_array);
            }
            fputcsv($handle, $value);
            $no++;
        }
        fclose($handle);
        exit;
    }
	
}
