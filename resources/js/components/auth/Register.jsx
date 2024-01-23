import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../../services/api";
import Snackbar from "@mui/material/Snackbar";
import show from "../../../../public/svg/show-password.svg";
import { ReactSVG } from "react-svg";
import notShow from "../../../../public/svg/not-show-password.svg";

const RegisterContainer = ({ register, setRegister }) => {
    const navigate = useNavigate();
    const [form, setForm] = useState({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    });
    const [openSnack, setOpenSnack] = useState(false);
    const [openSnack2, setOpenSnack2] = useState(false);
    const [showPass, setShowPass] = useState(false);
    const [showPass2, setShowPass2] = useState(false);

    const validateForm = () => {
        var emailRegex = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+$/i;
        if (
            form.password == form.password_confirmation &&
            form.name &&
            emailRegex.test(form.email) &&
            form.password.length >= 6
        ) {
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

    const ShowPass = ({ value, setValue }) => {
        return (
            <button onClick={() => setValue(!value)}>
                {value ? <ReactSVG src={show} /> : <ReactSVG src={notShow} />}
            </button>
        );
    };

    const handleRegister = async () => {
        if (validateForm()) {
            try {
                const response = await api.post("/register", form);
                if (response.status === 201) {
                    const response = await api.post("/login", form);
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
                    setOpenSnack(true);
                } else {
                    console.error("Erro durante o registro", error);
                }
            }
        } else {
            setOpenSnack2(true);
        }
    };

    return (
        <div>
            <div className="loginContainer">
                <div className="inputGroup">
                    <input
                        type="text"
                        name="name"
                        value={form.name}
                        onChange={handleChange}
                        className="inputForm"
                    />
                    <label className="inputLabel">Nome</label>
                </div>
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
                    <ShowPass value={showPass} setValeu={setShowPass} />
                    <label className="inputLabel">Senha</label>
                </div>
                <div className="inputGroup">
                    <input
                        type={showPass2 ? "text" : "password"}
                        name="password_confirmation"
                        value={form.password_confirmation}
                        onChange={handleChange}
                        className="inputForm"
                    />
                    <ShowPass value={showPass2} setValeu={setShowPass2} />
                    <label className="inputLabel">Confirmar Senha</label>
                </div>
                <button onClick={handleRegister}>REGISTRAR-SE</button>
            </div>
            <div className="register" style={{ justifyContent: "left" }}>
                <button onClick={() => setRegister(!register)}>Voltar</button>
            </div>
            <Snackbar
                anchorOrigin={{ vertical: "top", horizontal: "left" }}
                open={openSnack}
                onClose={() => setOpenSnack(false)}
                message="Este endereço de e-mail já está em uso."
                autoHideDuration={6000}
            />
            <Snackbar
                anchorOrigin={{ vertical: "top", horizontal: "left" }}
                open={openSnack2}
                onClose={() => setOpenSnack2(false)}
                message="Preencha todos os campos corretamente!"
                autoHideDuration={6000}
            />
        </div>
    );
};

export default RegisterContainer;
