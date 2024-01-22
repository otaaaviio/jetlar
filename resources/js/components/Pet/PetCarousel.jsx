import React from "react";
import "../../../css/Pet/pet.css";
import { ReactSVG } from "react-svg";
import left from "../../../../public/svg/left.svg";
import right from "../../../../public/svg/right.svg";

class PetCarousel extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            currentImageIndex: 0,
        };
        this.nextSlide = this.nextSlide.bind(this);
        this.prevSlide = this.prevSlide.bind(this);
    }

    prevSlide() {
        const lastIndex = Object.keys(this.props.images).length - 1;
        const { currentImageIndex } = this.state;
        const shouldResetIndex = currentImageIndex === 0;
        const index = shouldResetIndex ? lastIndex : currentImageIndex - 1;

        this.setState({
            currentImageIndex: index,
        });
    }

    nextSlide() {
        const lastIndex = Object.keys(this.props.images).length - 1;
        const { currentImageIndex } = this.state;
        const shouldResetIndex = currentImageIndex === lastIndex;
        const index = shouldResetIndex ? 0 : currentImageIndex + 1;

        this.setState({
            currentImageIndex: index,
        });
    }

    render() {
        if (
            !this.props.images ||
            !this.props.images[this.state.currentImageIndex]
        ) {
            return <div>Carregando...</div>;
        }

        return (
            <div className="petCarousel">
                <button onClick={this.prevSlide} className="btnLeft">
                    <ReactSVG src={left} />
                </button>
                <div
                    className="imagesContainer"
                    style={{
                        backgroundImage: `url(${
                            this.props.images[this.state.currentImageIndex]
                        })`,
                    }}
                >
                    <img
                        src={this.props.images[this.state.currentImageIndex]}
                        alt=""
                    />
                </div>
                <button onClick={this.nextSlide} className="btnRight">
                    <ReactSVG src={right} />
                </button>
            </div>
        );
    }
}

export default PetCarousel;
