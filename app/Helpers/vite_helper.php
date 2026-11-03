<?php

if (!function_exists('vite_assets')) {
    function vite_assets() {
        $isDevelopment = (ENVIRONMENT !== 'production'); 

        if ($isDevelopment) {
            return '
                <script type="module" src="https://localhost:5173/@vite/client"></script>
                <script type="module" src="https://localhost:5173/src/main.js"></script>
            ';
        }

        // Modo Producción
        $manifestPath = FCPATH . 'build/.vite/manifest.json';
        
        if (!file_exists($manifestPath)) {
            return '<!-- Manifest no encontrado -->';
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);
        
        $jsFile = $manifest['src/main.js']['file'];
        $cssFile = $manifest['src/main.css']['file'] ?? ($manifest['src/main.js']['css'] ?? null);

        $html = '';
        if ($cssFile) {
            $html .= '<link rel="stylesheet" href="' . base_url('build/' . $cssFile) . '">';
        }
        $html .= '<script type="module" src="' . base_url('build/' . $jsFile) . '"></script>';

        return $html;
    }
}
