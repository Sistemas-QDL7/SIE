export async function loginUsuario(usuario, contrasena) {
    const res = await fetch("http://localhost/backend/api/login.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ usuario, contrasena }),
    });

    const data = await res.json();
    return data;
}
