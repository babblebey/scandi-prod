import { FC } from "react";

interface CancelIconProps {
    className?: string
    style?: object
}
 
const CancelIcon: FC<CancelIconProps> = ({ className, style }) => {
    return (
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className={className} style={style}>
            <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      
     );
}
 
export default CancelIcon;