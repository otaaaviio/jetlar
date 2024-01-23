import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../../services/api";
import "../../../css/Login/login.css";
import { ReactSVG } from "react-svg";
import pet from "../../../../public/svg/pet.svg";
import show from "../../../../public/svg/show-password.svg";
import notShow from "../../../../public/svg/not-show-password.svg";
import RegisterContainer from "./Register";
import Snackbar from "@mui/material/Snackbar";

const Login = () => {
    const navigate = useNavigate();
    const [form, setForm] = useState({
        email: "",
        password: "",
    });
    const [register, setRegister] = useState(false);
    const [openSnack, setOpenSnack] = useState(false);
    const [showPass, setShowPass] = useState(false);

    const validateForm = () => {
        var emailRegex = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+$/i;
        if (emailRegex.test(form.email) && form.password.length >= 6) {
            return true;
        }
        return false;
    };

    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        });
    };

    const handleLogin = async () => {
        if (validateForm()) {
            try {
                const response = await api.post("/login", form);
                if (response.data.authorization.token) {
                    localStorage.setItem(
                        "token",
                        response.data.authorization.token
                    );
                    navigate("/home");
                }
            } catch (error) {
                if (error.response?.status == 409) {
                    setOpenSnack(true);
                } else {
                    console.error("Erro durante a autenticação", error);
                }
            }
        } else {
            setOpenSnack(true);
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
                {register ? (
                    <RegisterContainer
                        setRegister={setRegister}
                        register={register}
                    />
                ) : (
                    <div>
                        <div className="loginContainer">
                            <div className="inputGroup">
                                <input
                                    type="text"
                                    name="email"
                                    value={form.email}
                                    onChange={handleChange}
                                    className="inputForm"
                                />
                                <label className="inputLabel">Email</label>
                            </div>
                            <div className="inputGroup">
                                <input
                                    type={showPass ? "text" : "password"}
                                    name="password"
                                    value={form.password}
                                    onChange={handleChange}
                                    className="inputForm"
                                />
                                <button onClick={() => setShowPass(!showPass)}>
                                    {showPass ? (
                                        <ReactSVG src={show} />
                                    ) : (
                                        <ReactSVG src={notShow} />
                                    )}
                                </button>
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
                <Snackbar
                    anchorOrigin={{ vertical: "top", horizontal: "left" }}
                    open={openSnack}
                    onClose={() => setOpenSnack(false)}
                    message="Credencias Inválidas!"
                    autoHideDuration={6000}
                />
            </div>
        </div>
    );
};

export default Login;
