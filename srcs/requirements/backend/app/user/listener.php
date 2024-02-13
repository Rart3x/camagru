if ($_SERVER['REQUEST_URI'] === '/api/user/create') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $response = ['success' => true, 'message' => 'Utilisateur créé avec succès'];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} 
else
{
    http_response_code(404);
    echo '404 Not Found';
    exit;
}