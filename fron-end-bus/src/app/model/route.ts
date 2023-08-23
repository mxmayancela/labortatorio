import { Carrier } from "../models/carrier";
import { Bus } from "./bus";
import { City } from "./city";


export class Route {
    id!: number;
    city_origin!:City;
    city_destination!: City;
    bus!: Bus;
    date!: string;
    start_time!: string;
    end_time!: string;
    date_end!: string;
    carrier!:Carrier;
    id_city_origin!: number;
    id_city_destination!: number;
    id_bus!: number;
    complete!: boolean;
}
