import React, { useEffect, useState } from "react";
import api from "../../services/api";
import { useNavigate, useParams } from "react-router-dom";
import Header from "../utils/Header";
import Footer from "../utils/Footer";
import "../../../css/Pet/petpage.css";
import { CircularProgress } from "@mui/material";
import PetCarousel from "./PetCarousel";

const PetPage = () => {
    const navigate = useNavigate();
    let { id } = useParams();
    const [pet, setPet] = useState({});
    const [isLoading, setIsLoading] = useState(false);

    useEffect(() => {
        const fetchPets = async () => {
            setIsLoading(true);
            try {
                const response = await api.get(`/user/pets/${id}`);
                setPet(response.data.data);
            } catch (error) {
                console.error("Erro ao buscar pet: ", error);
            }
            setIsLoading(false);
        };

        fetchPets();
    }, []);

    const handleDelete = async () => {
        const confirmation = window.confirm(
            "Tem certeza de que deseja excluir este pet?"
        );
        if (confirmation) {
            try {
                const id = pet.pet_id;
                const response = await api.delete(`/user/pets/${id}`);
                if (response.status === 204) {
                    navigate("/home");
                }
            } catch (error) {
                console.error("Erro durante o exclusão de pet:", error);
                alert("Erro durante o exclusão de pet");
            }
        }
    };

    const handleEdit = async () => {
        navigate(`/pets/${pet.pet_id}/edit`);
    };

    return (
        <div className="bodyPetPage">
            <Header />
            <div className="centerPet">
                <div className="btnContainer">
                    <button className="editBtn" onClick={handleEdit}>
                        Editar
                    </button>
                    <button className="deleteBtn" onClick={handleDelete}>
                        Excluir Pet
                    </button>
                </div>
                <div className="petContainer">
                    <div>
                        {isLoading ? (
                            <div className="progessImage">
                                <CircularProgress />
                            </div>
                        ) : (
                            <PetCarousel images={pet.images} />
                        )}
                        <div className="nameContainer">
                            <h1>{pet.name}</h1>
                            <a className="aboutPet">Sobre o pet:</a>
                            <div className="description">{pet.description}</div>
                        </div>
                    </div>
                    <div className="infoPetContainer">
                        <div className="oneInfo">
                            Espécie:
                            <a>{pet.specie}</a>
                        </div>
                        <div className="oneInfo">
                            Sexo:
                            <a>{pet.gender}</a>
                        </div>
                        <div className="oneInfo">
                            Idade:
                            <a>{pet.life_stage}</a>
                        </div>
                        <div className="oneInfo">
                            Porte:
                            <a>{pet.size}</a>
                        </div>
                        <div className="multipleInfos">
                            Temperamento(s):
                            <div>
                                {pet.temperaments &&
                                    pet.temperaments.map((item, index) => (
                                        <a key={index}>- {item}</a>
                                    ))}
                            </div>
                        </div>
                        <div className="multipleInfos">
                            Sociável com:
                            <div>
                                {pet.sociable_with &&
                                    pet.sociable_with.map((item, index) => (
                                        <a key={index}>- {item}</a>
                                    ))}
                            </div>
                        </div>
                        <div className="multipleInfos">
                            Vive bem em:
                            <div>
                                {pet.suitable_livings &&
                                    pet.suitable_livings.map((item, index) => (
                                        <a key={index}>- {item}</a>
                                    ))}
                            </div>
                        </div>
                        <div className="lastInfo">
                            Cuidados Veterinários:
                            <div>
                                {pet.veterinary_cares &&
                                    pet.veterinary_cares.map((item, index) => (
                                        <a key={index}>- {item}</a>
                                    ))}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <Footer />
        </div>
    );
};

export default PetPage;
