import React from "react";
import "../../../css/Pet/pet.css";
import PetImage from "./PetImage";
import { useNavigate } from "react-router-dom";

const PetCard = ({ pet }) => {
    const navigate = useNavigate();
    const handleOnClick = () => {
        navigate(`/pets/${pet.pet_id}`);
    };

    return (
        <div className="cardContainer" onClick={handleOnClick}>
            <PetImage pet={pet} />
            <div className="infoContainer">
                <h2>{pet.name}</h2>
                <div>
                    <h4>{pet.life_stage}</h4>
                    <h4>{pet.size}</h4>
                </div>
            </div>
        </div>
    );
};

export default PetCard;
