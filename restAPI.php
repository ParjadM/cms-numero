<?php
header("Content-Type: application/json");
include 'connection2.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGet($pdo);
        break;
    case 'POST':
        handlePost($pdo, $input);
        break;
    case 'PUT':
        handlePut($pdo, $input);
        break;
    case 'DELETE':
        handleDelete($pdo, $input);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

function handleGet($pdo)
{
    $sql = "SELECT * FROM info2";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function handlePost($pdo, $input)
{
    $sql = "INSERT INTO info2 (first_name, last_name, email, date_started, genderid, shirtsizeid, departmentid, regionId, positionId, password, name) VALUES (:first_name, :last_name, :email, :date_started, :genderid, :shirtsizeid, :departmentid, :regionId, :positionId, :password, :name)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['first_name' => $input['first_name'], 'last_name' => $input['last_name'], 'email' => $input['email'], 'date_started' => $input['date_started'], 'genderid' => $input['genderid'], 'shirtsizeid' => $input['shirtsizeid'], 'departmentid' => $input['departmentid'], 'regionId' => $input['regionId'], 'positionId' => $input['positionId'], 'password' => $input['password'], 'name' => $input['name']]);
    //Get the ID of the user that was just created
    $newUserId = $pdo->lastInsertId();
    //Call our function to create the approval request for the new user
    update_approval($pdo, $newUserId);
    echo json_encode(['message' => 'User created successfully']);
}

function handlePut($pdo, $input)
{
    $sql = "UPDATE info2 SET first_name = :first_name, last_name = :last_name, email = :email, date_started = :date_started, genderid = :genderid, shirtsizeid = :shirtsizeid, departmentid = :departmentid, regionId = :regionId, positionId = :positionId, `password` = :password, `name` = :name WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['first_name' => $input['first_name'], 'last_name' => $input['last_name'], 'email' => $input['email'], 'date_started' => $input['date_started'], 'genderid' => $input['genderid'], 'shirtsizeid' => $input['shirtsizeid'], 'departmentid' => $input['departmentid'], 'regionId' => $input['regionId'], 'positionId' => $input['positionId'], 'password' => $input['password'], 'name' => $input['name'], 'id' => $input['id']]);
    echo json_encode(['message' => 'User updated successfully']);
}

function handleDelete($pdo, $input)
{
    $sql = "DELETE FROM info2 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id']]);
    echo json_encode(['message' => 'User deleted successfully']);
}
?>
<?php
function update_approval($pdo, $user_id)
{
    $sql = "INSERT INTO approval (user_id, approval) VALUES (:user_id, 0)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    echo json_encode(['message' => 'User approved successfully']);
}
?>