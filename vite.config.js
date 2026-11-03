import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import basicSsl from '@vitejs/plugin-basic-ssl';

export default defineConfig({
  plugins: [
    tailwindcss(), // El plugin de Tailwind v4 se encarga de todo de forma automática
    basicSsl(), // Genera automáticamente el certificado SSL para el puerto 5173
  ],
  build: {
    manifest: true, 
    outDir: 'public/build',
    rollupOptions: {
      input: {
        main: 'src/main.js',
      },
    },
  },
  server: {
    // Forzamos a Vite a responder por HTTPS y permitir CORS
    https: true,
    cors: true,
    origin: 'https://localhost:5173',
  },
});
