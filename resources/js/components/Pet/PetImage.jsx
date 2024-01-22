import React from "react";
import "../../../css/Pet/pet.css";

const PetImage = ({ pet }) => {
    const src = pet?.image_path ?? `/images/petCover.png`;

    return (
        <div
            className="petImage"
            style={{
                backgroundImage: `url(${src})`,
            }}
        >
            <img src={src} alt={pet?.name ?? "Pet Cover"} />
        </div>
    );
};

export default PetImage;
