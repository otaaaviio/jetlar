import React from "react";
import "../../../css/Pet/pet.css";
import PetPhoto from "./PetPhoto";
import { useNavigate } from "react-router-dom";

const PetCard = ({ pet }) => {
    const navigate = useNavigate();
    const handleOnClick = () => {
        navigate(`/pets/${pet.id}`);
    };

    return (
        <div className="cardContainer" onClick={handleOnClick}>
            <PetPhoto />
            <div className="infoContainer">
                <h2>{pet.name}</h2>
                <div>
                    <h4>{pet.age}</h4>
                    <h4>{pet.size}</h4>
                </div>
            </div>
        </div>
    );
};

export default PetCard;
