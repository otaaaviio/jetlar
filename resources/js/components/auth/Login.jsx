import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../../services/api";
import "../../../css/Login/login.css";
import { ReactSVG } from "react-svg";
import pet from "../../../../public/svg/pet.svg";
import RegisterContainer from "./Register";

const Login = () => {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [register, setRegister] = useState(false);
    const navigate = useNavigate();

    const handleLogin = async () => {
        try {
            const response = await api.post("/login", {
                email,
                password,
            });
    
            if (response.data.authorization.token) {
                localStorage.setItem("token", response.data.authorization.token);
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
        <div
            style={{
                display: "flex",
                flexDirection: "column",
                alignItems: "center",
            }}
        >
            <div
                style={{
                    display: "flex",
                    alignItems: "center",
                }}
            >
                <ReactSVG src={pet} />
                <h1>JetLar</h1>
            </div>
            {!register && (
                <div>
                    <div className="loginContainer">
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
                        <button onClick={handleLogin}>ENTRAR</button>
                    </div>
                    <div className="register">
                        <button
                            onClick={() => {
                                setRegister(!register);
                            }}
                        >
                            Ainda não é membro? Junte-se a nós
                        </button>
                    </div>
                </div>
            )}
            {register && (
                <RegisterContainer
                    setRegister={setRegister}
                    register={register}
                />
            )}
        </div>
    );
};

export default Login;
