
export default {
    login (usuario) {
        return fetch("http://localhost:8000/api/user/login", {
            method: "POST",
            headers: {
                "Content-type": "application/json",
            },
            body: JSON.stringify(usuario),
        });
    },

    registrar(usuario){
        return fetch("http://localhost:8000/api/user/registrar", {
            method: "POST",
            headers: {
                "Content-type": "application/json",
            },
            body: JSON.stringify(usuario),
        });
    }
}
