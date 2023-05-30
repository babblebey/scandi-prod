/* eslint-disable @typescript-eslint/no-empty-interface */
import { FC } from 'react';
import { Outlet } from "react-router-dom";

interface RootProps {
    
}
 
const Root: FC<RootProps> = () => {
    return ( 
        <>
            <Outlet />
        </>
     );
}
 
export default Root;