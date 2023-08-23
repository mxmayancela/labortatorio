import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CityService {
  private baseUrl = 'http://localhost:8000/api/citys';
  constructor(private http:HttpClient) { }

  getCitys(){
    return this.http.get<any>(`${this.baseUrl+ '/index'}`)
  }
}
