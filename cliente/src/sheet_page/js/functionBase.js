function verificacionLogueo() {
  const token = localStorage.getItem("adminUser");
  if (token != "correcto") {
    window.location.href = '../../index.html';
  }
}
