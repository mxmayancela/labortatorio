import { Carrier } from "../models/carrier";

export class Bus {
    id!: number;
    unitnumber!: number;
    licenseplate!: string;
    model!: string;
    year!: string;
    capacity!: number;
    id_carrier!: number;
    carrier!: Carrier;
    assigned!: boolean;

}
