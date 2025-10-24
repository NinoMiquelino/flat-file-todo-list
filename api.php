<?php
// Configurações básicas e headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
// Define os métodos permitidos (essencial para CORS e chamadas RESTful)
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

// Arquivo que armazena os dados
const DATA_FILE = __DIR__ . '/data.json';

// --- Funções de Manipulação de Arquivo ---

/**
 * Lê o arquivo JSON, decodifica e retorna a lista de tarefas.
 * Se o arquivo não existir ou estiver vazio, retorna um array vazio.
 * @return array Lista de tarefas.
 */
function getTasks() {
    if (!file_exists(DATA_FILE) || filesize(DATA_FILE) === 0) {
        return [];
    }
    $content = file_get_contents(DATA_FILE);
    $tasks = json_decode($content, true);
    return is_array($tasks) ? $tasks : [];
}

/**
 * Salva a lista de tarefas de volta no arquivo JSON.
 * @param array $tasks A lista de tarefas a ser salva.
 */
function saveTasks(array $tasks) {
    // Adiciona flags para formatação legível (JSON_PRETTY_PRINT) e UTF-8
    $result = file_put_contents(DATA_FILE, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    if ($result === false) {
        throw new Exception("Falha ao escrever no arquivo de dados. Verifique as permissões de escrita.");
    }
}

// --- Lógica da API e Rotas ---

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'OPTIONS') {
    // Resposta para pre-flight CORS
    http_response_code(200);
    exit();
}

$response = ['success' => false, 'data' => null, 'error' => ''];

try {
    // Lê o corpo da requisição para POST/PUT/DELETE
    $input = file_get_contents('php://input');
    $inputData = json_decode($input, true);

    $tasks = getTasks();
    
    // Rota: GET /api.php -> READ
    if ($method === 'GET') {
        $response['success'] = true;
        $response['data'] = $tasks;
    } 
    
    // Rota: POST /api.php -> CREATE
    elseif ($method === 'POST') {
        if (empty($inputData['title'])) {
            throw new Exception("O título da tarefa é obrigatório.");
        }
        
        $newTask = [
            'id' => uniqid(), // ID único para a tarefa
            'title' => $inputData['title'],
            'completed' => false,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $tasks[] = $newTask;
        saveTasks($tasks);
        
        $response['success'] = true;
        $response['data'] = $newTask;

    } 
    
    // Rota: PUT /api.php/ID -> UPDATE (usado aqui para alternar o status)
    elseif ($method === 'PUT') {
        if (empty($inputData['id'])) {
            throw new Exception("ID da tarefa é obrigatório para atualização.");
        }
        
        $taskId = $inputData['id'];
        $updatedTask = null;
        
        foreach ($tasks as $key => $task) {
            if ($task['id'] === $taskId) {
                // Alterna o status 'completed' e aplica o novo valor do título, se fornecido
                $tasks[$key]['completed'] = $inputData['completed'] ?? !$task['completed'];
                if (isset($inputData['title'])) {
                    $tasks[$key]['title'] = $inputData['title'];
                }
                $updatedTask = $tasks[$key];
                break;
            }
        }
        
        if (!$updatedTask) {
             http_response_code(404);
             throw new Exception("Tarefa com ID $taskId não encontrada.");
        }

        saveTasks($tasks);
        $response['success'] = true;
        $response['data'] = $updatedTask;
    } 
    
    // Rota: DELETE /api.php/ID -> DELETE
    elseif ($method === 'DELETE') {
         if (empty($inputData['id'])) {
            throw new Exception("ID da tarefa é obrigatório para exclusão.");
        }
        
        $taskId = $inputData['id'];
        $initialCount = count($tasks);
        
        // Filtra o array, removendo a tarefa com o ID especificado
        $tasks = array_filter($tasks, function($task) use ($taskId) {
            return $task['id'] !== $taskId;
        });

        if (count($tasks) === $initialCount) {
             http_response_code(404);
             throw new Exception("Tarefa com ID $taskId não encontrada para exclusão.");
        }

        // Reindexa o array após a exclusão (não estritamente necessário, mas boa prática)
        $tasks = array_values($tasks);
        saveTasks($tasks);
        
        $response['success'] = true;
        $response['data'] = ['id' => $taskId, 'message' => "Tarefa excluída com sucesso."];
    }
    
    else {
        http_response_code(405);
        throw new Exception("Método HTTP $method não permitido.");
    }

} catch (Exception $e) {
    // Usa código 400 (Bad Request) para erros de lógica ou dados
    if (http_response_code() === 200) {
        http_response_code(400); 
    }
    $response['error'] = $e->getMessage();
}

echo json_encode($response);
?>
