<?php
include("pdf/FPDF.php");
class Report extends FPDF
{
    var $con;
    var $pdf;
    public function myCell($w,$h,$t,$b,$a)
    {
            $this->Cell($w,$h,$t,$b,$a);
    }
    public function dbConnectAll()
    {
        $this->con = mysqli_connect("localhost","root","","lab_management");
        if(!$this->con)
        {
                echo"Connection Failed".mysqli_error($this->con);
        }
    }
    public function dbClose()
    {
        mysqli_close($this->con);
    }
    public function pdfConfigAll()
    {
        ob_start();
        $this->Ln();
        $this->myCell(10,7,"No",1,0,'C');
        $this->myCell(32,7,"HOST name",1,0,'C');
        $this->myCell(30,7,"IP address",1,0,'C');
        $this->myCell(45,7,"MAC address",1,0,'C');
        $this->myCell(20,7,"Make",1,0,'C');
        $this->myCell(16,7,"RAM",1,0,'C');
        $this->myCell(16,7,"HDD",1,0,'C');
        $this->myCell(60,7,"Processor",1,0,'C');
        $this->myCell(40,7,"Os1",1,0,'C');
        $this->myCell(40,7,"Os2",1,0,'C');
        $this->myCell(35,7,"Purchase date",1,0,'C');
        $this->myCell(30,7,"Purpose",1,0,'C');
        $this->Ln();
    }
    public function allSystem($sql)
    {
        $i=1;
        $result = mysqli_query($this->con,$sql);
        while($rows=mysqli_fetch_array($result))
        {
            $host = $rows[0];$ip = $rows[1];
            $mac = $rows[2];$make = $rows[3];
            $ram = $rows[4];$hdd= $rows[5];
            $pro=$rows[6];$os1=$rows[7];
            $os2=$rows[8];$pur=$rows[9].','.$rows[10];
            $use=$rows[11];
            $this->Cell(10,7,$i,1,0,'C');$this->Cell(32,7,$host,1,0,'C');
            $this->Cell(30,7,$ip,1.0,'C');$this->Cell(45,7,$mac,1.0,'C');
            $this->Cell(20,7,$make,1.0,'C');$this->Cell(16,7,$ram,1.0,'C');
            $this->Cell(16,7,$hdd,1.0,'C');$this->Cell(60,7,$pro,1.0,'C');
            $this->Cell(40,7,$os1,1.0,'C');$this->Cell(40,7,$os2,1.0,'C');
            $this->Cell(35,7,$pur,1.0,'C');$this->Cell(30,7,$use,1.0,'C');
            $this->Ln(); 
            $i=$i+1;
        }
        ob_end_clean();
        $this->Output('I','MCA lab computer details.pdf',false);
        ob_end_flush();
    }
    public function searchSystem($host)
    {
        $sql="select * from conf_table where sys_name='$host'";
        $result=mysqli_query($this->con,$sql);
        if(mysqli_num_rows($result)==1)
        {
            $rows=mysqli_fetch_array($result);
            $host = $rows[0];$ip = $rows[1];
            $mac = $rows[2];$make = $rows[3];
            $ram = $rows[4];$hdd= $rows[5];
            $pro=$rows[6];$os1=$rows[7];
            $os2=$rows[8];$pur=$rows[9].','.$rows[10];
            $use=$rows[11];
            ob_start();        
            $this->myCell(40,7,"HOST name",1,0,'C');$this->Cell(0,7,$host,1,0,'C');$this->Ln();
            $this->myCell(40,7,"IP address",1,0,'C');$this->Cell(0,7,$ip,1.0,'C');$this->Ln();
            $this->myCell(40,7,"MAC address",1,0,'C');$this->Cell(0,7,$mac,1.0,'C');$this->Ln();
            $this->myCell(40,7,"Make",1,0,'C');$this->Cell(0,7,$make,1.0,'C');$this->Ln();
            $this->myCell(40,7,"RAM",1,0,'C');$this->Cell(0,7,$ram,1.0,'C');$this->Ln();
            $this->myCell(40,7,"HDD",1,0,'C');$this->Cell(0,7,$hdd,1.0,'C');$this->Ln();
            $this->myCell(40,7,"Processor",1,0,'C');$this->Cell(0,7,$pro,1.0,'C');$this->Ln();
            $this->myCell(40,7,"Os1",1,0,'C');$this->Cell(0,7,$os1,1.0,'C');$this->Ln();
            $this->myCell(40,7,"Os2",1,0,'C');$this->Cell(0,7,$os2,1.0,'C');$this->Ln();
            $this->myCell(40,7,"Purchase date",1,0,'C');$this->Cell(0,7,$pur,1.0,'C');$this->Ln();
            $this->myCell(40,7,"Purpose",1,0,'C');$this->Cell(0,7,$use,1.0,'C');$this->Ln();
            $this->Ln();            
        }
        ob_end_clean();
        $this->Output('I',''.$host.'.pdf',false);
        ob_end_flush();
    }
    public function ErrorSolved($sql)
    {
        ob_start();
        $i=1;
        $result = mysqli_query($this->con,$sql);
        if(mysqli_num_rows($result)>0)
        {
            $this->myCell(10,7,"NO",1,0,'C');
            $this->myCell(32,7,"HOST Name",1,0,'C');
            $this->myCell(45,7,"Complaint",1,0,'C');
            $this->myCell(30,7,"Recored date",1,0,'C');
            $this->myCell(45,7,"Solution",1,0,'C');
            $this->myCell(20,7,"Rectified date",1,0,'C');;
            $this->Ln();
            while($rows=mysqli_fetch_array($result))
            {
                $host = $rows[1];$com = $rows[2];
                $rec = $rows[3];$sol = $rows[4];
                $ret = $rows[5];
                $this->Cell(10,7,$i,1,0,'C');$this->Cell(32,7,$host,1,0,'C');
                $this->Cell(45,7,$com,1.0,'C');$this->Cell(30,7,$rec,1.0,'C');
                $this->Cell(45,7,$sol,1.0,'C');$this->Cell(20,7,$ret,1.0,'C');
                $this->Ln(); 
                $i=$i+1;
            }
        }
        else
        {
            $this->SetFont('times','B',24);
            $this->myCell(0,30,"The problem are not yet Solved",1,0,'C',false);
        }
        ob_end_clean();
        $this->Output('I','Solved problems.pdf',false);
        ob_end_flush();
    }
    public function errorNotSolved($sql)
    {
        ob_start();
        $i=1;
        $result = mysqli_query($this->con,$sql);
        if(mysqli_num_rows($result)>0)
        {
            $this->myCell(10,7,"NO",1,0,'C');
            $this->myCell(32,7,"HOST Name",1,0,'C');
            $this->myCell(45,7,"Complaint",1,0,'C');
            $this->myCell(30,7,"Recored date",1,0,'C');
            $this->Ln();
            while($rows=mysqli_fetch_array($result))
            {
                $host = $rows[1];$com = $rows[2];
                $rec = $rows[3];$sol = $rows[4];
                $ret = $rows[5];
                $this->Cell(10,7,$i,1,0,'C');$this->Cell(32,7,$host,1,0,'C');
                $this->Cell(45,7,$com,1.0,'C');$this->Cell(30,7,$rec,1.0,'C');
                $this->Ln(); 
                $i=$i+1;
            }
        }
        else
        {
            $this->SetFont('times','B',24);
            $this->myCell(0,30,"System are in Healthy condition",1,0,'C',false);
        }
        ob_end_clean();
        $this->Output('I','List of problem not solved.pdf',false);
        ob_end_flush();
    }
    public function errorSingleSystem($sql,$host)
    {
        ob_start();
        $i=1;
        $result = mysqli_query($this->con,$sql);
        if(mysqli_num_rows($result)>0)
        {
            $this->myCell(10,7,"NO",1,0,'C');
            $this->myCell(45,7,"Complaint",1,0,'C');
            $this->myCell(30,7,"Recored date",1,0,'C');
            $this->myCell(45,7,"Solution",1,0,'C');
            $this->myCell(30,7,"Solved Date",1,0,'C');
            $this->myCell(30,7,"Done by",1,0,'C');
            $this->Ln();
            while($rows=mysqli_fetch_array($result))
            {
                $com = $rows[2];
                $rec = $rows[3];$sol = $rows[4];
                $ret = $rows[5];$done=$rows[6];
                $this->Cell(10,7,$i,1,0,'C');$this->Cell(45,7,$com,1,0,'C');
                $this->Cell(30,7,$rec,1.0,'C');$this->Cell(45,7,$sol,1.0,'C');
                $this->Cell(30,7,$ret,1.0,'C');$this->Cell(30,7,$done,1.0,'C');
                $this->Ln(); 
                $i=$i+1;
            }
        }
        else
        {
            $this->SetFont('times','B',24);
            $this->myCell(0,30,"System in Healthy condition",1,0,'C',false);
        }
        ob_end_clean();
        $this->Output('I','Error report in '.$host.'.pdf',false);
        ob_end_flush();
    }
    public function errorSystemWise($sql)
    {
        ob_start();
        $sys='';
        $i=1;
        $flag=FALSE;
        $result = mysqli_query($this->con,$sql);
        if(mysqli_num_rows($result)>0)
        {
            while($rows=mysqli_fetch_array($result))
            {
                if($sys!=$rows[1])
                {
                    if($flag)
                    {
                        $this->AddPage();
                    }
                    $this->myCell(10,7,"NO",1,0,'C');
                    $this->myCell(45,7,"Complaint",1,0,'C');
                    $this->myCell(30,7,"Recored date",1,0,'C');
                    $this->myCell(45,7,"Solution",1,0,'C');
                    $this->myCell(30,7,"Solved Date",1,0,'C');
                    $this->myCell(30,7,"Done by",1,0,'C');
                    $this->Ln();
                    $this->Cell(0,7,$rows[1],1,0,'C');
                    $this->ln();
                    $sys=$rows[1];
                    $flag=true;
                }
                $com = $rows[2];
                $rec = $rows[3];$sol = $rows[4];
                $ret = $rows[5];$done=$rows[6];
                $this->Cell(10,7,$i,1,0,'C');$this->Cell(45,7,$com,1,0,'C');
                $this->Cell(30,7,$rec,1.0,'C');$this->Cell(45,7,$sol,1.0,'C');
                $this->Cell(30,7,$ret,1.0,'C');$this->Cell(30,7,$done,1.0,'C');
                $this->Ln(); 
                $i=$i+1;
            }
        }
        else
        {
            $this->SetFont('times','B',24);
            $this->myCell(0,30,"System in Healthy condition",1,0,'C',false);
        }
        ob_end_clean();
        $this->Output('I','Issues in systems',false);
        ob_end_flush();
    }
}

if(isset($_POST['gene']))
{
    if($_POST['opt']<='7')
    {
        $pdf=new Report('L','mm',array(215.9,390.56));
        $pdf->dbConnectAll();
        $pdf->SetTitle("MCA lab computer details.pdf",false);
        $pdf->AddPage();
        $pdf->Ln();
        $pdf->SetFont('times','B',16);
        $pdf->Cell(0,7,'Mepco Schlenk Engineering college,Sivakasi',0,0,'C',false);$pdf->Ln();
        $pdf->Cell(0,7,'(An Autonomous Institution)',0,0,'C',false);$pdf->Ln();
        $pdf->SetFont('times','B',14);
        $pdf->Cell(0,7,'Department of Computer Application',0,0,'C',false);$pdf->Ln();
        $pdf->Cell(0,7,'MCA LAB system details',0,0,'C',false);
        $pdf->SetFont('times','B',14);
        $sql="";
        if($_POST['opt']=='1')
        {
            $sql="SELECT * FROM conf_table";
        }
        else if($_POST['opt']=='2')
        {
            $sql="SELECT * FROM conf_table where hdd='80GB'";
        }
        else if($_POST['opt']=='3')
        {
            $sql="SELECT * FROM conf_table where hdd='320GB'";
        }
        else if($_POST['opt']=='3')
        {
            $sql="SELECT * FROM conf_table where hdd='320GB'";
        }
        else if($_POST['opt']=='4')
        {
            $sql="SELECT * FROM conf_table where hdd='500GB'";
        }
        else if($_POST['opt']=='5')
        {
            $sql="SELECT * FROM conf_table where hdd='1TB'";
        }
        else if($_POST['opt']=='6')
        {
            $sql="SELECT * FROM conf_table where ram='2GB'";
        }
        else if($_POST['opt']=='7')
        {
            $sql="SELECT * FROM conf_table where ram='4GB'";
        }
        else if($_POST['opt']=='8')
        {
            $sql="SELECT * FROM conf_table where ram='8GB'";
        }
        $pdf->pdfConfigAll();
        $pdf->allSystem($sql);
    }
    else if($_POST['opt']=='9')
    {
        $pdf=new Report('P','mm','A4');
        $pdf->dbConnectAll();
        $pdf->SetTitle("system ".$_POST['host'].".pdf",false);
        $pdf->AddPage();
        $pdf->SetFont('times','B',16);
        $name=$_POST['host'];
        $pdf->Cell(0,10,'Mepco Schlenk Engineering college,Sivakasi',0,0,'C',false);$pdf->Ln();
        $pdf->Cell(0,10,'(An Autonomous Institution)',0,0,'C',false);$pdf->Ln();
        $pdf->SetFont('times','B',14);
        $pdf->Cell(0,10,'Department of Computer Application',0,0,'C',false);$pdf->Ln();
        $pdf->Cell(0,10,'System '.$name.'',0,0,'C',false);$pdf->Ln();
        $pdf->SetFont('times','B',14);
        $pdf->searchSystem($name);
    }
    else if($_POST['opt']=='10')
    {
        $pdf=new Report('P','mm','A4');
        $pdf->dbConnectAll();
        $pdf->SetTitle("system Error solved.pdf",false);
        $pdf->AddPage();
        $pdf->Ln();
        $pdf->SetFont('times','B',16);
        $pdf->Cell(0,7,'Mepco Schlenk Engineering college,Sivakasi',0,0,'C',false);$pdf->Ln();
        $pdf->Cell(0,7,'(An Autonomous Institution)',0,0,'C',false);$pdf->Ln();
        $pdf->SetFont('times','B',14);
        $pdf->Cell(0,7,'Department of Computer Application',0,0,'C',false);$pdf->Ln();
        $pdf->Cell(0,7,'System Work Details',0,0,'C',false);$pdf->Ln();
        $pdf->SetFont('times','B',8);
        $sql="select * from complaint_info where status='solved'";
        $pdf->errorSolved($sql);
    }
    else if($_POST['opt']=='11')
    {
        $pdf=new Report('P','mm','A4');
        $pdf->dbConnectAll();
        $pdf->SetTitle("system error unsolved.pdf",false);
        $pdf->AddPage();
        $pdf->Ln();
        $pdf->SetFont('times','B',16);
        $pdf->Cell(0,7,'Mepco Schlenk Engineering college,Sivakasi',0,0,'C',false);$pdf->Ln();
        $pdf->Cell(0,7,'(An Autonomous Institution)',0,0,'C',false);$pdf->Ln();
        $pdf->SetFont('times','B',14);
        $pdf->Cell(0,7,'Department of Computer Application',0,0,'C',false);$pdf->Ln();
        $pdf->Cell(0,7,'System Work Pending Details',0,0,'C',false);$pdf->Ln();
        $pdf->SetFont('times','B',8);
        $sql="select * from complaint_info where status='Not Solved'";
        $pdf->errorNotSolved($sql);
    }
    else if($_POST['opt']=='12')
    {
        $pdf=new Report('P','mm','A4');
        $pdf->dbConnectAll();
        $pdf->SetTitle("system ".$_POST['host'].".pdf",false);
        $pdf->AddPage();
        $pdf->Ln();
        $pdf->SetFont('times','B',16);
        $name=$_POST['host'];
        $pdf->Cell(0,7,'Mepco Schlenk Engineering college,Sivakasi',0,0,'C',false);$pdf->Ln();
        $pdf->Cell(0,7,'(An Autonomous Institution)',0,0,'C',false);$pdf->Ln();
        $pdf->SetFont('times','B',12);
        $pdf->Cell(0,7,'Department of Computer Application',0,0,'C',false);$pdf->Ln();
        $pdf->Cell(0,7,'Issues in '.$name,0,0,'C',false);$pdf->Ln();
        $pdf->SetFont('times','B',8);
        $sql="select * from complaint_info where sys_name='$name'";
        $pdf->errorSingleSystem($sql,$name);
    }
    else
    {
        $pdf=new Report('P','mm','A4');
        $pdf->dbConnectAll();
        $pdf->SetTitle("system ".$_POST['host'].".pdf",false);
        $pdf->AddPage();
        $pdf->Ln();
        $pdf->SetFont('times','B',16);
        $pdf->Cell(0,7,'Mepco Schlenk Engineering college,Sivakasi',0,0,'C',false);$pdf->Ln();
        $pdf->Cell(0,7,'(An Autonomous Institution)',0,0,'C',false);$pdf->Ln();
        $pdf->SetFont('times','B',12);
        $pdf->Cell(0,7,'Department of Computer Application',0,0,'C',false);$pdf->Ln();
        $pdf->Cell(0,7,'System Issues - Host wise',0,0,'C',false);$pdf->Ln();
        $pdf->SetFont('times','B',8);
        $sql="SELECT * FROM complaint_info ORDER by sys_name";
        $pdf->errorSystemWise($sql);
    }
    $pdf->dbClose();
}
?>