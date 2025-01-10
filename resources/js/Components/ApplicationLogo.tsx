import logo from '@/Assets/logo.png';
import { ImgHTMLAttributes } from 'react';

export default function ApplicationLogo(
    props: ImgHTMLAttributes<HTMLImageElement>,
) {
    return <img src={logo} alt="logo.png" {...props} />;
}
