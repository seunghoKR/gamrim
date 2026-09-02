<?php declare(strict_types=1);
class RentalController {
    public function index(): void {
        $fm = new FacilityModel();
        $facilities = $fm->getAll();
        require_once ROOT_PATH.'/views/rental/index.php';
    }
    public function calendar(): void {
        $fm = new FacilityModel();
        $facilities = $fm->getAll();
        require_once ROOT_PATH.'/views/rental/calendar.php';
    }
    public function eventsApi(): void {
        header('Content-Type: application/json');
        $facilityId = isset($_GET['facility_id']) ? (int)$_GET['facility_id'] : null;
        $rm = new RentalModel();
        $events = $rm->getApprovedEvents($facilityId);
        $colorMap = ['sanctuary_grand'=>'#E53E3E','bethel'=>'#3182CE','seminar'=>'#38A169','cafeteria'=>'#D69E2E'];
        foreach($events as &$e){ $e['color'] = $colorMap[$e['facilityCode']??'']??'#718096'; }
        echo json_encode($events);
    }
    public function applyForm(): void {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $fm = new FacilityModel(); $facilities = $fm->getAll();
        require_once ROOT_PATH.'/views/rental/apply.php';
    }
    public function applySubmit(): void {
        if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['csrf_token'])||$_POST['csrf_token']!==$_SESSION['csrf_token']){http_response_code(403);die('Invalid Request');}
        $facilityId=(int)$_POST['facility_id'];
        $startDate=htmlspecialchars($_POST['start_date']??'');
        $endDate=htmlspecialchars($_POST['end_date']??'');
        $timeSlot=htmlspecialchars($_POST['time_slot']??'ALL_DAY');
        $fm=new FacilityModel();
        if($fm->checkConflict($facilityId,$startDate,$endDate,$timeSlot)){http_response_code(409);die('이미 예약된 날짜입니다.');}
        $rentalNo='RNT-'.date('Ymd').'-'.sprintf('%04d',random_int(0,9999));
        $data=['rental_no'=>$rentalNo,'facility_id'=>$facilityId,'org_name'=>htmlspecialchars($_POST['org_name']??''),'applicant_name'=>htmlspecialchars($_POST['applicant_name']??''),'phone'=>htmlspecialchars($_POST['phone']??''),'event_title'=>htmlspecialchars($_POST['event_title']??''),'start_date'=>$startDate,'end_date'=>$endDate,'time_slot'=>$timeSlot,'expected_attendees'=>(int)($_POST['expected_attendees']??0),'use_equipment'=>isset($_POST['use_equipment'])?1:0,'use_cafeteria'=>isset($_POST['use_cafeteria'])?1:0,'memo'=>htmlspecialchars($_POST['memo']??'')];
        $rm=new RentalModel(); $rm->create($data);
        header('Location: /rental?success=1'); exit;
    }
}