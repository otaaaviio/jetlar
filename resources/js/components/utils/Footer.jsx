import React from "react";
import "../utils/styles.css";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faInstagram } from "@fortawesome/free-brands-svg-icons";
import pet from "../../../../public/svg/pet-small.svg";
import { ReactSVG } from "react-svg";

const Footer = () => {
    return (
        <footer>
            <div className="logoFooter">
                <ReactSVG src={pet} className="svg" />
                <span>JetLar</span>
            </div>
            <p className="copyright">copyright &copy; 2024 Jetimob</p>
            <nav className="social-media">
                <ul>
                    <li>
                        <a
                            href="https://www.instagram.com/jetlar_/"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <FontAwesomeIcon icon={faInstagram} />
                        </a>
                    </li>
                </ul>
            </nav>
        </footer>
    );
};

export default Footer;
