import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Carrier } from '../models/carrier';

@Injectable({
  providedIn: 'root'
})
export class CarrierService {

  private baseUrl: string = "http://localhost:8000/api/carriers"
  constructor(private http: HttpClient) { }


  getCarriers() {
    return this.http.get<any>(`${this.baseUrl+ '/index'}`)
  }

  postCarrier(carrierObj: Carrier) {
    return this.http.post<Carrier>(`${this.baseUrl+ '/store'}`, carrierObj)
  }

  getCarrierId(id: number) {
    return this.http.get<any>(`${this.baseUrl+ '/show'}/${id}`)
  }

  updateCarrier(carrierObj: Carrier, id: number) {
    return this.http.put<Carrier>(`${this.baseUrl+ '/update'}/${id}`, carrierObj)
  }

  
}
