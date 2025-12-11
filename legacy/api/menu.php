<?php
/**
 * Menu API Endpoint
 * Handle operasi CRUD untuk menu items
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

try {
    switch($method) {
        case 'GET':
            if ($action === 'all') {
                getAllMenu($conn);
            } elseif ($action === 'category') {
                $category = $_GET['category'] ?? '';
                getMenuByCategory($conn, $category);
            } elseif ($action === 'detail') {
                $menu_id = $_GET['id'] ?? 0;
                getMenuDetail($conn, $menu_id);
            } elseif ($action === 'available') {
                getAvailableMenu($conn);
            } else {
                getAllMenu($conn);
            }
            break;
            
        case 'POST':
            if ($action === 'create') {
                createMenu($conn);
            }
            break;
            
        case 'PUT':
            if ($action === 'update') {
                updateMenu($conn);
            } elseif ($action === 'update-stock') {
                updateStock($conn);
            }
            break;
            
        case 'DELETE':
            if ($action === 'delete') {
                deleteMenu($conn);
            }
            break;
            
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

// Get all menu items
function getAllMenu($conn) {
    $stmt = $conn->prepare("SELECT * FROM menu_items ORDER BY category, menu_name");
    $stmt->execute();
    $results = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'data' => $results
    ]);
}

// Get menu by category
function getMenuByCategory($conn, $category) {
    if (empty($category)) {
        getAllMenu($conn);
        return;
    }
    
    $stmt = $conn->prepare("SELECT * FROM menu_items WHERE category = ? ORDER BY menu_name");
    $stmt->execute([$category]);
    $results = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'data' => $results
    ]);
}

// Get available menu (stock > 0)
function getAvailableMenu($conn) {
    $stmt = $conn->prepare("SELECT * FROM menu_items WHERE is_available = 1 AND stock > 0 ORDER BY category, menu_name");
    $stmt->execute();
    $results = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'data' => $results
    ]);
}

// Get menu detail
function getMenuDetail($conn, $menu_id) {
    $stmt = $conn->prepare("SELECT * FROM menu_items WHERE menu_id = ?");
    $stmt->execute([$menu_id]);
    $result = $stmt->fetch();
    
    if ($result) {
        echo json_encode([
            'success' => true,
            'data' => $result
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Menu not found'
        ]);
    }
}

// Create new menu
function createMenu($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $required = ['menu_name', 'category', 'price', 'stock'];
    foreach ($required as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => "Field {$field} is required"
            ]);
            return;
        }
    }
    
    $stmt = $conn->prepare("INSERT INTO menu_items (menu_name, description, category, price, stock, image_url, is_available) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $success = $stmt->execute([
        $data['menu_name'],
        $data['description'] ?? '',
        $data['category'],
        $data['price'],
        $data['stock'],
        $data['image_url'] ?? '',
        $data['is_available'] ?? 1
    ]);
    
    if ($success) {
        echo json_encode([
            'success' => true,
            'message' => 'Menu created successfully',
            'menu_id' => $conn->lastInsertId()
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Failed to create menu'
        ]);
    }
}

// Update menu
function updateMenu($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['menu_id'])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Menu ID is required'
        ]);
        return;
    }
    
    $stmt = $conn->prepare("UPDATE menu_items SET menu_name = ?, description = ?, category = ?, price = ?, stock = ?, image_url = ?, is_available = ? WHERE menu_id = ?");
    
    $success = $stmt->execute([
        $data['menu_name'],
        $data['description'] ?? '',
        $data['category'],
        $data['price'],
        $data['stock'],
        $data['image_url'] ?? '',
        $data['is_available'] ?? 1,
        $data['menu_id']
    ]);
    
    if ($success) {
        echo json_encode([
            'success' => true,
            'message' => 'Menu updated successfully'
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update menu'
        ]);
    }
}

// Update stock only
function updateStock($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['menu_id']) || !isset($data['stock'])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Menu ID and stock are required'
        ]);
        return;
    }
    
    $stmt = $conn->prepare("UPDATE menu_items SET stock = ? WHERE menu_id = ?");
    $success = $stmt->execute([$data['stock'], $data['menu_id']]);
    
    if ($success) {
        // Log to stock history
        $stmt = $conn->prepare("INSERT INTO stock_history (menu_id, quantity_change, type, notes) VALUES (?, ?, 'adjustment', 'Manual stock adjustment')");
        $stmt->execute([$data['menu_id'], $data['stock']]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Stock updated successfully'
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update stock'
        ]);
    }
}

// Delete menu
function deleteMenu($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['menu_id'])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Menu ID is required'
        ]);
        return;
    }
    
    $stmt = $conn->prepare("DELETE FROM menu_items WHERE menu_id = ?");
    $success = $stmt->execute([$data['menu_id']]);
    
    if ($success) {
        echo json_encode([
            'success' => true,
            'message' => 'Menu deleted successfully'
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Failed to delete menu'
        ]);
    }
}
?>