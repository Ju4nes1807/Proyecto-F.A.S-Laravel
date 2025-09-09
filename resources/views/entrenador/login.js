document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.getElementById("loginForm");
  const mensaje = document.getElementById("mensaje");

  // Simulación de usuarios válidos
  const usuarios = [,
    { correo: "entrenador@gmail.com", password: "1234", rol: "entrenador" }
  ];

  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const correo = document.getElementById("correo").value;
    const password = document.getElementById("password").value;
    const rol = document.getElementById("rol").value;

    // Buscar si el usuario existe
    const user = usuarios.find(u => u.correo === correo && u.password === password && u.rol === rol);

    if (user) {
      // Guardamos sesión
      localStorage.setItem("logueado", "true");
      localStorage.setItem("rol", user.rol);
      localStorage.setItem("correo", user.correo);

      // Redirigir según rol
      if (user.rol === "") {
        window.location.href = "principal.html";
      } else if (user.rol === "entrenador") {
        window.location.href = "principal.html";
      }
    } else {
      mensaje.style.display = "block";
    }
  });
});
