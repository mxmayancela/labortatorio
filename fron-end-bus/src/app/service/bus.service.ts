import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class BusService {
  private baseUrl: string = "http://localhost:8000/api/buses"
  constructor(private http:HttpClient) { }

  getBuses(){
    return this.http.get<any>(`${this.baseUrl+ '/index'}`)
  }

  postBus(busObj: any){
    return this.http.post<any>(`${this.baseUrl+ '/store'}`, busObj)
  }

  getBusId(id: number){
    return this.http.get<any>(`${this.baseUrl+ '/show'}/${id}`)
  }

  updateBus(busObj: any, id: number){ 
    return this.http.put<any>(`${this.baseUrl+ '/update'}/${id}`, busObj)
  }

  

}
