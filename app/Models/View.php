<?php

namespace Models;

class View {
    public function render(string $file, array $data = []) {
        $fileName = 'Views/'.$file.'.php';
        if(!file_exists($fileName)) {
            return new Exception();
        } 
        ob_start();
        extract($data, EXTR_SKIP);
        include $fileName;
        $output = ob_get_clean();
        return $output;
    }
}