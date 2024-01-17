import { Image } from "@mantine/core";
import React from "react";

const PetPhoto = ({ pet, ...props }) => {
    console.log(pet)
    const src = pet?.photos?.url ?? `/images/petCover.png`;

    return (
        <Image
            src={src}
            alt={pet?.name ?? "Pet Cover"}
            height={300}
            {...props}
        />
    );
};

export default PetPhoto;
