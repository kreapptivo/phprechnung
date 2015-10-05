<?php

/*
	print_info_pdf.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

	phpRechnung uses FPDF library to create PDF output.
	Copyright (C) Olivier PLATHEY, http://fpdf.org/ License: Freeware.

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

require_once('../include/phprechnung.inc.php');
require_once('../include/fpdf.php');

CheckUser();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
}

if(!is_numeric($myID) || $myID <= 0 )
{
	die(header("Location: $web"));
}

// Database connection
//
DBConnect();

// Get all information about selected customer
//
$query = $db->Execute("SELECT A.PREFIX, A.FIRSTNAME, A.LASTNAME, A.TITLE, A.COMPANY, A.DEPARTMENT, A.ADDRESS,
	A.CITY, A.STATEPROV, A.POSTALCODE, A.COUNTRY, A.POSITION, A.INITIALS, A.SALUTATION,
	A.PHONEHOME, A.PHONEOFFI, A.PHONEOTHE, A.PHONEWORK, A.MOBILE, A.PAGER, A.FAX, A.EMAIL,
	A.URL, A.NOTE, A.URL2, A.EMAIL2, A.ALTFIELD1, A.ALTFIELD2, A.CATEGORY, A.PRINT_NAME, A.CREATEDBY,
	A.METHODOFPAY, A.CREATED, DATE_FORMAT(A.BIRTHDAY,'%d.%m.%Y') AS BIRTHDAY, A.MYID,
	C.CATEGORYID, C.DESCRIPTION AS CDESCRIPTION, M.METHODOFPAYID, M.DESCRIPTION AS MDESCRIPTION,
	BANKNAME, BANKACCOUNT, BANKNUMBER, BANKIBAN, BANKBIC, DECODE(USERNAME,'$pkey') AS USERNAME, USERLANGUAGE, USER_ACTIVE
	FROM {$TBLName}addressbook AS A, {$TBLName}category AS C, {$TBLName}methodofpay AS M WHERE A.CATEGORY=C.CATEGORYID AND A.METHODOFPAY=M.METHODOFPAYID AND A.MYID=$myID");
$row = $query->GetRows();

// If an error has occurred, display the error message
//
if (!$query)
	print $db->ErrorMsg();
else
	foreach($row as $f)
	{
		$Print_Comapny_Name = $f['PRINT_NAME'];
		$CreatedBy = $f['CREATEDBY'];
		$UserLanguage = $f['USERLANGUAGE'];
		$UserActive = $f['USER_ACTIVE'];
		$MYID = $f['MYID'];
		$TITLE = $f['TITLE'];
		$PREFIX = $f['PREFIX'];
		$FIRSTNAME = $f['FIRSTNAME'];
		$LASTNAME = $f['LASTNAME'];
		$COMPANY = $f['COMPANY'];
		$DEPARTMENT = $f['DEPARTMENT'];
		$ADDRESS = $f['ADDRESS'];
		$CITY = $f['CITY'];
		$STATEPROV = $f['STATEPROV'];
		$POSTALCODE = $f['POSTALCODE'];
		$COUNTRY = $f['COUNTRY'];
		$POSITION = $f['POSITION'];
		$INITIALS = $f['INITIALS'];
		$SALUTATION = $f['SALUTATION'];
		$PHONEHOME = $f['PHONEHOME'];
		$PHONEOFFI = $f['PHONEOFFI'];
		$PHONEOTHE = $f['PHONEOTHE'];
		$PHONEWORK = $f['PHONEWORK'];
		$FAX = $f['FAX'];
		$MOBILE = $f['MOBILE'];
		$PAGER = $f['PAGER'];
		$EMAIL = $f['EMAIL'];
		$URL = $f['URL'];
		$NOTE = $f['NOTE'];
		$ALTFIELD1 = $f['URL2'];
		$ALTFIELD2 = $f['EMAIL2'];
		$ALTFIELD3 = $f['ALTFIELD1'];
		$ALTFIELD4 = $f['ALTFIELD2'];
		$CATEGORY = $f['CDESCRIPTION'];
		$PRINT_COMPANY_NAME = $choice_yes_no[$Print_Comapny_Name];
		$CREATOR = $CreatedBy;
		$NR_METHOD_OF_PAYMENT = $f['METHODOFPAY'];
		$METHOD_OF_PAYMENT = $f['MDESCRIPTION'];
		$CDATE = $f['CREATED'];
		$BIRTHDAY = $f['BIRTHDAY'];
		$EMAIL_INTERNAL = $EmailInternal;
		$BANKNAME = $f['BANKNAME'];
		$BANKACCOUNT = $f['BANKACCOUNT'];
		$BANKNUMBER = $f['BANKNUMBER'];
		$BANKIBAN = $f['BANKIBAN'];
		$BANKBIC = $f['BANKBIC'];
		$USERNAME = $f['USERNAME'];
		$LANGUAGE = $language[$UserLanguage];
		$USERACTIVE = $choice_yes_no[$UserActive];
	}

if(isset($_SESSION['Username']) && $_SESSION['Username'] != $root && $_SESSION['Username'] != $CreatedBy)
{
	$_SESSION['LastSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['logoutid'] = "5";
	Header("Location: $web/login/sustart.php?$sessname=$sessid");
}
else
{
	
class PDF extends FPDF
{
	function Header()
	{
		global $a, $PrintCompanyData, $CompanyLogo, $PDFCompanyLogoHeight,
		$PDFCompanyLogoWidth, $PDFFont, $PDFFontsize1, $PDFFontsize2, $PDFTypeHeight;

		if ($PrintCompanyData == "1")
		{
			$this->SetY(5);
			$this->Image($CompanyLogo,15,5,$PDFCompanyLogoWidth,$PDFCompanyLogoHeight);
			$this->SetFont($PDFFont,'',$PDFTypeHeight);
			$this->Cell(130);
			$this->Cell(60,15,$a['info'],0,1,'R');
		}
	}

	function Footer()
	{
		require_once('../include/pdf_footer.inc.php');
	}
}

$pdf=new PDF();
$pdf->Open();
$pdf->SetAutoPageBreak('auto',40);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetY(35);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(195,5,$a['all_info'].' '.$a['customer_no'].' '.$MYID,0,'C');

$pdf->SetY(45);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['date_text'],0,'L');
$pdf->SetY(45);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(100,5,$CDATE,0,'L');
$pdf->SetY(55);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['print_name'],0,'L');
$pdf->SetY(55);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(100,5,$PRINT_COMPANY_NAME,0,'L');

$pdf->SetY(60);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['prefix'],0,'L');
$pdf->SetY(60);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$PREFIX,0,'L');

$pdf->SetY(60);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['title'],0,'L');
$pdf->SetY(60);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$TITLE,0,'L');

$pdf->SetY(65);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['firstname'],0,'L');
$pdf->SetY(65);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$FIRSTNAME,0,'L');

$pdf->SetY(65);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['initials'],0,'L');
$pdf->SetY(65);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$INITIALS,0,'L');

$pdf->SetY(70);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['lastname'],0,'L');
$pdf->SetY(70);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$LASTNAME,0,'L');

$pdf->SetY(70);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['phonehome'],0,'L');
$pdf->SetY(70);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$PHONEHOME,0,'L');

$pdf->SetY(75);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['salutation'],0,'L');
$pdf->SetY(75);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$SALUTATION,0,'L');

$pdf->SetY(75);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['mobile'],0,'L');
$pdf->SetY(75);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$MOBILE,0,'L');

$pdf->SetY(80);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['address'],0,'L');
$pdf->SetY(80);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$ADDRESS,0,'L');

$pdf->SetY(80);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['fax'],0,'L');
$pdf->SetY(80);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$FAX,0,'L');

$pdf->SetY(85);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['country'],0,'L');
$pdf->SetY(85);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$COUNTRY,0,'L');

$pdf->SetY(85);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['stateprov'],0,'L');
$pdf->SetY(85);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$STATEPROV,0,'L');

$pdf->SetY(90);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['postalcode'],0,'L');
$pdf->SetY(90);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$POSTALCODE,0,'L');

$pdf->SetY(90);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['city'],0,'L');
$pdf->SetY(90);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$CITY,0,'L');

$pdf->SetY(95);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['email'],0,'L');
$pdf->SetY(95);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$EMAIL,0,'L');

$pdf->SetY(95);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['url'],0,'L');
$pdf->SetY(95);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$URL,0,'L');

$pdf->SetY(105);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['company'],0,'L');
$pdf->SetY(105);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$COMPANY,0,'L');

$pdf->SetY(105);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['phonework'],0,'L');
$pdf->SetY(105);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$PHONEWORK,0,'L');

$pdf->SetY(110);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['department'],0,'L');
$pdf->SetY(110);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$DEPARTMENT,0,'L');

$pdf->SetY(110);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['phoneoffi'],0,'L');
$pdf->SetY(110);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$PHONEOFFI,0,'L');

$pdf->SetY(115);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['position1'],0,'L');
$pdf->SetY(115);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$POSITION,0,'L');

$pdf->SetY(115);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['phoneothe'],0,'L');
$pdf->SetY(115);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$PHONEOTHE,0,'L');

$pdf->SetY(120);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['birthday'],0,'L');
$pdf->SetY(120);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);

if($BIRTHDAY != 0)
{
	$pdf->MultiCell(60,5,$BIRTHDAY,0,'L');
}

$pdf->SetY(120);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['pager'],0,'L');
$pdf->SetY(120);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$PAGER,0,'L');

$pdf->SetY(135);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['category'],0,'L');
$pdf->SetY(135);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$CATEGORY,0,'L');

$pdf->SetY(140);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['cust_method_of_payment'],0,'L');
$pdf->SetY(140);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$METHOD_OF_PAYMENT,0,'L');

$pdf->SetY(145);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['note'],0,'L');
$pdf->SetY(145);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(150,5,$NOTE,0,'L');

$pdf->SetY(165);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['email2'],0,'L');
$pdf->SetY(165);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$ALTFIELD2,0,'L');

$pdf->SetY(165);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['url2'],0,'L');
$pdf->SetY(165);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$ALTFIELD1,0,'L');

$pdf->SetY(170);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['altfield1'],0,'L');
$pdf->SetY(170);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$ALTFIELD3,0,'L');

$pdf->SetY(170);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['altfield2'],0,'L');
$pdf->SetY(170);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$ALTFIELD4,0,'L');

$pdf->SetY(180);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['bank_name'],0,'L');
$pdf->SetY(180);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$BANKNAME,0,'L');

$pdf->SetY(185);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['bank_account'],0,'L');
$pdf->SetY(185);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$BANKACCOUNT,0,'L');

$pdf->SetY(185);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['bank_number'],0,'L');
$pdf->SetY(185);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$BANKNUMBER,0,'L');

$pdf->SetY(190);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['bank_iban'],0,'L');
$pdf->SetY(190);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$BANKIBAN,0,'L');

$pdf->SetY(190);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['bank_bic'],0,'L');
$pdf->SetY(190);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$BANKBIC,0,'L');

$pdf->SetY(200);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['user_active'],0,'L');
$pdf->SetY(200);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$USERACTIVE,0,'L');

$pdf->SetY(205);
$pdf->SetX(8);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['username'],0,'L');
$pdf->SetY(205);
$pdf->SetX(40);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$USERNAME,0,'L');

$pdf->SetY(205);
$pdf->SetX(103);
$pdf->SetFont($PDFFont,'B',$PDFFontsize1);
$pdf->MultiCell(30,5,$a['language'],0,'L');
$pdf->SetY(205);
$pdf->SetX(135);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->MultiCell(60,5,$LANGUAGE,0,'L');

$pdf->SetTitle($a['all_info'].' '.$a['customer_no'].' '.$MYID);
$pdf->SetSubject($a['all_info'].' '.$a['customer_no'].' '.$MYID);
$pdf->SetAuthor($CompanyName);
$pdf->SetCreator($a['programname']);

// Send output to browser. If you choose
// save as, this is the default file name
//
$pdf->Output("info_customer_$MYID.pdf","I");

}

?>
