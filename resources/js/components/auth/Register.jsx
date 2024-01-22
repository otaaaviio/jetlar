import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../../services/api";
import Snackbar from "@mui/material/Snackbar";
import showP from "../../../../public/svg/show-password.svg";
import { ReactSVG } from "react-svg";
import notShow from "../../../../public/svg/not-show-password.svg";

const RegisterContainer = ({ register, setRegister }) => {
    const navigate = useNavigate();
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [password_confirmation, setPasswordConfirmation] = useState("");
    const [openSnackBar, setOpenSnackBar] = useState(false);
    const [openSnackBar2, setOpenSnackBar2] = useState(false);
    const [show, setShow] = useState(false);
    const [show2, setShow2] = useState(false);

    const handleRegister = async () => {
        try {
            const response = await api.post("/register", {
                name,
                email,
                password,
                password_confirmation,
            });
            if (response.status === 201) {
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
            }
        } catch (error) {
            if (error.response.status == 409) {
                setOpenSnackBar(true);
            } else {
                console.error("Erro durante o registro", error);
            }
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
                        type={show ? "text" : "password"}
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
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
                <div className="inputGroup">
                    <input
                        type={show2 ? "text" : "password"}
                        value={password_confirmation}
                        onChange={(e) =>
                            setPasswordConfirmation(e.target.value)
                        }
                        className="inputForm"
                        required
                    />
                    <button onClick={() => setShow2(!show2)}>
                        {show2 ? (
                            <ReactSVG src={showP} />
                        ) : (
                            <ReactSVG src={notShow} />
                        )}
                    </button>
                    <label className="inputLabel">Confirmar Senha</label>
                </div>
                <button
                    onClick={() => {
                        if (
                            password == password_confirmation &&
                            name &&
                            email &&
                            password
                        ) {
                            handleRegister();
                        } else {
                            setOpenSnackBar2(true);
                        }
                    }}
                >
                    REGISTRAR-SE
                </button>
            </div>
            <div className="register" style={{ justifyContent: "left" }}>
                <button onClick={() => setRegister(!register)}>Voltar</button>
            </div>
            <Snackbar
                anchorOrigin={{ vertical: "top", horizontal: "left" }}
                open={openSnackBar}
                onClose={() => setOpenSnackBar(false)}
                message="Este endereço de e-mail já está em uso."
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
    );
};

export default RegisterContainer;
