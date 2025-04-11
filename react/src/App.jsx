import { Routes, Route, Navigate } from 'react-router-dom';
import Login from './modulos/Login/Login';

function App() {
  return (
    <Routes>
      <Route path="/" element={<Navigate to="/login" />} />
      <Route path="/login" element={<Login />} />
      <Route path="/dashboard" element={<h2>Bienvenido al Dashboard</h2>} />
      <Route path="*" element={<h2>404 - Página no encontrada</h2>} />
    </Routes>
  );
}

export default App;
