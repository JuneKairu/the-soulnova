import { Container, Row, Col } from "react-bootstrap";
import logo from "../assets/img/kairulogo.png";
import navIcon1 from "../assets/img/discord.svg";
import navIcon2 from "../assets/img/nav-icon2.svg";
import navIcon3 from "../assets/img/nav-icon3.svg";

export const Footer = () => {
  return (
    <footer className="footer">
      <Container>
        <Row className="align-items-center">
          <Col size={12} sm={6}>
            <div className="logo">
            <img src={logo} alt="Logo" />
            </div>
          </Col>
          <Col size={12} sm={6} className="text-center text-sm-end">
            <div className="social-icon">
              <a href="#"><img src={navIcon1} alt="Icon" /></a>
              <a href="#"><img src={navIcon2} alt="Icon" /></a>
              <a href="#"><img src={navIcon3} alt="Icon" /></a>
            </div>
            <p>Social Media Accounts</p>
          </Col>
        </Row>
      </Container>
    </footer>
  )
}
