<?php
/**
 * 파일 역할: 라우터
 */
declare(strict_types=1);

class Router {
    private array $routes = [];

    public function get(string $path, string $handler): void {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, string $handler): void {
        $this->routes['POST'][$path] = $handler;
    }

    public function put(string $path, string $handler): void {
        $this->routes['PUT'][$path] = $handler;
    }

    public function delete(string $path, string $handler): void {
        $this->routes['DELETE'][$path] = $handler;
    }

    public function dispatch(): void {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        // 301 리디렉션 처리
        $redirects = [
            '/page_about' => '/about',
            '/page_facility' => '/rental',
            '/page_stay' => '/stay',
            '/page_worship' => '/worship'
        ];

        if (isset($redirects[$uri])) {
            header("Location: " . $redirects[$uri], true, 301);
            exit;
        }

        if (isset($this->routes[$method][$uri])) {
            $handler = $this->routes[$method][$uri];
            [$controllerName, $methodName] = explode('::', $handler);
            
            // 컨트롤러 파일 자동 로드 및 인스턴스화
            require_once __DIR__ . "/../controllers/{$controllerName}.php";
            $controller = new $controllerName();
            $controller->$methodName();
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}

// 라우트 등록 설정 등은 index.php에서 처리하도록 함.
