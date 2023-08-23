import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class RouteService {
  private baseUrl: string = "http://localhost:8000/api/routes"
  constructor(private http:HttpClient) { }

  getRoutes(){
    return this.http.get<any>(`${this.baseUrl+ '/index'}`)
  }

  postRoute(routeObj: any){
    return this.http.post<any>(`${this.baseUrl+ '/store'}`, routeObj)
  }

  getRouteId(id: number){
    return this.http.get<any>(`${this.baseUrl+ '/show'}/${id}`)
  }

  updateRoute(routeObj: any, id: number){
    return this.http.put<any>(`${this.baseUrl+ '/update'}/${id}`, routeObj)
  }

  updateCompleteRoute(routeObj: any, id: number){
    return this.http.put<any>(`${this.baseUrl+ '/update-complete'}/${id}`, routeObj)
  }
  incompleteRoutes(){
    return this.http.get<any>(`${this.baseUrl+ '/incomplete'}`)
  }
}
