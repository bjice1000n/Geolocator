<?php

namespace app;

class Router
{
    private $vars = [];
    private $name;
    private $path;
    private $handler;

    public function __call($name, $variables): void
    {
        $this->load($name, $variables);

        if ($this->validate()) {
            $this->loadVariables();

            $class = $this->handler[0];
            $method = $this->handler[1];

            $this->render(
                (new $class)->$method(...array_values($this->vars))
            );
        }
    }

    private function render($data): void
    {
        print $data;
    }

    private function validate(): bool
    {
        http_response_code(200);

        if ($_SERVER['REQUEST_METHOD'] !== strtoupper($this->name)) {
            http_response_code(405); // 405 Method not supported

            return false;
        }

        if ($_SERVER['REQUEST_URI'] !== $this->path) {
            http_response_code(404);

            return false;
        }

        return true;
    }

    private function load($name, $variables): void
    {
        $this->name = $name;
        $this->path = $variables[0];
        $this->handler = $variables[1];
    }

    private function loadVariables(): void
    {
        $postVars = $_POST ?? [];
        $inputVars = json_decode(
            file_get_contents('php://input'), true
        ) ?? [];

        $this->vars = array_unique(
            array_merge($postVars, $inputVars)
        );
    }

}