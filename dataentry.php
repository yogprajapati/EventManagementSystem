<?php
include ("authentication/dbconnection.php");
date_default_timezone_set('Asia/Kolkata');
require_once ('tcpdf/tcpdf.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $event_type = $_GET['event-type'];
    if ($event_type == "birthday") {
        $regname = $_GET['regname'];
        $name = $_GET['name'];
        $age = $_GET['age'];
        $date = $_GET['date'];
        $time = $_GET['time'];
        $cake = $_GET['cake'];
        $dietryrestriction = $_GET['dietryrestriction'];
        $people = $_GET['birth-people'];
        $city = $_GET['birth-city'];
        $state = $_GET['birth-state'];
        $venue = $_GET['birth-venue'];
        $specialreq = $_GET['specialreq'];
        $id = $_SESSION["user_id"];

        $sql = "INSERT INTO birthday (userid,status,regname,name,age,date,time,cake,dietryrestriction,people,state,city,venue,anyreq) VALUES('$id','pending','$regname','$name','$age','$date','$time','$cake','$dietryrestriction','$people','$state','$city','$venue','$specialreq')";

        if (mysqli_query($conn, $sql)) {
            generatebirthPDF($regname, $name, $age, $date, $time, $cake, $dietryrestriction, $people, $city, $state, $venue, $specialreq);
            header("Location: services.php?remarks=birthsuccess");
        }
    } elseif ($event_type == "corporate") {
        $corp_user = $_GET['corp_username'];
        $company_name = $_GET['company_name'];
        $purpose = $_GET['purpose'];
        $people = $_GET['people'];
        $location = $_GET['location'];
        $date = $_GET['event-date'];
        $time = $_GET['event-time'];
        $beverages = $_GET['beverages'];
        $seating = $_GET['seating'];
        $specialreq = $_GET['any-req'];
        $id = $_SESSION["user_id"];
        $sqlc = "INSERT INTO corporate (userid,status,company_name,purpose,location	,people	,beverages,event_date,event_time,seating,anyreq)
 VALUES('$id','pending','$company_name','$purpose','$location','$people','$beverages','$date','$time','$seating','$specialreq')";

        if (mysqli_query($conn, $sqlc)) {
            generatecorpPDF($corp_user, $company_name, $purpose, $people, $location, $date, $time, $beverages, $seating, $specialreq);
            header("Location: services.php?remarks=corporatesuccess");
        }
        else{
            echo "error ";
        }
    } elseif ($event_type == "wedding") {
        $regname = $_GET['nameofreg'];
        $bride_name = $_GET['bride-name'];
        $groom_name = $_GET['groom-name'];
        $state = $_GET['state'];
        $city = $_GET['city'];
        $venue = $_GET['venue'];
        $style_pref = $_GET['style-pref'];
        $people = $_GET['people3'];
        $save_req = $_GET['save-req'];
        $appetizer = $_GET['appetizer'];
        $main_course = $_GET['maincourse'];
        $side_dishes = $_GET['sidedish'];
        $dessert = $_GET['dessert'];
        $special_req = $_GET['any-requestwed'];
        $id = $_SESSION["user_id"];

        $sqlw = "INSERT INTO wedding (userid,status,regname	,bride_name	,groom_name	,state,city,venue,style_pref,people,save_req,appetizer,	main_course,side_dishes	,dessert,anyreq) VALUES('$id','pending','$regname','$bride_name','$groom_name',
        '$state','$city','$venue','$style_pref','$people','$save_req','$appetizer','$main_course',
        '$side_dishes','$dessert','$special_req')";

        if (mysqli_query($conn, $sqlw)) {
            generateweddPDF($regname, $bride_name, $groom_name, $state, $city, $venue, $style_pref, $people, $save_req, $appetizer, $main_course, $side_dishes, $dessert);
            header("Location: services.php?remarks=weddingsuccess");
        } else {
            echo "Error While Taking Input In Database";
        }
    }
}
?>

<?php
function generatebirthPDF($regname, $name, $age, $date, $time, $cake, $dietryrestriction, $people, $city, $state, $venue, $specialreq)
{

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('The Perficient');
    $pdf->SetTitle('Event Details');
    $pdf->SetSubject('Event Details PDF');
    $pdf->SetKeywords('Event, Details, PDF');

    $pdf->AddPage();

    $html = "
    <html>
    <head>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    h1{
    color:darkyellow;
    font-weight: 800;
    text-align:center;
    text-decoration:underline;
    text-decoration-color:blue;
    }
    p{
        color:green;
        font-size:17px;
        font-weight: 900;
    }
    h2{
     color:red;   
    }
    tr{
    padding: 10px;
    }
    </style>
    </head>
    <body>
    ";
    $header = "<h1 style='color:red;'>The Prefcient</h1>";
    $html .= $header;

    $content = "
    <p>User Event Details :</p>
    <h2> Check venue status on dashboard! </h2>
    <table>
        <tr>
            <th><strong> Registration Name </strong></th>
            <td>$regname</td>
        </tr>
        <tr>
            <th><strong>Name </strong></th>
            <td>$name</td>
        </tr>
        <tr>
            <th><strong>Age</strong></th>
            <td>$age</td>
        </tr>
        <tr>
            <th><strong>Date</strong></th>
            <td>$date</td>
        </tr>
        <tr>
            <th><strong>Time</strong></th>
            <td>$time</td>
        </tr>
        <tr>
            <th><strong>Cake</strong></th>
            <td>$cake</td>
        </tr>
        <tr>
            <th><strong>Dietary Restrictions</strong></th>
            <td>$dietryrestriction</td>
        </tr>
        <tr>
            <th><strong>Number of People</strong></th>
            <td>$people</td>
        </tr>
        <tr>
            <th><strong>City</strong></th>
            <td>$city</td>
        </tr>
        <tr>
            <th><strong>State</strong></th>
            <td>$state</td>
        </tr>
        <tr>
            <th><strong>Venue</strong></th>
            <td>$venue</td>
        </tr>
        <tr>
            <th><strong>Special Requests</strong></th>
            <td>$specialreq</td>
        </tr>

       
    </table>
    ";
    $html .= $content;

    $html .= "
    </body>
    </html>
    ";

    $pdf->writeHTML($html, true, false, true, false, '');

    $footer = 'Printed: ' . date('Y-m-d H:i:s');
    $pdf->SetY(-15);
    $pdf->SetFont('helvetica', 'I', 8);
    $pdf->Cell(0, 10, $footer, 0, false, 'C', 0, '', 0, false, 'T', 'M');

    $pdf_filename = ('birthday_event_') . '.pdf';

    $pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/EventPlanning/event_pdf/' . $pdf_filename, 'F');

}
?>

<?php
function generatecorpPDF($corp_user, $company_name, $purpose, $people, $location, $date, $time, $beverages, $seating, $specialreq)
{
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Event Details');
    $pdf->SetSubject('Event Details PDF');
    $pdf->SetKeywords('Event, Details, PDF');

    $pdf->AddPage();

    $html = "
    <html>
    <head>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    h1{
    color:darkyellow;
    font-weight: 800;
    text-align:center;
    text-decoration:underline;
    text-decoration-color:blue;
    }
    p{
        color:green;
        font-size:17px;
        font-weight: 900;
    }
    h2{
     color:red;   
    }
    tr{
    padding: 10px;
    }
    </style>
    </head>
    <body>
    ";
    $header = "<h1 style='color:red;'>The Prefcient</h1>";
    $html .= $header;

    $content = "
    <p>User Event Details :</p>
    <h2> Check venue status on dashboard! </h2>
    <table>
        <tr>
            <th><strong> Registration Name </strong></th>
            <td>$corp_user</td>
        </tr>
        <tr>
            <th><strong>Company Name </strong></th>
            <td>$company_name</td>
        </tr>
        <tr>
            <th><strong>Purpose</strong></th>
            <td>$purpose</td>
        </tr>
        <tr>
            <th><strong>Attendes </strong></th>
            <td>$people</td>
        </tr>
        <tr>
            <th><strong>Prefered location</strong></th>
            <td>$location</td>
        </tr>
        <tr>
            <th><strong>Date </strong></th>
            <td>$date</td>
        </tr>
        <tr>
            <th><strong>Time</strong></th>
            <td>$time</td>
        </tr>
        <tr>
            <th><strong>Beverages</strong></th>
            <td>$beverages</td>
        </tr>
        <tr>
            <th><strong>Seating arrangements </strong></th>
            <td>$seating</td>
        </tr>
        <tr>
            <th><strong>Any special requirements ?</strong></th>
            <td>$specialreq</td>
        </tr>

       
    </table>
    ";
    $html .= $content;

    $html .= "
    </body>
    </html>
    ";

    $pdf->writeHTML($html, true, false, true, false, '');

    $footer = 'Printed: ' . date('Y-m-d H:i:s');
    $pdf->SetY(-15);
    $pdf->SetFont('helvetica', 'I', 8);
    $pdf->Cell(0, 10, $footer, 0, false, 'C', 0, '', 0, false, 'T', 'M');

    // $pdf->Output('corporate_event_details.pdf', 'I');
    $pdf_filename = ('corporate_event_') . '.pdf';

    $pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/EventPlanning/event_pdf/' . $pdf_filename, 'F');
}
?>

<?php
function generateweddPDF($regname, $bride_name, $groom_name, $state, $city, $venue, $style_pref, $people, $save_req, $appetizer, $main_course, $side_dishes, $dessert)
{
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Event Details');
    $pdf->SetSubject('Event Details PDF');
    $pdf->SetKeywords('Event, Details, PDF');

    $pdf->AddPage();

    $html = "
    <html>
    <head>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    h1{
    color:darkyellow;
    font-weight: 800;
    text-align:center;
    text-decoration:underline;
    text-decoration-color:blue;
    }
    p{
        color:green;
        font-size:17px;
        font-weight: 900;
    }
    h2{
     color:red;   
    }
    tr{
    padding: 10px;
    }
    </style>
    </head>
    <body>
    ";
    $header = "<h1 style='color:red;'>The Prefcient</h1>";
    $html .= $header;

    $content = "
    <p>User Event Details :</p>
    <h2> Check venue status on dashboard! </h2>
    <table>
        <tr>
            <th><strong> Registration Name </strong></th>
            <td>$regname</td>
        </tr>
        <tr>
            <th><strong>Bride's Name </strong></th>
            <td>$bride_name</td>
        </tr>
        <tr>
            <th><strong>Groom's Name</strong></th>
            <td>$groom_name</td>
        </tr>
        <tr>
            <th><strong>State</strong></th>
            <td>$state</td>
        </tr>
        <tr>
            <th><strong>City</strong></th>
            <td>$city</td>
        </tr>
        <tr>
            <th><strong>Venue</strong></th>
            <td>$venue</td>
        </tr>
        <tr>
            <th><strong>Style Preference</strong></th>
            <td>$style_pref</td>
        </tr>
        <tr>
            <th><strong>Number of People</strong></th>
            <td>$people</td>
        </tr>
        <tr>
            <th><strong>Saving Date Requirements</strong></th>
            <td>$save_req</td>
        </tr>
        <tr>
            <th><strong>Appetizer</strong></th>
            <td>$appetizer</td>
        </tr>
        <tr>
            <th><strong>Main Course</strong></th>
            <td>$main_course</td>
        </tr>
        <tr>
            <th><strong>Side Dishes</strong></th>
            <td>$side_dishes</td>
        </tr>
        <tr>
            <th><strong>Dessert</strong></th>
            <td>$dessert</td>
        </tr>
    </table>
    ";
    $html .= $content;

    $html .= "
    </body>
    </html>
    ";
    $pdf->writeHTML($html, true, false, true, false, '');

    $footer = 'Printed: ' . date('Y-m-d H:i:s');
    $pdf->SetY(-15);
    $pdf->SetFont('helvetica', 'I', 8);
    $pdf->Cell(0, 10, $footer, 0, false, 'C', 0, '', 0, false, 'T', 'M');

    // $pdf->Output('wedding_event_details.pdf', 'I');
    $pdf_filename = ('wedding_event_') . '.pdf';

    $pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/EventPlanning/event_pdf/' . $pdf_filename, 'F');
}
?>