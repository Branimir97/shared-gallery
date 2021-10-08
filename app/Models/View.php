<?php

namespace Models;
use Exceptions\TemplateNotFoundException;

class View {
    public function render(string $file, array $data = []) {
        $fileName = 'Views/'.$file.'View.php';
        if(!file_exists($fileName)) {
            return new TemplateNotFoundException(
                'Template "'.$fileName.'" not found.'
            );
        } 
        ob_start();
        extract($data, EXTR_SKIP);
        include $fileName;
        $output = ob_get_clean();
        return $output;
    }
}