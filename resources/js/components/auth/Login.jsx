import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../../services/api";
import "../../../css/Login/login.css";
import { ReactSVG } from "react-svg";
import pet from "../../../../public/svg/pet.svg";
import showP from "../../../../public/svg/show-password.svg";
import notShow from "../../../../public/svg/not-show-password.svg";
import RegisterContainer from "./Register";
import Snackbar from "@mui/material/Snackbar";

const Login = () => {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [register, setRegister] = useState(false);
    const navigate = useNavigate();
    const [openSnackBar, setOpenSnackBar] = useState(false);
    const [openSnackBar2, setOpenSnackBar2] = useState(false);
    const [show, setShow] = useState(false);

    const handleLogin = async () => {
        try {
            const response = await api.post("/login", {
                email,
                password,
            });

            if (response.data.authorization.token) {
                localStorage.setItem(
                    "token",
                    response.data.authorization.token
                );
                navigate("/home");
            }
        } catch (error) {
            if (error.response?.status == 409) {
                setOpenSnackBar(true);
            } else {
                console.error("Erro durante a autenticação", error);
            }
        }
    };

    return (
        <div className="bodyLogin">
            <div className="containerLogin">
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
                                    type={show ? "text" : "password"}
                                    value={password}
                                    onChange={(e) =>
                                        setPassword(e.target.value)
                                    }
                                    className="inputForm"
                                    required
                                />
                                <button onClick={() => setShow(!show)}>
                                    {show ? (
                                        <ReactSVG src={showP} />
                                    ) : (
                                        <ReactSVG src={notShow} />
                                    )}
                                </button>
                                <label className="inputLabel">Senha</label>
                            </div>
                            <button
                                onClick={() => {
                                    if (
                                        email &&
                                        password &&
                                        password.length > 5
                                    ) {
                                        handleLogin();
                                    } else {
                                        setOpenSnackBar2(true);
                                    }
                                }}
                            >
                                ENTRAR
                            </button>
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
                <Snackbar
                    anchorOrigin={{ vertical: "top", horizontal: "left" }}
                    open={openSnackBar}
                    onClose={() => setOpenSnackBar(false)}
                    message="Credencias Inválidas!"
                    autoHideDuration={6000}
                />
                <Snackbar
                    anchorOrigin={{ vertical: "top", horizontal: "left" }}
                    open={openSnackBar2}
                    onClose={() => setOpenSnackBar2(false)}
                    message="Preencha todos os campos corretamente!"
                    autoHideDuration={6000}
                />
            </div>
        </div>
    );
};

export default Login;
