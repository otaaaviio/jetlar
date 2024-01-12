import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../../services/api";

const RegisterContainer = ({ register, setRegister }) => {
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [password_confirmation, setPasswordConfirmation] = useState("");
    const navigate = useNavigate();

    const handleRegister = async () => {
        try {
            const response = await api.post("/register", {
                name,
                email,
                password,
                password_confirmation,
            });
            if (response.status === 201) {
                navigate("/home");
            } else {
                alert("Credenciais inválidas");
            }
        } catch (error) {
            console.error("Erro durante a autenticação", error);
            alert("Erro durante a autenticação");
        }
    };

    return (
        <div>
            <div className="loginContainer">
                <div className="inputGroup">
                    <input
                        type="text"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                        className="inputForm"
                        required
                    />
                    <label className="inputLabel">Nome</label>
                </div>
                <div className="inputGroup">
                    <input
                        type="text"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        className="inputForm"
                        required
                    />
                    <label className="inputLabel">Email</label>
                </div>
                <div className="inputGroup">
                    <input
                        type="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        className="inputForm"
                        required
                    />
                    <label className="inputLabel">Senha</label>
                </div>
                <div className="inputGroup">
                    <input
                        type="password"
                        value={password_confirmation}
                        onChange={(e) =>
                            setPasswordConfirmation(e.target.value)
                        }
                        className="inputForm"
                        required
                    />
                    <label className="inputLabel">Confirmar Senha</label>
                </div>
                <button
                    onClick={() => {
                        if (password == password_confirmation) {
                            handleRegister();
                        }
                    }}
                >
                    REGISTRAR-SE
                </button>
            </div>
            <div className="register" style={{ justifyContent: "left" }}>
                <button onClick={() => setRegister(!register)}>Voltar</button>
            </div>
        </div>
    );
};

export default RegisterContainer;
