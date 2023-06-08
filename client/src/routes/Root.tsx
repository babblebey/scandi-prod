/* eslint-disable @typescript-eslint/no-empty-interface */
import { FC } from 'react';
import { Outlet } from "react-router-dom";
import Footer from "../components/Footer";

interface RootProps {
    
}
 
const Root: FC<RootProps> = () => {
    return ( 
        <div className="app-body">
            <Outlet />
            <Footer />
        </div>
     );
}
 
export default Root;