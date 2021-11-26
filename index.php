<?php
// get database connection
include_once './config/database.php';
include_once './objects/User.php';
include_once './objects/Student.php';
include_once './objects/Slot.php';

$database = new Database();
$db = $database->getConnection();

$type = $_GET['type'];
$data = json_decode(file_get_contents("php://input"),true);

switch ($type) {
    case "Student":
        $student = new Student($db);
        $student->firstname = $data['firstname'];
        $student->lastname = $data['lastname'];
        $student->lvl = $data['lvl'];
        $student->user = $data['user'];
        $student->save();
        break;
    case "User":
        $user = new User($db);
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->password = $data['password'];
        $user->email = $data['email'];
        $user->save();
        break;
    case "Slot":
        $slot = new Slot($db);
        $slot->begin = $data['begin'];
        $slot->end = $data['end'];
        $slot->room = $data['room'];
        $slot->lvl = $data['lvl'];
        $slot->save();

        foreach ($data['lvl'] as $data_lvl) {
            $lvl = new Lvl($db);
            $lvl->grade = $data_lvl['grade'];
            $lvl->subject = $data_lvl['subject'];
            $lvl->slot = $slot->id;
            $lvl->save();
        }
        break;
    default:

        break;
}
?>