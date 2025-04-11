import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { loginUsuario } from '../../servicios/loginService';
import './login.css';

export default function Login() {
    const [usuario, setUsuario] = useState('');
    const [contrasena, setContrasena] = useState('');
    const [error, setError] = useState('');
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError('');

        try {
            const data = await loginUsuario(usuario, contrasena);

            if (data.success) {
                localStorage.setItem('usuario', JSON.stringify(data.usuario));
                navigate('/dashboard');
            } else {
                setError(data.message);
            }
        } catch (err) {
            console.error(err);
            setError('Error de conexión');
        }
    };

    return (
        <div className="login-container">
            <h2>Iniciar sesión</h2>
            <form onSubmit={handleSubmit}>
                <input
                    type="text"
                    placeholder="Usuario"
                    value={usuario}
                    onChange={(e) => setUsuario(e.target.value)}
                />
                <input
                    type="password"
                    placeholder="Contraseña"
                    value={contrasena}
                    onChange={(e) => setContrasena(e.target.value)}
                />
                <button type="submit">Ingresar</button>
            </form>
            {error && <p className="error">{error}</p>}
        </div>
    );
}
