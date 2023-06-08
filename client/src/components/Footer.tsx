/* eslint-disable @typescript-eslint/no-empty-interface */
/* eslint-disable @typescript-eslint/no-unused-vars */
import { FC } from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";

interface FooterProps {

}
 
const Footer: FC<FooterProps> = () => {

    return ( 
        <footer>
            <Container>
                <Row>
                    <small>
                        © {(new Date()).getFullYear()} ScandiProd. All Rights Reserved. 
                        {' '}
                        <a href="https://github.com/babblebey/scandi-prod" target="_blank">
                            GitHub
                        </a>
                    </small>
                </Row>
            </Container>
        </footer>
     );
}
 
export default Footer;