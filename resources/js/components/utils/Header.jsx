import React from "react";
import { ReactSVG } from "react-svg";
import pet from "../../../../public/svg/pet.svg";
import "../utils/styles.css";
import { useNavigate } from "react-router-dom";
import api from "../../services/api";

const Header = () => {
    const navigate = useNavigate();

    const handleLogout = async () => {
        try {
            const response = await api.post("/user/logout", {});

            if (response.status === 200) {
                window.location.href = "/";
            }
        } catch (error) {
            console.error("Erro: ", error);
            alert("Erro ao tentar encerrar sessão");
        }
    };

    return (
        <header>
            <div
                onClick={() => {
                    navigate("/home");
                }}
                className="logo"
            >
                <ReactSVG src={pet} />
                <h1>JetLar</h1>
            </div>
            <button onClick={handleLogout}>SAIR</button>
        </header>
    );
};

export default Header;
